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

    {{-- Section Layanan Online --}}
    <h3 class="text-2xl font-bold mb-6 text-blue-700 text-center">Layanan Online</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        @foreach ($pelayanan as $item)
            <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col text-center">
                <div class="bg-blue-100 text-blue-600 rounded-full h-16 w-16 flex items-center justify-center mb-6 text-3xl mx-auto">
                    <i class="{{ $item->icon }}"></i>
                </div>
                <div class="flex-grow">
                    <h3 class="text-xl font-bold mb-3 text-gray-800">{{ $item->nama }}</h3>
                    <p class="text-gray-600 mb-6 text-base">{{ $item->deskripsi }}</p>
                </div>
                <div class="mt-auto">
                    <a href="{{ route('pengajuan', $item->id) }}"
                       class="font-semibold text-blue-600 hover:text-blue-800 transition-colors group inline-flex items-center justify-center">
                        Ajukan Sekarang
                        <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Section Layanan Offline (statis + persyaratan) --}}
    <h3 class="text-2xl font-bold mb-6 text-red-700 text-center">Layanan Offline</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Surat Pengantar Nikah -->
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col text-center">
            <div class="bg-red-100 text-red-600 rounded-full h-16 w-16 flex items-center justify-center mb-6 text-3xl mx-auto">
                <i class="fas fa-university"></i>
            </div>
            <div class="flex-grow">
                <h3 class="text-xl font-bold mb-3 text-gray-800">Surat Pengantar Nikah</h3>
                <p class="text-gray-600 mb-4">Silakan datang ke kantor kelurahan dengan membawa berkas berikut:</p>
                <ul class="list-disc list-inside text-gray-700 text-sm space-y-1 text-left inline-block">
                    <li>Surat Pengantar RT</li>
                    <li>Kartu Keluarga Kedua Calon</li>
                    <li>Fotocopy KTP</li>
                    <li>Pelunasan PBB Tahun Berjalan</li>
                    <li>Fotocopy Akta Cerai/Akta Kematian</li>
                </ul>
            </div>
        </div>

        <!-- Pengurusan Kartu Keluarga (KK) -->
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col text-center">
            <div class="bg-red-100 text-red-600 rounded-full h-16 w-16 flex items-center justify-center mb-6 text-3xl mx-auto">
                <i class="fas fa-users"></i>
            </div>
            <div class="flex-grow">
                <h3 class="text-xl font-bold mb-3 text-gray-800">Pengurusan Kartu Keluarga (KK)</h3>
                <p class="text-gray-600 mb-4">Silakan datang ke kantor kelurahan dengan membawa berkas berikut:</p>
                <ul class="list-disc list-inside text-gray-700 text-sm space-y-1 text-left inline-block">
                    <li>Surat Pengantar RT</li>
                    <li>Fotocopy Kartu Keluarga</li>
                    <li>Fotocopy KTP</li>
                    <li>Pelunasan PBB Tahun Berjalan</li>
                    <li>Fotocopy Akta Kelahiran</li>
                </ul>
            </div>
        </div>

        <!-- Surat Keterangan Ahli Waris -->
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col text-center">
            <div class="bg-red-100 text-red-600 rounded-full h-16 w-16 flex items-center justify-center mb-6 text-3xl mx-auto">
                <i class="fas fa-scroll"></i>
            </div>
            <div class="flex-grow">
                <h3 class="text-xl font-bold mb-3 text-gray-800">Surat Keterangan Ahli Waris</h3>
                <p class="text-gray-600 mb-4">Silakan datang ke kantor kelurahan dengan membawa berkas berikut:</p>
                <ul class="list-disc list-inside text-gray-700 text-sm space-y-1 text-left inline-block">
                    <li>Surat Pengantar RT</li>
                    <li>Fotocopy Kartu Keluarga</li>
                    <li>Fotocopy KTP</li>
                    <li>Pelunasan PBB Tahun Berjalan</li>
                    <li>Fotocopy Bukti Yang Diwariskan</li>
                </ul>
            </div>
        </div>

        <!-- Surat Keterangan Hak Tanah -->
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col text-center">
            <div class="bg-red-100 text-red-600 rounded-full h-16 w-16 flex items-center justify-center mb-6 text-3xl mx-auto">
                <i class="fas fa-landmark"></i>
            </div>
            <div class="flex-grow">
                <h3 class="text-xl font-bold mb-3 text-gray-800">Surat Keterangan Hak Tanah</h3>
                <p class="text-gray-600 mb-4">Silakan datang ke kantor kelurahan dengan membawa berkas berikut:</p>
                <ul class="list-disc list-inside text-gray-700 text-sm space-y-1 text-left inline-block">
                    <li>Surat Pengantar RT</li>
                    <li>Fotocopy Kartu Keluarga</li>
                    <li>Fotocopy KTP</li>
                    <li>Pelunasan PBB Tahun Berjalan</li>
                    <li>Fotokopi bukti kepemilikan tanah (akta/jual beli/hibah)</li>
                </ul>
            </div>
        </div>

        <!-- Pengurusan KTP -->
        <div class="bg-white border border-gray-200 p-8 rounded-xl shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col text-center">
            <div class="bg-red-100 text-red-600 rounded-full h-16 w-16 flex items-center justify-center mb-6 text-3xl mx-auto">
                <i class="fas fa-id-card"></i>
            </div>
            <div class="flex-grow">
                <h3 class="text-xl font-bold mb-3 text-gray-800">Pengurusan KTP</h3>
                <p class="text-gray-600 mb-4">Silakan datang ke kantor kelurahan dengan membawa berkas berikut:</p>
                <ul class="list-disc list-inside text-gray-700 text-sm space-y-1 text-left inline-block">
                    <li>Surat pengantar RT</li>
                    <li>Fotocopy Kartu Keluarga</li>
                    <li>Pelunasan PBB Tahun Berjalan</li>
                </ul>
            </div>
        </div>

    </div>
</main>
@endsection
