<?php

namespace App\Services;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class FcmService
{
    protected $messaging;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(storage_path('app/firebase/firebase-credentials.json'));
        $this->messaging = $factory->createMessaging();
    }

    /**
     * Kirim notifikasi ke semua admin
     */
    public function sendToAllAdmins($title, $body, $data = [])
    {
        try {
            // Ambil semua FCM token dari admin (semua user)
            $tokens = User::with('fcmTokens')
                ->get()
                ->pluck('fcmTokens')
                ->flatten()
                ->pluck('token')
                ->toArray();

            if (empty($tokens)) {
                Log::warning('Tidak ada FCM token admin yang terdaftar');
                return false;
            }

            Log::info('Mengirim notifikasi ke ' . count($tokens) . ' device(s)');

            // Kirim notifikasi
            $result = $this->sendMulticast($tokens, $title, $body, $data);

            return $result;

        } catch (\Exception $e) {
            Log::error('Error sending FCM notification: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim notifikasi ke multiple devices
     */
    protected function sendMulticast(array $tokens, $title, $body, $data = [])
    {
        try {
            $notification = Notification::create($title, $body);

            $message = CloudMessage::new()
                ->withNotification($notification)
                ->withData($data);

            // Kirim ke semua token
            $report = $this->messaging->sendMulticast($message, $tokens);

            Log::info('FCM Multicast Report', [
                'success_count' => $report->successes()->count(),
                'failure_count' => $report->failures()->count(),
            ]);

            // Log token yang gagal
            foreach ($report->failures()->getItems() as $failure) {
                Log::warning('FCM Send Failed', [
                    'token' => $failure->target()->value(),
                    'error' => $failure->error()->getMessage(),
                ]);
            }

            return true;

        } catch (\Exception $e) {
            Log::error('Error in sendMulticast: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim ke satu token spesifik
     */
    public function sendToToken($token, $title, $body, $data = [])
    {
        try {
            $notification = Notification::create($title, $body);

            $message = CloudMessage::withTarget('token', $token)
                ->withNotification($notification)
                ->withData($data);

            $this->messaging->send($message);

            Log::info('FCM notification sent to single token');
            return true;

        } catch (\Exception $e) {
            Log::error('Error sending to token: ' . $e->getMessage());
            return false;
        }
    }
}