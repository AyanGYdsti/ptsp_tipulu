<!-- Sidebar -->
<div id="sidebar"
    class="w-64 bg-gray-800 text-white flex flex-col fixed h-full transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">

    <div class="p-4 border-b border-gray-700 flex items-center gap-3">
        <img src="https://placehold.co/40x40/3B82F6/FFFFFF?text=KT" alt="Logo" class="rounded-full">
        <div>
            <h2 class="text-lg font-bold">Kel. Tipulu</h2>
            <p class="text-xs text-gray-400">Dasbor Admin</p>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
        <a href="{{ route('dashboard') }}"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md {{ $title == 'Dashboard' ? 'active' : '' }}"><i
                class="fa fa-home"></i>
            Dashboard</a>
        <!-- Dropdown Master Data -->
        <div class="space-y-1">
            <button type="button"
                class="w-full flex items-center justify-between px-3 py-2 rounded-md hover:bg-blue-600 focus:outline-none transition"
                onclick="toggleDropdown('masterDataDropdown')">
                <span class="flex items-center gap-3">
                    <i class="fa fa-gears"></i>
                    Master Data
                </span>
                <svg id="masterDataChevron" class="w-4 h-4 transform transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Isi dropdown -->
            <div id="masterDataDropdown" class="ml-8 space-y-1 hidden">
                <a href="{{ route('persyaratan') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm">Persyaratan</a>
                <a href="{{ route('pelayanan') }}"
                    class="block px-3 py-2 rounded-md hover:bg-blue-500 text-sm">Pelayanan</a>
            </div>
        </div>
        <a href="#" class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md">📰
            Berita</a>
    </nav>

    <div class="mt-auto p-4 border-t border-gray-700">
        <a href="#" class="flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md">🚪 Logout</a>
    </div>
</div>

<!-- Overlay untuk mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden z-40"></div>

@push('scripts')
    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            const chevron = document.getElementById(id.replace("Dropdown", "Chevron"));
            if (dropdown.classList.contains("hidden")) {
                dropdown.classList.remove("hidden");
                chevron.classList.add("rotate-180");
            } else {
                dropdown.classList.add("hidden");
                chevron.classList.remove("rotate-180");
            }
        }
    </script>
@endpush
