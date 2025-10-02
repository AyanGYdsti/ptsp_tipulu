@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card dengan fitur scroll -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200 max-h-[80vh] overflow-y-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-3 sticky top-0 bg-gradient-to-br from-blue-50 to-blue-100 py-2 z-10">
                <h2 class="lg:text-2xl md:text-lg sm:text-base text-sm font-extrabold text-blue-800 tracking-wide flex items-center gap-2">
                    <i class="fa fa-list-alt text-blue-600"></i> Daftar {{ $title }}
                </h2>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <!-- Form Search -->
                    <form method="GET" action="{{ url('/masyarakat') }}" class="flex items-center border rounded-lg overflow-hidden w-full sm:w-auto">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / NIK / alamat..."
                            class="px-3 py-2 text-sm focus:outline-none w-full sm:w-48">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-2">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <!-- Tombol Tambah -->
                    <button id="openModalBtn"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-3 py-2 rounded-lg flex items-center gap-2 hover:from-blue-700 hover:to-blue-600 shadow-md transition text-xs sm:text-sm">
                        <i class="fa fa-plus"></i> <span class="hidden sm:inline">Masyarakat</span>
                    </button>
                </div>
        </div>


            <!-- Tabel dengan scroll horizontal -->
            <div class="overflow-x-auto rounded-xl border border-blue-200">
                <table class="min-w-full rounded-xl overflow-hidden">
                    <thead class="bg-blue-600 text-white uppercase text-xs font-semibold tracking-wider sticky top-0">
                        <tr>
                            <th class="px-2 sm:px-4 py-3 text-center">No</th>
                            <th class="px-2 sm:px-4 py-3 text-left min-w-[200px]">Nama</th>
                            <th class="px-2 sm:px-4 py-3 text-left hidden md:table-cell min-w-[150px]">TTL</th>
                            <th class="px-2 sm:px-4 py-3 text-left hidden lg:table-cell">Status</th>
                            <th class="px-2 sm:px-4 py-3 text-left hidden lg:table-cell">Agama</th>
                            <th class="px-2 sm:px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-xs sm:text-sm bg-white">
                        @forelse ($masyarakat as $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-2 sm:px-4 py-3 text-center font-semibold text-blue-600">{{ $loop->iteration }}</td>
                                <td class="px-2 sm:px-4 py-3">
                                    <div class="d-flex flex-column">
                                        <p class="font-bold text-xs sm:text-sm">{{ $data->nama }}</p>
                                        <p class="opacity-75 text-xs">{{ $data->RT }}</p>
                                        <p class="opacity-75 text-xs">{{ $data->RW }}</p>
                                        <p class="opacity-75 text-xs">{{ $data->nik }}</p>
                                        <p class="opacity-75 text-xs break-words max-w-[200px]">{{ $data->alamat }}</p>
                                        <!-- Info mobile yang tersembunyi di desktop -->
                                        <div class="md:hidden mt-1 space-y-1">
                                            <p class="text-xs text-blue-600"><span class="font-semibold">TTL:</span> {{ $data->tempat_lahir . ', ' . $data->tgl_lahir }}</p>
                                            <div class="lg:hidden">
                                                <p class="text-xs text-green-600"><span class="font-semibold">Status:</span> {{ $data->status }}</p>
                                                <p class="text-xs text-purple-600"><span class="font-semibold">Agama:</span> {{ $data->agama }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 sm:px-4 py-3 hidden md:table-cell text-xs sm:text-sm">{{ $data->tempat_lahir . ', ' . $data->tgl_lahir }}</td>
                                <td class="px-2 sm:px-4 py-3 hidden lg:table-cell text-xs sm:text-sm">{{ $data->status }}</td>
                                <td class="px-2 sm:px-4 py-3 hidden lg:table-cell text-xs sm:text-sm">{{ $data->agama }}</td>
                                <td class="px-2 sm:px-4 py-3">
                                    <div class="flex justify-center items-center gap-1 sm:gap-3">
                                        <a href="{{ route('masyarakat.edit', $data->nik) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110 p-1"
                                            title="Edit">
                                            <i class="fa fa-edit text-sm sm:text-lg"></i>
                                        </a>
                                        <a href="{{ route('masyarakat.delete', $data->nik) }}"
                                            class="text-red-500 hover:text-red-600 transition transform hover:scale-110 p-1"
                                            title="Hapus">
                                            <i class="fa fa-trash text-sm sm:text-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-3 text-xs sm:text-sm">
                                    Tidak Ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data dengan scroll -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto transform scale-95 opacity-0 transition-all duration-300 relative"
            id="modalContent">
            <!-- Tombol Close -->
            <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 transition z-10">
                <i class="fa fa-times text-lg"></i>
            </button>

            <!-- Header Modal -->
            <div class="sticky top-0 bg-gradient-to-br from-white to-blue-50 pt-6 pb-4 border-b border-blue-200 px-6">
                <h3 class="text-lg sm:text-xl font-bold text-blue-700 flex items-center gap-2">
                    <i class="fa fa-plus-circle text-blue-500"></i> Tambah Masyarakat
                </h3>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('masyarakat.store') }}" class="p-4 sm:p-6">
                @csrf
                <div class="space-y-4">
                    <!-- NIK -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik') }}"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('nik')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('nama')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">RT</label>
                        <input type="text" name="RT" value="{{ old('RT') }}"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('RT')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">RW</label>
                        <input type="text" name="RW" value="{{ old('RW') }}"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        @error('RW')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Alamat</label>
                        <textarea name="alamat"
                            class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400" rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Row untuk Tempat dan Tanggal Lahir -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Tempat Lahir -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            @error('tempat_lahir')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ old('tgl_lahir') }}"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            @error('tgl_lahir')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row untuk Status dan Agama -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Status</label>
                            <select name="status"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                                <option value="">-- Pilih Status --</option>
                                <option value="Belum Kawin" {{ old('status') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Agama -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Agama</label>
                            <select name="agama"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Row untuk Pekerjaan dan Jenis Kelamin -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Pekerjaan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                            @error('pekerjaan')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Jenis Kelamin</label>
                            <select name="jk"
                                class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jk')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Tombol -->
                <div class="flex flex-col sm:flex-row justify-end gap-2 mt-6 border-t pt-4 sticky bottom-0 bg-gradient-to-br from-white to-blue-50 pb-2">
                    <button type="button" id="closeModalBtn2"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition text-sm w-full sm:w-auto">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-md transition text-sm w-full sm:w-auto">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript untuk modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const closeModalBtn2 = document.getElementById('closeModalBtn2');

            // Buka modal
            openModalBtn.addEventListener('click', function() {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
            });

            // Tutup modal
            function closeModal() {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }

            closeModalBtn.addEventListener('click', closeModal);
            closeModalBtn2.addEventListener('click', closeModal);

            // Tutup modal ketika klik di luar konten modal
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        });
    </script>
@endsection
