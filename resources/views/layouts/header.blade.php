<header class="bg-white shadow p-4 flex justify-between items-center">
    <h1 id="page-title" class="text-xl font-bold text-gray-800">
        {{ $title }}
    </h1>
    <div class="text-right">
        {{-- Data user akan didapat dari Auth::user() --}}
        <p class="font-semibold">Selamat Datang, {{ auth()->user()->username ?? 'Admin' }}!</p>
        <p id="current-time" class="text-sm text-gray-500"></p>
    </div>
</header>
