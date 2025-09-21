@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <!-- Form -->
            <form method="POST" action="{{ route('aparatur.update', $aparatur->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $aparatur->nama) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('nama')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Jabatan</label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $aparatur->jabatan) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('jabatan')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Posisi</label>
                    <input type="number" name="posisi" value="{{ old('posisi', $aparatur->posisi) }}" step="1"
                        min="0"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('posisi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Thumbnail -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Foto</label>

                    <!-- Preview Thumbnail Lama -->
                    @if ($aparatur->foto)
                        <div class="mb-2">
                            <img src="{{ asset($aparatur->foto) }}" alt="Foto lama"
                                class="w-32 h-32 object-cover rounded-lg shadow-md">
                        </div>
                    @endif

                    <input type="file" name="foto" accept="image/*"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 
                               focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('foto')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('berita') }}"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">
                        Back
                    </a>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg 
                               hover:from-blue-700 hover:to-blue-600 shadow-md transition">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
