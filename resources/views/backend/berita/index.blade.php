@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="lg:text-2xl md:text-[12px] font-extrabold text-blue-800 tracking-wide flex items-center gap-2">
                    <i class="fa fa-newspaper text-blue-600"></i> Daftar {{ $title }}
                </h2>
                <button id="openModalBtn"
                    class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-3 py-2 rounded-lg flex items-center gap-2 hover:from-blue-700 hover:to-blue-600 shadow-md transition text-[12px]">
                    <i class="fa fa-plus"></i> Berita
                </button>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto rounded-xl border border-blue-200">
                <table class="min-w-full rounded-xl overflow-hidden">
                    <thead class="bg-blue-600 text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center">No</th>
                            <th class="px-4 py-3 text-left">Judul</th>
                            <th class="px-4 py-3 text-left">Deskripsi</th>
                            <th class="px-4 py-3 text-center">Thumbnail</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm bg-white">
                        @forelse ($berita as $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 text-center font-semibold text-blue-600">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $data->judul }}</td>
                                <td class="px-4 py-3">{!! Str::limit($data->deskripsi, 80) !!}</td>
                                <td class="px-4 py-3 text-center">
                                    @if ($data->thumbnail)
                                        <img src="{{ asset($data->thumbnail) }}" alt="thumb"
                                            class="w-16 h-16 object-cover rounded-lg mx-auto shadow">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('berita.edit', $data->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110"
                                            title="Edit">
                                            <i class="fa fa-edit text-lg"></i>
                                        </a>
                                        <a href="{{ route('berita.delete', $data->id) }}"
                                            class="text-red-500 hover:text-red-600 transition transform hover:scale-110"
                                            title="Hapus">
                                            <i class="fa fa-trash text-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-3">
                                    Tidak ada data berita
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Berita -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-2xl w-full max-w-lg p-6 relative transform scale-95 opacity-0 transition-all duration-300"
            id="modalContent">
            <!-- Tombol Close -->
            <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 transition">
                <i class="fa fa-times text-lg"></i>
            </button>

            <!-- Header Modal -->
            <h3 class="text-xl font-bold mb-5 text-blue-700 flex items-center gap-2">
                <i class="fa fa-plus-circle text-blue-500"></i> Tambah Berita
            </h3>

            <!-- Form -->
            <form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('judul')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Thumbnail</label>
                    <input type="file" name="thumbnail"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
                        accept="image/*">
                    @error('thumbnail')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" id="closeModalBtn2"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-md transition">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
