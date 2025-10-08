@extends('layouts.main')

@section('content')
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card: Pelayanan -->
            <div
                class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl p-5 flex items-center space-x-4 ring-1 ring-slate-100 hover:shadow-lg transition">
                <div class="flex-shrink-0 p-3 rounded-full bg-emerald-50 dark:bg-emerald-900/20">
                    <!-- Icon (clipboard/check) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12l2 2 4-4m1-5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-300">Pelayanan</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white" aria-live="polite">
                                {{ number_format($jumlahPelayanan ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-slate-400">Total jenis layanan aktif</p>
                </div>
            </div>

            <!-- Card: Pengajuan -->
            <div
                class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl p-5 flex items-center space-x-4 ring-1 ring-slate-100 hover:shadow-lg transition">
                <div class="flex-shrink-0 p-3 rounded-full bg-amber-50 dark:bg-amber-900/20">
                    <!-- Icon (inbox/arrow) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 7v6a2 2 0 002 2h3l2 3h4l2-3h3a2 2 0 002-2V7M8 7V5a4 4 0 118 0v2" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-300">Pengajuan</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white" aria-live="polite">
                                {{ number_format($jumlahPengajuan ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-slate-400">Jumlah pengajuan masuk</p>
                </div>
            </div>


            {{-- Card: Aparatur --}}

            <div
                class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl p-5 flex items-center space-x-4 ring-1 ring-slate-100 hover:shadow-lg transition">
                <div class="flex-shrink-0 p-3 rounded-full bg-red-50 dark:bg-red-900/20">
                    <!-- Icon (user-group) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m0 0a4 4 0 100-8 4 4 0 000 8zm6 0a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-300">Aparatur</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white" aria-live="polite">
                                {{ number_format($jumlahAparatur ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Penduduk -->
            <div
                class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl p-5 flex items-center space-x-4 ring-1 ring-slate-100 hover:shadow-lg transition">
                <div class="flex-shrink-0 p-3 rounded-full bg-indigo-50 dark:bg-indigo-900/20">
                    <!-- Icon (people) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 20h5v-1a4 4 0 00-4-4h-1M9 20H4v-1a4 4 0 014-4h1m0 0a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-300">Jumlah Penduduk</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white" aria-live="polite">
                                {{ number_format($jumlahMasyarakat ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-slate-400">Data ter-update terakhir</p>
                </div>
            </div>
            
            {{-- card jumlah laki - laki --}}
            <div
                class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl p-5 flex items-center space-x-4 ring-1 ring-slate-100 hover:shadow-lg transition">
                <div class="flex-shrink-0 p-3 rounded-full bg-red-50 dark:bg-blue-900/20">
                    <!-- Icon (user-group) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M16 3h5v5m0-5l-7 7m2 4a5 5 0 11-10 0 5 5 0 0110 0z" />
                    </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-300">Total Warga Laki - Laki</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white" aria-live="polite">
                                {{ number_format($totalLakiLaki ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            {{-- card jumlah perempuan --}}
            <div
                class="bg-white dark:bg-slate-800 shadow-sm rounded-2xl p-5 flex items-center space-x-4 ring-1 ring-slate-100 hover:shadow-lg transition">
                <div class="flex-shrink-0 p-3 rounded-full bg-red-50 dark:bg-blue-900/20">
                    <!-- Icon (user-group) -->
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 4a5 5 0 110 10 5 5 0 010-10zm0 10v6m-3-3h6" />
                </svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-300">Total Warga Perempuan</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900 dark:text-white" aria-live="polite">
                                {{ number_format($totalPerempuan ?? 0, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
