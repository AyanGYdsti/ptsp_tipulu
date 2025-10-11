<!-- Sidebar -->
<div id="sidebar"
    class="w-64 bg-gray-800 text-white flex flex-col fixed h-full transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">

   <div class="p-5 border-b border-gray-700 flex items-center gap-4">
        <div class="bg-gray-800 p-2 rounded-xl flex items-center justify-center">
            <img src="/assets/img/APP%20LOGO.png" 
                alt="Logo" 
                class="w-14 h-14 sm:w-16 sm:h-16 object-contain rounded-lg shadow-md">
        </div>
        <div class="flex flex-col">
            <h2 class="text-lg font-semibold text-white leading-tight">Kel. Tipulu</h2>
            <p class="text-xs text-gray-400">Dasbor Admin</p>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-blue-600 {{ $title == 'Dashboard' ? 'bg-blue-600' : '' }}">
            <i class="fa fa-home"></i> Dashboard
        </a>

        {{-- Master Data --}}
        @php
            // Tentukan apakah salah satu submenu sedang aktif
            $masterActive = in_array($title, ['Masyarakat', 'Persyaratan', 'Pelayanan', 'Manajemen Landing Page', 'Berita', 'Aparatur']);
        @endphp

        <div class="space-y-1">
            <button type="button"
                class="w-full flex items-center justify-between px-3 py-2 rounded-md hover:bg-blue-600 focus:outline-none transition {{ $masterActive ? 'bg-blue-600' : '' }}"
                onclick="toggleDropdown('masterDataDropdown')">
                <span class="flex items-center gap-3">
                    <i class="fa fa-gears"></i>
                    Master Data
                </span>
                <svg id="masterDataChevron"
                    class="w-4 h-4 transform transition-transform {{ $masterActive ? 'rotate-180' : '' }}" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="masterDataDropdown"
                class="ml-8 space-y-1 {{ $masterActive ? '' : 'hidden' }}">
                <a href="{{ route('masyarakat') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm {{ $title == 'Masyarakat' ? 'bg-blue-500' : '' }}">Masyarakat</a>
                <a href="{{ route('persyaratan') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm {{ $title == 'Persyaratan' ? 'bg-blue-500' : '' }}">Persyaratan</a>
                <a href="{{ route('pelayanan') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm {{ $title == 'Pelayanan' ? 'bg-blue-500' : '' }}">Pelayanan</a>
                <a href="{{ route('landing-page') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm {{ $title == 'Manajemen Landing Page' ? 'bg-blue-500' : '' }}">Landing Page</a>
                <a href="{{ route('berita') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm {{ $title == 'Berita' ? 'bg-blue-500' : '' }}">Berita</a>
                <a href="{{ route('aparatur') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm {{ $title == 'Aparatur' ? 'bg-blue-500' : '' }}">Aparatur</a>
            </div>
        </div>

        {{-- Pengajuan --}}
        <a href="{{ route('list-pengajuan') }}"
            class="flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md {{ $title == 'List Pengajuan' ? 'bg-blue-600' : '' }}">
            <i class="fa fa-file"></i> Pengajuan
        </a>
    </nav>

    <div class="mt-auto p-4 border-t border-gray-700">
        <a href="{{ route('auth.logout') }}" id="logoutBtn"
            class="flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md cursor-pointer">
            🚪 Logout
        </a>
    </div>
</div>

<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden z-40"></div>

@push('scripts')
<script src="/assets/js/sweetalert.js"></script>
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const chevron = document.getElementById(id.replace("Dropdown", "Chevron"));
        dropdown.classList.toggle("hidden");
        chevron.classList.toggle("rotate-180");
    }

    // Tambahkan CSS custom agar SweetAlert tampil lebih kecil
    const style = document.createElement('style');
    style.innerHTML = `
        .swal2-popup.custom-small {
            width: 280px !important;
            padding: 1.2rem 1rem !important;
            border-radius: 12px !important;
        }
        .swal2-title {
            font-size: 1rem !important;
        }
        .swal2-html-container {
            font-size: 0.8rem !important;
            margin-top: 0.4rem !important;
        }
        .swal2-actions {
            gap: 0.5rem !important;
        }
        .swal2-confirm, .swal2-cancel {
            font-size: 0.8rem !important;
            padding: 0.4rem 0.8rem !important;
            border-radius: 6px !important;
        }
    `;
    document.head.appendChild(style);

    // Event logout SweetAlert
    document.getElementById('logoutBtn').addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin logout?',
            html: `
                <p class="text-gray-300 text-sm">
                    Sesi Anda akan berakhir.
                </p>
            `,
            icon: 'warning',
            background: '#1e293b',
            color: '#e2e8f0',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#6b7280',
            reverseButtons: true,
            focusCancel: true,
            customClass: {
                popup: 'custom-small'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Logout...',
                    html: '<p class="text-gray-300 text-xs">Mohon tunggu sebentar</p>',
                    background: '#1e293b',
                    color: '#e2e8f0',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    customClass: {
                        popup: 'custom-small'
                    },
                    didOpen: () => {
                        Swal.showLoading();
                        setTimeout(() => {
                            window.location.href = "{{ route('auth.logout') }}";
                        }, 1000);
                    }
                });
            }
        });
    });
</script>
@endpush
