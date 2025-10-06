@extends('layouts.main_frontend')

@section('content')
<main class="container mx-auto px-4 py-16 text-center">
    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-12">
        Sejarah & Visi Misi Kelurahan Tipulu
    </h2>

    <!-- Wrapper untuk center -->
    <div class="flex justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl">
            
            <!-- Card Sejarah -->
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                <h3 class="text-2xl font-bold mb-4">Sejarah Singkat</h3>
                <p class="text-gray-600 mb-6">
                    Nama Tipulu berasal dari sebuah pohon besar bernama “Tipulu” yang dahulu ....
                </p>
                <a href="{{ route('sejarah.detail') }}"
                   class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-green-700 transition">
                    Lihat Selengkapnya →
                </a>
            </div>

            <!-- Card Visi Misi -->
            <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition text-center">
                <h3 class="text-2xl font-bold mb-4">Visi & Misi</h3>
                <p class="text-gray-600 mb-6">
                    Visi: Mewujudkan kawasan permukiman Tipulu yang layak huni, humanis, dan produktif
                </p>
                <a href="{{ route('visimisi') }}"
                   class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-green-700 transition">
                    Lihat Selengkapnya →
                </a>
            </div>

        </div>
    </div>

    <div class="text-center mt-12">
        <a href="{{ url('/') }}" class="px-6 py-3 bg-gray-200 rounded-lg hover:bg-gray-300">
            ← Kembali ke Beranda
        </a>
    </div>
</main>
@endsection
