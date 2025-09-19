<header class="bg-white shadow p-4 flex justify-between items-center">
    <!-- Hamburger hanya tampil di mobile -->
    <button id="hamburger" class="md:hidden text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <h1 id="page-title" class="text-xl font-bold text-gray-800">
        {{ $title }}
    </h1>
    <div class="text-right">
        <p class="font-semibold">Selamat Datang, {{ auth()->user()->username ?? 'Admin' }}!</p>
        <p id="current-time" class="text-sm text-gray-500"></p>
    </div>
</header>
