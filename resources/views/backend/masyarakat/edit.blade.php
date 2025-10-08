@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <!-- Form -->
            <form method="POST" action="{{ route('masyarakat.update', $masyarakat->nik) }}">
                @csrf
                @method('PUT')

                <!-- NIK -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">NIK</label>
                    <input type="text" name="nik" value="{{ old('nik', $masyarakat->nik) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('nik')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $masyarakat->nama) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('nama')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Alamat</label>
                    <textarea name="alamat"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('alamat', $masyarakat->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- RT & RW -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">RT</label>
                        <input type="number" name="RT" value="{{ old('RT', $masyarakat->RT) }}"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('RT')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">RW</label>
                        <input type="number" name="RW" value="{{ old('RW', $masyarakat->RW) }}"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('RW')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tempat Lahir -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $masyarakat->tempat_lahir) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('tempat_lahir')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir', $masyarakat->tgl_lahir) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('tgl_lahir')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
               <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Status</label>
                    <select name="status"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Kawin" {{ old('status', $masyarakat->status) == 'Belum Kawin' ? 'selected' : '' }}>
                            Belum Kawin
                        </option>
                        <option value="Kawin" {{ old('status', $masyarakat->status) == 'Kawin' ? 'selected' : '' }}>
                            Kawin
                        </option>
                        <option value="Kawin Belum Tercatat" {{ old('status', $masyarakat->status) == 'Kawin Belum Tercatat' ? 'selected' : '' }}>
                            Kawin Belum Tercatat
                        </option>
                        <option value="Cerai Mati" {{ old('status', $masyarakat->status) == 'Cerai Mati' ? 'selected' : '' }}>
                            Cerai Mati
                        </option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Pekerjaan -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Pekerjaan</label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $masyarakat->pekerjaan) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('pekerjaan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Agama -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Agama</label>
                    <select name="agama"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam" {{ old('agama', $masyarakat->agama) == 'Islam' ? 'selected' : '' }}>Islam
                        </option>
                        <option value="Kristen" {{ old('agama', $masyarakat->agama) == 'Kristen' ? 'selected' : '' }}>
                            Kristen</option>
                        <option value="Katolik" {{ old('agama', $masyarakat->agama) == 'Katolik' ? 'selected' : '' }}>
                            Katolik</option>
                        <option value="Hindu" {{ old('agama', $masyarakat->agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                        </option>
                        <option value="Budha" {{ old('agama', $masyarakat->agama) == 'Budha' ? 'selected' : '' }}>Budha
                        </option>
                        <option value="Konghucu" {{ old('agama', $masyarakat->agama) == 'Konghucu' ? 'selected' : '' }}>
                            Konghucu</option>
                    </select>
                    @error('agama')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Jenis Kelamin</label>
                    <select name="jk"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('jk', $masyarakat->jk) == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="Perempuan" {{ old('jk', $masyarakat->jk) == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                    @error('jk')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Tombol -->
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('masyarakat') }}"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">
                        Back
                    </a>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-md transition">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
