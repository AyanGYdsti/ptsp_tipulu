<!-- Sidebar -->
<div class="w-64 bg-gray-800 text-white flex flex-col fixed h-full">
    <div class="p-4 border-b border-gray-700 flex items-center gap-3">
        <img src="https://placehold.co/40x40/3B82F6/FFFFFF?text=KT" alt="Logo" class="rounded-full">
        <div>
            <h2 class="text-lg font-bold">Kel. Tipulu</h2>
            <p class="text-xs text-gray-400">Dasbor Admin</p>
        </div>
    </div>
    <nav class="flex-1 p-4 space-y-2">
        {{-- Nanti gunakan helper `route()` atau `url()` --}}
        {{-- Contoh: <a href="{{ route('admin.dashboard') }}" ... --}}
        <a href="#" id="nav-ringkasan" onclick="showDashboardPage('ringkasan')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors {{ $title == 'Dashboard' ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg> Dashboard
        </a>
        <a href="#" id="nav-permohonan" onclick="showDashboardPage('permohonan')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                </path>
            </svg> Permohonan Surat
        </a>
        <a href="#" id="nav-berita" onclick="showDashboardPage('berita')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6M7 8h6">
                </path>
            </svg> Manajemen Berita
        </a>
        <a href="#" id="nav-layanan" onclick="showDashboardPage('layanan')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg> Manajemen Layanan
        </a>
        <a href="#" id="nav-konten" onclick="showDashboardPage('Persyaratan')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg> Manajemen Persyaratan
        </a>
        <a href="#" id="nav-kependudukan" onclick="showDashboardPage('kependudukan')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                </path>
            </svg> Data Kependudukan
        </a>
        <a href="#" id="nav-profil" onclick="showDashboardPage('profil')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg> Manajemen Profil
        </a>
        <a href="#" id="nav-konten" onclick="showDashboardPage('konten')"
            class="sidebar-link flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                </path>
            </svg> Konten Statis
        </a>
    </nav>
    <div class="mt-auto p-4 border-t border-gray-700">
        {{-- Ini akan menjadi form POST ke route logout --}}
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="flex items-center gap-3 px-3 py-2 hover:bg-blue-600 rounded-md transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                </path>
            </svg> Logout
        </a>
        <form id="logout-form" action="{{-- route('logout') --}}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
