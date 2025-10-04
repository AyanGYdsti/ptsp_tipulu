@extends('layouts.main_frontend')

@section('content')
<main class="container mx-auto px-4 py-16">
    <div class="bg-white shadow-lg rounded-2xl p-8">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Sejarah Kelurahan Tipulu</h2>
        <p class="text-lg text-gray-700 leading-relaxed">
            {{ $landingPage->sejarah ?? 'Belum ada data sejarah dimasukkan.' }}
        </p>
        <a href="{{ route('sejarah') }}" 
           class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            ← Kembali
        </a>
    </div>
</main>
@endsection
