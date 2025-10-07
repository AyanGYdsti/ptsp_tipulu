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
        <a href="{{ route('auth.logout') }}" onclick="return confirm('Apakah Anda Yakin Ingin Logout?')"
            class="flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md">🚪 Logout</a>
    </div>
</div>

<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden z-40"></div>

@push('scripts')
<script>
    function toggleDropdown(id) {
        const dropdown = document.getElementById(id);
        const chevron = document.getElementById(id.replace("Dropdown", "Chevron"));
        dropdown.classList.toggle("hidden");
        chevron.classList.toggle("rotate-180");
    }
</script>
@endpush
