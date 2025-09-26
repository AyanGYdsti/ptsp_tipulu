@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-4">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-4 sm:p-6 border border-blue-200">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 sm:mb-6 gap-4">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-extrabold text-blue-800 tracking-wide flex items-center gap-2">
                    <i class="fa fa-newspaper text-blue-600 text-lg sm:text-xl"></i>
                    <span class="break-words">Daftar {{ $title }}</span>
                </h2>
                <button id="openModalBtn"
                    class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg flex items-center justify-center gap-2 hover:from-blue-700 hover:to-blue-600 shadow-md transition text-sm sm:text-base whitespace-nowrap">
                    <i class="fa fa-plus"></i>
                    <span class="hidden sm:inline">Tambah </span>Aparatur
                </button>
            </div>

            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto rounded-xl border border-blue-200">
                <table class="min-w-full rounded-xl overflow-hidden">
                    <thead class="bg-blue-600 text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center">Posisi</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Jabatan</th>
                            <th class="px-4 py-3 text-center">Foto</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm bg-white">
                        @forelse ($aparatur as $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 text-center font-semibold text-blue-600">{{ $data->posisi }}</td>
                                <td class="px-4 py-3">{{ $data->nama }}</td>
                                <td class="px-4 py-3">{{ $data->jabatan }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if ($data->foto)
                                        <img src="{{ asset($data->foto) }}" alt="foto_aparatur"
                                            class="w-16 h-16 object-cover rounded-lg mx-auto shadow">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex justify-center items-center gap-3">
                                        <a href="{{ route('aparatur.edit', $data->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110"
                                            title="Edit">
                                            <i class="fa fa-edit text-lg"></i>
                                        </a>
                                        <a href="{{ route('aparatur.delete', $data->id) }}"
                                            class="text-red-500 hover:text-red-600 transition transform hover:scale-110"
                                            title="Hapus">
                                            <i class="fa fa-trash text-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-6 text-gray-500">
                                    <i class="fa fa-inbox text-3xl mb-2 block"></i>
                                    Tidak ada data aparatur
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile & Tablet Card View -->
            <div class="lg:hidden space-y-4">
                @forelse ($aparatur as $data)
                    <div class="bg-white rounded-xl border border-blue-200 shadow-sm p-4 hover:shadow-md transition">
                        <div class="flex items-start gap-4">
                            <!-- Foto -->
                            <div class="flex-shrink-0">
                                @if ($data->foto)
                                    <img src="{{ asset($data->foto) }}" alt="foto_aparatur"
                                        class="w-16 h-16 sm:w-20 sm:h-20 object-cover rounded-lg shadow">
                                @else
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fa fa-user text-gray-400 text-xl"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">
                                        Posisi {{ $data->posisi }}
                                    </span>
                                    <div class="flex gap-2 ml-2">
                                        <a href="{{ route('aparatur.edit', $data->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition p-1"
                                            title="Edit">
                                            <i class="fa fa-edit text-lg"></i>
                                        </a>
                                        <a href="{{ route('aparatur.delete', $data->id) }}"
                                            class="text-red-500 hover:text-red-600 transition p-1"
                                            title="Hapus">
                                            <i class="fa fa-trash text-lg"></i>
                                        </a>
                                    </div>
                                </div>
                                <h3 class="font-semibold text-gray-900 text-lg truncate">{{ $data->nama }}</h3>
                                <p class="text-gray-600 text-sm mt-1 break-words">{{ $data->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl border border-blue-200 p-8 text-center">
                        <i class="fa fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Tidak ada data aparatur</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Tambah Aparatur -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto p-4 sm:p-6 relative transform scale-95 opacity-0 transition-all duration-300"
            id="modalContent">
            <!-- Tombol Close -->
            <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 transition z-10">
                <i class="fa fa-times text-lg"></i>
            </button>

            <!-- Header Modal -->
            <h3 class="text-xl font-bold mb-5 text-blue-700 flex items-center gap-2 pr-8">
                <i class="fa fa-plus-circle text-blue-500"></i> Tambah Aparatur
            </h3>

            <!-- Form -->
            <form method="POST" action="{{ route('aparatur.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Nama <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama') }}" required
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Jabatan <span class="text-red-500">*</span></label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm">
                        @error('jabatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Posisi <span class="text-red-500">*</span></label>
                        <input type="number" name="posisi" value="{{ old('posisi') }}" step="1" min="0" required
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm">
                        @error('posisi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Foto</label>
                        <input type="file" name="foto"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 2MB)</p>
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" id="closeModalBtn2"
                        class="w-full sm:w-auto bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition text-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="w-full sm:w-auto bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-md transition text-sm">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Modal functionality
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modalContent');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtns = document.querySelectorAll('#closeModalBtn, #closeModalBtn2');

        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        });

        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            });
        });

        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        });
    </script>
@endsection
