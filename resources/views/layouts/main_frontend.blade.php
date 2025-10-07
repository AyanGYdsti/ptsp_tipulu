<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Resmi Kelurahan Tipulu</title>

    <meta name="google-site-verification" content="nQDPltT3lbevHFhYmcdR1_9crePvIG-lDKTJuNJElS8" />

    <!-- 🌍 SEO Meta Tags -->
    <meta name="description" content="Portal resmi Kelurahan Tipulu melalui program Meambo. Layanan administrasi publik seperti surat keterangan domisili, izin usaha mikro, dan surat pengantar RT/RW secara online.">
    <meta name="keywords" content="PTSP Kelurahan Tipulu, Meambo, Kelurahan Tipulu, layanan publik Kendari, pelayanan terpadu satu pintu, surat keterangan domisili, surat pengantar RT RW, izin usaha mikro, pelayanan online, pemerintah kota Kendari, kelurahan Tipulu Kendari">
    <meta name="author" content="Pemerintah Kelurahan Tipulu">
    <meta name="robots" content="index, follow">

    <!-- 🧿 Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/APP%20LOGO.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/APP%20LOGO.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/APP%20LOGO.png') }}">
    <meta name="theme-color" content="#1e3a8a">
    
    <!-- 🧩 Open Graph -->
    <meta property="og:title" content="Portal Resmi Kelurahan Tipulu | Meambo - Layanan Publik Online">
    <meta property="og:description" content="Pelayanan publik online Kelurahan Tipulu melalui program Meambo — cepat, mudah, dan transparan.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://meambo.id/">
    <meta property="og:image" content="{{ asset('assets/images/thumbnail.png') }}">

    <!-- 🐦 Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Portal Resmi Kelurahan Tipulu | Meambo">
    <meta name="twitter:description" content="Akses layanan administrasi kelurahan secara online dengan cepat dan mudah.">
    <meta name="twitter:image" content="{{ asset('assets/images/thumbnail.png') }}">

    <script src="/assets/js/tail.js"></script>
    <script src="/assets/js/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>

<body class="bg-gray-50 text-gray-800">

    @php
        // Kalau sedang di halaman utama "/"
        $isHome = request()->is('');
        $prefix = $isHome ? '' : url('/');
    @endphp

    <header id="navbar" class="sticky-nav bg-white/80 backdrop-blur-sm transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex-shrink-0">
                    <a href="#" class="flex items-center space-x-3">
                        <img class="h-[100px] w-auto" src="/assets/img/HEADER%20LOGO.png"
                            alt="Logo Kelurahan Tipulu">
                    </a>
                </div>
                <div class="hidden md:block">
                    <nav class="ml-10 flex items-baseline space-x-8">
                        <a href="{{ $prefix }}#hero"
                            class="text-gray-600 hover:text-blue-600 font-medium">Beranda</a>
                        <a href="{{ $prefix }}#layanan"
                            class="text-gray-600 hover:text-blue-600 font-medium">Layanan</a>
                        <a href="{{ $prefix }}#berita"
                            class="text-gray-600 hover:text-blue-600 font-medium">Berita</a>
                        <a href="{{ $prefix }}#aparatur"
                            class="text-gray-600 hover:text-blue-600 font-medium">Aparatur</a>
                        <a href="{{ $prefix }}#data-penduduk"
                            class="text-gray-600 hover:text-blue-600 font-medium">Statistik</a  >
                        <a href="{{ $prefix }}#profil"
                            class="text-gray-600 hover:text-blue-600 font-medium">Profil</a>
                        <a href="{{ $prefix }}#kontak"
                            class="text-gray-600 hover:text-blue-600 font-medium">Kontak</a>
                    </nav>
                </div>
                <div class="flex items-center">
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
                <a href="{{ $prefix }}#hero"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                <a href="{{ $prefix }}#layanan"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Layanan</a>
                <a href="{{ $prefix }}#berita"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Berita</a>
                <a href="{{ $prefix }}#profil"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Profil</a>
                <a href="{{ $prefix }}#data-penduduk"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Statistik</a>
                <a href="{{ $prefix }}#kontak"
                    class="text-gray-600 hover:bg-gray-100 block px-3 py-2 rounded-md text-base font-medium">Kontak</a>
            </div>
        </div>
    </header>

    @yield('content')

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
                        <li><a href="#aparatur" class="text-gray-400 hover:text-white">Aparatur</a></li>
                        <li><a href="#data-penduduk" class="text-gray-400 hover:text-white">Statistik</a></li>
                        <li><a href="#profil" class="text-gray-400 hover:text-white">Profil</a></li>
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
                <p>© <span id="year"></span> KKN-T UHO Tahun 2025 Kelurahan Tipulu || Pemerintah Kelurahan Tipulu. All Rights Reserved.</p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi counter untuk statistik penduduk
            function animateCounter(element) {
                if (!element) return;

                const target = parseInt(element.getAttribute('data-target'));
                const duration = 2000; // 2 detik
                const step = target / (duration / 16); // 60fps
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        element.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            }

            // Jalankan animasi counter
            const totalPendudukEl = document.getElementById('total-penduduk');
            const lakiLakiEl = document.getElementById('laki-laki');
            const perempuanEl = document.getElementById('perempuan');

            if (totalPendudukEl) animateCounter(totalPendudukEl);
            if (lakiLakiEl) animateCounter(lakiLakiEl);
            if (perempuanEl) animateCounter(perempuanEl);

            // Data untuk Komposisi Jenis Kelamin
            const genderChartEl = document.getElementById('genderChart');

            if (genderChartEl) {
                const genderData = {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        label: 'Jumlah Jiwa',
                        data: [{{ $totalLakiLaki ?? 30 }}, {{ $totalPerempuan ?? 25 }}],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.8)',
                            'rgba(236, 72, 153, 0.8)'
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(236, 72, 153, 1)'
                        ],
                        borderWidth: 1
                    }]
                };

                const genderConfig = {
                    type: 'doughnut',
                    data: genderData,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw.toLocaleString() +
                                            ' jiwa';
                                    }
                                }
                            }
                        }
                    }
                };

                // Inisialisasi grafik
                const genderChart = new Chart(genderChartEl, genderConfig);
            }

            // Carousel untuk berita
            const carouselInner = document.getElementById('carousel-inner');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            if (carouselInner && prevBtn && nextBtn) {
                let currentIndex = 0;
                const items = document.querySelectorAll('#carousel-inner > div');
                const totalItems = items.length;

                function updateCarousel() {
                    const itemWidth = items[0].offsetWidth;
                    carouselInner.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
                }

                nextBtn.addEventListener('click', () => {
                    if (currentIndex < totalItems - 1) {
                        currentIndex++;
                        updateCarousel();
                    }
                });

                prevBtn.addEventListener('click', () => {
                    if (currentIndex > 0) {
                        currentIndex--;
                        updateCarousel();
                    }
                });

                window.addEventListener('resize', updateCarousel);
            }

            // Animasi scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                    }
                });
            }, observerOptions);

            // Observe semua elemen dengan class fade-in-up
            document.querySelectorAll('.fade-in-up').forEach(el => {
                observer.observe(el);
            });

            // Update tahun di footer
            const yearEl = document.getElementById('year');
            if (yearEl) {
                yearEl.textContent = new Date().getFullYear();
            }
        });
    </script>
</body>

</html>
