@extends('layouts.main_frontend')

@section('content')
    <div style="min-height: 50vh" class="flex flex-col bg-gray-50">
        {{-- Konten utama (form di tengah layar) --}}
        <main class="flex-grow flex items-center justify-center">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">Form Pengecekan Data Penduduk</h2>

                <form action="{{ route('pengajuan.cek', $id) }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="nik" class="block text-sm font-medium text-gray-600">
                            Nomor Induk Kependudukan (NIK)
                        </label>
                        <input type="text" name="nik" id="nik" maxlength="16"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Masukkan NIK Anda" required>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition">
                        Cek
                    </button>
                </form>
            </div>
        </main>
    </div>
@endsection
