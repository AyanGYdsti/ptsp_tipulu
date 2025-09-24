@extends('layouts.main_frontend')

@section('content')
    <main class="container mx-auto px-4 py-16">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">
                Semua Layanan Administrasi
            </h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Temukan dan ajukan berbagai layanan administrasi kependudukan yang kami sediakan untuk kemudahan Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Menggunakan variabel $pelayanan yang dikirim dari controller --}}
            @foreach ($pelayanan as $item)
                {{-- PERUBAHAN UI CARD: Latar belakang diubah menjadi putih, ditambah border dan shadow yang lebih jelas --}}
                <div
                    class="bg-white border border-gray-200 p-8 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col">
                    <div
                        class="bg-blue-100 text-blue-600 rounded-full h-16 w-16 flex items-center justify-center mb-6 text-3xl flex-shrink-0">
                        <i class="{{ $item->icon }}"></i>
                    </div>
                    <div class="flex-grow">
                        <h3 class="text-xl font-bold mb-3 text-gray-800">{{ $item->nama }}</h3>
                        <p class="text-gray-600 mb-6 text-base">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="mt-auto">
                        <a href="{{ route('pengajuan', $item->id) }}"
                            class="font-semibold text-blue-600 hover:text-blue-800 transition-colors group">
                            Ajukan Sekarang
                            <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection

