@extends('layouts.main_frontend')

@section('content')
    <div style="min-height: 50vh" class="flex flex-col bg-gray-50">
        {{-- Konten utama (form di tengah layar) --}}
        <main class="flex-grow flex items-center justify-center">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">
                    Detail Pengajuan {{ ucfirst($pelayanan->nama) }}
                </h2>

                {{-- Flash success --}}
                @if (session('success'))
                    {{-- Latar Belakang Gelap (Overlay) --}}
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
                        aria-labelledby="modal-title"
                        role="dialog"
                        aria-modal="true"
                    >
                        {{-- Kotak Popup --}}
                        <div
                            @click.away="show = false"
                            class="mx-4 w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <div class="text-center">
                                {{-- Ikon Centang --}}
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>

                                {{-- Judul dan Pesan --}}
                                <h3 class="mt-4 text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                    Berhasil!
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="mt-5 sm:mt-6">
                                <a href="{{ route('beranda') }}" {{-- Ganti 'beranda' dengan nama route homepage Anda --}}
                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:text-sm">
                                    Oke, Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Flash error (single message) --}}
                @if (session('error'))
                    <div
                        class="auto-hide mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-medium">{{ session('error') }}</p>
                        </div>
                        <button type="button" onclick="this.closest('.auto-hide').remove()"
                            class="ml-4 text-red-600">✕</button>
                    </div>
                @endif

                {{-- Form Pengajuan --}}
                <form action="{{ route('pengajuan.store', $pelayanan->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <input type="hidden" name="nik" value="{{ $masyarakat->nik }}">
                    <input type="hidden" name="pelayanan_id" value="{{ $pelayanan->id }}">

                    {{-- Nama Pengaju --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-600">Nama Pengaju</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $masyarakat->nama) }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan Nama" disabled>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($pelayanan->nama == "Surat Keterangan Kematian")
                        <div>
                            <label for="nama_md" class="block text-sm font-medium text-gray-600">Nama Meninggal</label>
                            <input type="text" name="nama_md" id="nama_md"
                             value=""
                                class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nama_md') border-red-500 @enderror"
                                placeholder="Masukkan Nama Yang Meninggal" required>
                            @error('nama_md')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    {{-- Nomor WhatsApp --}}
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-600">Nomor WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('no_hp') border-red-500 @enderror"
                            placeholder="contoh: 081234567890" required>
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Loop persyaratan --}}
                    @foreach ($pelayanan->pelayananPersyaratan as $item)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $item->persyaratan->nama }}
                            </label>
                            <input type="file" name="dokumen[{{ $item->persyaratan_id }}]" required
                                accept=".pdf,application/pdf"
                                class="block w-full border border-gray-300 rounded-lg shadow-sm text-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    @endforeach

                    {{-- Tombol Submit --}}
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                            Ajukan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
