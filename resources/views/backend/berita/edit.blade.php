@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <!-- Form -->
            <form method="POST" action="{{ route('berita.update', $berita->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 
                               focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('judul')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="5"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 
                               focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Thumbnail -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Thumbnail</label>

                    <!-- Preview Thumbnail Lama -->
                    @if ($berita->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset($berita->thumbnail) }}" alt="Thumbnail lama"
                                class="w-32 h-32 object-cover rounded-lg shadow-md">
                        </div>
                    @endif

                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 
                               focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('thumbnail')
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
