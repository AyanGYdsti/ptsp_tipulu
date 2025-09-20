<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi Kelurahan Tipulu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body class="bg-gray-50 text-gray-800">

    <header id="navbar" class="sticky-nav bg-white/80 backdrop-blur-sm transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0">
                    <a href="#" class="flex items-center space-x-3">
                        <img class="h-10 w-auto" src="https://placehold.co/100x100/3B82F6/FFFFFF?text=KT"
                            alt="Logo Kelurahan Tipulu">
                        <span class="font-bold text-xl text-gray-800">Kelurahan Tipulu</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <nav class="ml-10 flex items-baseline space-x-8">
                        <a href="#hero" class="text-gray-600 hover:text-blue-600 font-medium">Beranda</a>
                        <a href="#layanan" class="text-gray-600 hover:text-blue-600 font-medium">Layanan</a>
                        <a href="#berita" class="text-gray-600 hover:text-blue-600 font-medium">Berita</a>
                        <a href="#profil" class="text-gray-600 hover:text-blue-600 font-medium">Profil</a>
                        <a href="#pengaduan" class="text-gray-600 hover:text-blue-600 font-medium">Pengaduan</a>
                        <a href="#kontak" class="text-gray-600 hover:text-blue-600 font-medium">Kontak</a>
                    </nav>
                </div>
                <div class="flex items-center">
                    <a href="#"
                        class="hidden sm:block bg-blue-600 text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        Ajukan Layanan Online
                    </a>
                    <button id="mobile-menu-button"
                        class="md:hidden ml-4 p-2 rounded-md text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#hero"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                <a href="#layanan"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Layanan</a>
                <a href="#berita"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Berita</a>
                <a href="#profil"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Profil</a>
                <a href="#pengaduan"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Pengaduan</a>
                <a href="#kontak"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Kontak</a>
                <a href="#"
                    class="bg-blue-600 text-white mt-2 w-full text-center block px-3 py-3 rounded-md text-base font-medium hover:bg-blue-700">Ajukan
                    Layanan Online</a>
            </div>
        </div>
    </header>

    <main>
        <section id="hero" class="relative min-h-[90vh] flex items-center overflow-hidden">
            <div class="absolute inset-0 bg-black/50 z-10"></div>
            <div class="absolute inset-0">
                <img src="https://img.lovepik.com/photo/50108/6061.jpg_wh860.jpg" alt="Kantor Kelurahan Tipulu"
                    class="w-full h-full object-cover ken-burns">
            </div>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
                <div class="max-w-3xl text-center mx-auto">
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white leading-tight animate-fade-in">
                        Selamat Datang di Portal Resmi {{ $landingPage->nama_instansi ?? '-' }}</h1>
                    <p class="mt-6 text-lg md:text-xl text-gray-200 animate-fade-in-delay">
                        {{ $landingPage->slogan ?? '-' }}</p>
                    <div
                        class="mt-10 flex flex-col sm:flex-row justify-center items-center gap-4 animate-fade-in-up-delay">
                        <a href="#layanan"
                            class="bg-yellow-500 text-gray-900 font-bold py-3 px-8 rounded-lg text-lg hover:bg-yellow-400 transition-transform hover:scale-105 w-full sm:w-auto">Lihat
                            Layanan Kami</a>
                        <a href="#"
                            class="bg-white/20 backdrop-blur-sm text-white font-medium py-3 px-8 rounded-lg text-lg hover:bg-white/30 transition-transform hover:scale-105 w-full sm:w-auto">Cara
                            Penggunaan Sistem</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="layanan" class="py-20 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Layanan Administrasi Terpadu</h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Akses layanan administrasi kependudukan
                        dengan mudah dan cepat langsung dari genggaman Anda.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div
                        class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-2 transition-all duration-300 fade-in-up">
                        <div
                            class="bg-blue-100 text-blue-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Surat Domisili</h3>
                        <p class="text-gray-600 mb-6">Ajukan permohonan surat keterangan domisili untuk berbagai
                            keperluan Anda.</p>
                        <a href="#" class="font-semibold text-blue-600 hover:text-blue-800">Ajukan Sekarang
                            →</a>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-2 transition-all duration-300 fade-in-up"
                        style="transition-delay: 150ms;">
                        <div
                            class="bg-green-100 text-green-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">Pengantar SKCK</h3>
                        <p class="text-gray-600 mb-6">Dapatkan surat pengantar untuk pembuatan Surat Keterangan Catatan
                            Kepolisian.</p>
                        <a href="#" class="font-semibold text-blue-600 hover:text-blue-800">Ajukan Sekarang
                            →</a>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-2 transition-all duration-300 fade-in-up"
                        style="transition-delay: 300ms;">
                        <div
                            class="bg-yellow-100 text-yellow-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">SKTM</h3>
                        <p class="text-gray-600 mb-6">Permohonan Surat Keterangan Tidak Mampu untuk keperluan
                            pendidikan atau kesehatan.</p>
                        <a href="#" class="font-semibold text-blue-600 hover:text-blue-800">Ajukan Sekarang
                            →</a>
                    </div>
                </div>
                <div class="text-center mt-12 fade-in-up">
                    <a href="#"
                        class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-lg">Lihat
                        Semua 16 Layanan</a>
                </div>
            </div>
        </section>

        <section id="berita" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Berita & Informasi Terkini</h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan dan pengumuman terbaru
                        dari Kelurahan Tipulu.</p>
                </div>
                <div class="relative fade-in-up">
                    <div id="carousel-wrapper" class="overflow-hidden">
                        <div id="carousel-inner" class="flex transition-transform duration-500 ease-in-out">
                            <div class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3 p-4">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                    <img src="https://img.freepik.com/free-vector/glitch-error-404-page_23-2148105404.jpg"
                                        class="w-full h-48 object-cover" alt="[Gambar kegiatan rapat warga]">
                                    <div class="p-6">
                                        <p class="text-sm text-blue-600 font-semibold mb-2">Kegiatan RW</p>
                                        <h3 class="text-xl font-bold mb-3 hover:text-blue-700"><a
                                                href="#">Sosialisasi Program Kebersihan Lingkungan di RW 03</a>
                                        </h3>
                                        <p class="text-sm text-gray-500">15 September 2025</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3 p-4">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                    <img src="https://img.freepik.com/free-vector/glitch-error-404-page_23-2148105404.jpg"
                                        class="w-full h-48 object-cover" alt="[Gambar pengumuman layanan]">
                                    <div class="p-6">
                                        <p class="text-sm text-green-600 font-semibold mb-2">Pemberitahuan</p>
                                        <h3 class="text-xl font-bold mb-3 hover:text-blue-700"><a
                                                href="#">Jadwal Baru Pelayanan Administrasi Selama Bulan
                                                Oktober</a></h3>
                                        <p class="text-sm text-gray-500">12 September 2025</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3 p-4">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                    <img src="https://img.freepik.com/free-vector/glitch-error-404-page_23-2148105404.jpg"
                                        class="w-full h-48 object-cover" alt="[Gambar pelatihan UMKM]">
                                    <div class="p-6">
                                        <p class="text-sm text-yellow-600 font-semibold mb-2">UMKM</p>
                                        <h3 class="text-xl font-bold mb-3 hover:text-blue-700"><a
                                                href="#">Pelatihan Pemasaran Digital untuk Pelaku UMKM Kelurahan
                                                Tipulu</a></h3>
                                        <p class="text-sm text-gray-500">10 September 2025</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 w-full md:w-1/2 lg:w-1/3 p-4">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden h-full">
                                    <img src="https://img.freepik.com/free-vector/glitch-error-404-page_23-2148105404.jpg"
                                        class="w-full h-48 object-cover" alt="[Gambar gotong royong]">
                                    <div class="p-6">
                                        <p class="text-sm text-blue-600 font-semibold mb-2">Kegiatan Warga</p>
                                        <h3 class="text-xl font-bold mb-3 hover:text-blue-700"><a href="#">Kerja
                                                Bakti Massal Membersihkan Saluran Air Jelang Musim Hujan</a></h3>
                                        <p class="text-sm text-gray-500">08 September 2025</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="prev-btn"
                        class="absolute top-1/2 left-0 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow-md hover:bg-white transition">
                        <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="next-btn"
                        class="absolute top-1/2 right-0 -translate-y-1/2 bg-white/70 p-2 rounded-full shadow-md hover:bg-white transition">
                        <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>

        <section id="data-penduduk" class="py-20 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Sekilas Data Kependudukan Kelurahan Tipulu
                    </h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Data demografi terbaru sebagai bentuk
                        transparansi informasi publik.</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="grid grid-cols-2 gap-6 fade-in-up">
                        <div class="bg-blue-50 p-6 rounded-lg text-center">
                            <p class="text-lg text-blue-800 font-medium">Total Penduduk</p>
                            <p id="total-penduduk" class="text-4xl font-bold text-blue-600 mt-2" data-target="8750">0
                            </p>
                            <p class="text-sm text-blue-700">Jiwa</p>
                        </div>
                        <div class="bg-green-50 p-6 rounded-lg text-center">
                            <p class="text-lg text-green-800 font-medium">Jumlah KK</p>
                            <p id="jumlah-kk" class="text-4xl font-bold text-green-600 mt-2" data-target="2180">0</p>
                            <p class="text-sm text-green-700">Kepala Keluarga</p>
                        </div>
                        <div class="bg-indigo-50 p-6 rounded-lg text-center">
                            <p class="text-lg text-indigo-800 font-medium">Laki-laki</p>
                            <p id="laki-laki" class="text-4xl font-bold text-indigo-600 mt-2" data-target="4420">0
                            </p>
                            <p class="text-sm text-indigo-700">Jiwa</p>
                        </div>
                        <div class="bg-pink-50 p-6 rounded-lg text-center">
                            <p class="text-lg text-pink-800 font-medium">Perempuan</p>
                            <p id="perempuan" class="text-4xl font-bold text-pink-600 mt-2" data-target="4330">0</p>
                            <p class="text-sm text-pink-700">Jiwa</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 fade-in-up">
                        <div class="text-center">
                            <h3 class="text-xl font-bold mb-4">Komposisi Jenis Kelamin</h3>
                            <canvas id="genderChart"></canvas>
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold mb-4">Kelompok Usia</h3>
                            <canvas id="ageChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="profil" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Aparatur Kelurahan Tipulu</h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Mengenal lebih dekat para aparatur yang
                        berdedikasi melayani masyarakat.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="text-center bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 fade-in-up">
                        <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover"
                            src="https://placehold.co/200x200/EFEFEF/7F7F7F?text=Foto" alt="[Foto Lurah]">
                        <h3 class="text-xl font-bold">Nama Lurah, S.IP., M.Si.</h3>
                        <p class="text-blue-600 font-semibold">Lurah</p>
                    </div>
                    <div class="text-center bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 fade-in-up"
                        style="transition-delay: 100ms;">
                        <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover"
                            src="https://placehold.co/200x200/EFEFEF/7F7F7F?text=Foto" alt="[Foto Sekretaris Lurah]">
                        <h3 class="text-xl font-bold">Nama Sekretaris, S.E.</h3>
                        <p class="text-blue-600 font-semibold">Sekretaris Lurah</p>
                    </div>
                    <div class="text-center bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 fade-in-up"
                        style="transition-delay: 200ms;">
                        <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover"
                            src="https://placehold.co/200x200/EFEFEF/7F7F7F?text=Foto" alt="[Foto Kasi Pemerintahan]">
                        <h3 class="text-xl font-bold">Nama Kasi Pemerintahan</h3>
                        <p class="text-blue-600 font-semibold">Kasi Pemerintahan</p>
                    </div>
                    <div class="text-center bg-white p-6 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300 fade-in-up"
                        style="transition-delay: 300ms;">
                        <img class="w-32 h-32 rounded-full mx-auto mb-4 object-cover"
                            src="https://placehold.co/200x200/EFEFEF/7F7F7F?text=Foto" alt="[Foto Staf Pelayanan]">
                        <h3 class="text-xl font-bold">Nama Staf Pelayanan</h3>
                        <p class="text-blue-600 font-semibold">Staf Pelayanan Umum</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="tentang" class="py-20 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="fade-in-up">
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">Sejarah Singkat & Visi Misi Kelurahan Tipulu
                        </h3>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $landingPage->deskripsi ?? '-' }}
                        </p>
                        <a href="#"
                            class="font-semibold text-blue-600 hover:text-blue-800 transition-colors">Baca Selengkapnya
                            →</a>
                    </div>
                    <div class="h-96 rounded-lg overflow-hidden shadow-lg fade-in-up">
                        @php
                            // pastikan koordinat di DB formatnya: "lat,lng"
                            $coords = explode(',', $landingPage->koordinat);
                            $lat = $coords[0] ?? '-3.9877478'; // fallback default
                            $lng = $coords[1] ?? '122.5029891'; // fallback default
                        @endphp

                        <div class="w-full h-[400px] rounded-xl overflow-hidden border border-blue-200">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d5000!2d{{ $lng }}!3d{{ $lat }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v{{ time() }}"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pengaduan" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Layanan Pengaduan Online</h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Sampaikan aspirasi atau keluhan Anda. Kami
                        siap mendengarkan.</p>
                </div>
                <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md fade-in-up">
                    <form id="complaint-form"
                        onsubmit="event.preventDefault(); alert('Fitur pengiriman pengaduan sedang dalam pengembangan.');">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="complaint-name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Lengkap</label>
                                <input type="text" id="complaint-name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                            <div>
                                <label for="complaint-contact"
                                    class="block text-sm font-medium text-gray-700 mb-1">No. Telepon / Email</label>
                                <input type="text" id="complaint-contact"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                    required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="complaint-details" class="block text-lg font-medium text-gray-800 mb-2">Detail
                                Pengaduan</label>
                            <textarea id="complaint-details" rows="6"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Jelaskan pengaduan atau aspirasi Anda di sini..."></textarea>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="button" id="gemini-assist-btn"
                                class="flex-1 inline-flex items-center justify-center gap-2 bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-wait">
                                ✨ Bantu Saya Tulis Pengaduan
                            </button>
                            <button type="submit"
                                class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Kirim Pengaduan
                            </button>
                        </div>
                        <div id="gemini-status" class="text-sm text-center mt-4 text-gray-500 h-5"></div>
                    </form>
                </div>
            </div>
        </section>

        <section id="kontak" class="py-20 bg-blue-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12 fade-in-up">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Butuh Bantuan?</h2>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Kami siap membantu Anda. Hubungi kami
                        melalui kontak di bawah ini atau kunjungi kantor kami pada jam pelayanan.</p>
                </div>
                <div
                    class="max-w-4xl mx-auto bg-white p-8 rounded-xl shadow-md grid grid-cols-1 md:grid-cols-2 gap-8 fade-in-up">
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Informasi Kontak</h3>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span>{{ $landingPage->alamat ?? '-' }}</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-blue-600 mr-3 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <a href="tel:+62-XXX-XXXX-XXXX"
                                    class="hover:text-blue-600">{{ $landingPage->telpon ?? '-' }}</a>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-blue-600 mr-3 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <a href="mailto:info@kelurahantipulu.go.id"
                                    class="hover:text-blue-600">info@kelurahantipulu.go.id</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-4">Waktu Pelayanan</h3>
                        <p>{!! $landingPage->waktu_pelayanan ?? '-' !!}</p>
                        <div class="mt-6">
                            <a href="#"
                                class="inline-flex items-center bg-green-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-700 transition-colors">
                                <svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Unduh Panduan Sistem
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">Kelurahan Tipulu</h3>
                    <p class="text-gray-400">Portal layanan digital untuk masyarakat Kelurahan Tipulu, Kota Kendari.
                    </p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Navigasi Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#layanan" class="text-gray-400 hover:text-white">Layanan</a></li>
                        <li><a href="#berita" class="text-gray-400 hover:text-white">Berita</a></li>
                        <li><a href="#profil" class="text-gray-400 hover:text-white">Profil</a></li>
                        <li><a href="#pengaduan" class="text-gray-400 hover:text-white">Pengaduan</a></li>
                        <li><a href="#kontak" class="text-gray-400 hover:text-white">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><span
                                class="sr-only">Facebook</span><svg class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg></a>
                        <a href="#" class="text-gray-400 hover:text-white"><span
                                class="sr-only">Instagram</span><svg class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 2.525c.636-.247 1.363-.416 2.427-.465C9.795 2.013 10.149 2 12.315 2zm-1.162 4.243a.81.81 0 01-.81-.81V4.18c0-.447.363-.81.81-.81h1.623c.447 0 .81.363.81.81v1.253a.81.81 0 01-.81.81h-1.623zm-1.803 2.131a4.875 4.875 0 109.75 0 4.875 4.875 0 00-9.75 0zm6.983 0a2.108 2.108 0 11-4.217 0 2.108 2.108 0 014.217 0z"
                                    clip-rule="evenodd" />
                            </svg></a>
                        <a href="#" class="text-gray-400 hover:text-white"><span
                                class="sr-only">YouTube</span><svg class="h-6 w-6" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.78 22 12 22 12s0 3.22-.42 4.814a2.506 2.506 0 01-1.768 1.768c-1.594.42-7.812.42-7.812.42s-6.218 0-7.812-.42a2.506 2.506 0 01-1.768-1.768C2 15.22 2 12 2 12s0-3.22.42-4.814a2.506 2.506 0 011.768-1.768C5.782 5 12 5 12 5s6.218 0 7.812.418zM9.75 15.5V8.5l6.5 3.5-6.5 3.5z"
                                    clip-rule="evenodd" />
                            </svg></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>© <span id="year"></span> Pemerintah Kelurahan Tipulu. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <div id="chat-widget" class="fixed bottom-6 right-6 z-50">
        <button id="chat-open-btn"
            class="bg-blue-600 text-white rounded-full p-4 shadow-lg hover:bg-blue-700 transition-transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-blue-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2.5 11.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm-5 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm-5 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
            </svg>
        </button>
    </div>
    <div id="chat-modal"
        class="hidden fixed bottom-6 right-6 sm:bottom-24 sm:right-6 w-[calc(100%-3rem)] sm:w-full sm:max-w-md h-[calc(100%-5rem)] sm:h-full sm:max-h-[70vh] bg-white rounded-2xl shadow-2xl z-50 flex flex-col transition-transform duration-300 transform translate-y-8 opacity-0">
        <div class="flex justify-between items-center p-4 bg-blue-600 text-white rounded-t-2xl flex-shrink-0">
            <h3 class="font-bold text-lg">Asisten Virtual Kelurahan</h3>
            <button id="chat-close-btn" class="p-1 rounded-full hover:bg-white/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4">
        </div>
        <div class="p-4 border-t border-gray-200 bg-white rounded-b-2xl flex-shrink-0">
            <div class="flex items-center space-x-2">
                <input type="text" id="chat-input" placeholder="Tanyakan sesuatu..."
                    class="flex-1 w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-blue-500 focus:border-blue-500">
                <button id="chat-send-btn"
                    class="bg-blue-600 text-white rounded-full p-3 hover:bg-blue-700 transition-colors disabled:bg-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script src="/assets/js/script.js"></script>
</body>

</html>
