@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <h2 class="lg:text-2xl md:text-[12px] font-bold text-blue-800 mb-6 flex items-center gap-2">
                <i class="fa fa-building text-blue-600"></i> Form Data Instansi
            </h2>

            <form method="POST" action="{{ route('landing-page.store') }}" class="space-y-5">
                @csrf
                <input type="hidden" name="id" value="{{ $landingPage->id ?? '' }}">
                <!-- Nama Instansi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Instansi</label>
                    <input type="text" name="nama_instansi"
                        value="{{ old('nama_instansi', $landingPage->nama_instansi ?? '') }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('nama_instansi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Slogan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Slogan</label>
                    <textarea name="slogan" rows="2"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('slogan', $landingPage->slogan ?? '') }}</textarea>
                    @error('slogan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('deskripsi', $landingPage->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Visi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Visi</label>
                    <textarea name="visi" rows="3"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('visi', $landingPage->visi ?? '') }}</textarea>
                    @error('visi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Misi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Misi</label>
                    <textarea name="misi" rows="3"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('misi', $landingPage->misi ?? '') }}</textarea>
                    @error('misi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Koordinat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Koordinat</label>
                    <textarea name="koordinat" rows="2"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('koordinat', $landingPage->koordinat ?? '') }}</textarea>
                    @error('koordinat')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" rows="2"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('alamat', $landingPage->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Telpon -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Telpon</label>
                    <input type="text" name="telpon" value="{{ old('telpon', $landingPage->telpon ?? '') }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('telpon')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu Pelayanan -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu Pelayanan</label>
                    <textarea name="waktu_pelayanan" rows="2"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('waktu_pelayanan', $landingPage->waktu_pelayanan ?? '') }}</textarea>
                    @error('waktu_pelayanan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-2 pt-4">
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-md transition">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
