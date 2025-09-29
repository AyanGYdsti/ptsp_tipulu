@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-3 sm:p-6 border border-blue-200">
           <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold text-blue-800 tracking-wide flex items-center gap-2">
                    <i class="fa fa-list-alt text-blue-600"></i> Daftar {{ $title }}
                </h2>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <!-- Form Search -->
                    <form method="GET" action="{{ url('/persyaratan') }}" class="flex items-center border rounded-lg overflow-hidden w-full sm:w-auto">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / keterangan..."
                            class="px-3 py-2 text-sm focus:outline-none w-full sm:w-48">
                        <button type="submit" class="bg-blue-600 text-white px-3 py-2">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <!-- Tombol Tambah -->
                    <button id="openModalBtn"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-3 py-2 rounded-lg flex items-center gap-2 hover:from-blue-700 hover:to-blue-600 shadow-md transition text-xs sm:text-sm w-full sm:w-auto justify-center">
                        <i class="fa fa-plus"></i> <span class="hidden sm:inline">Persyaratan</span>
                    </button>
                </div>
            </div>

            <!-- Tabel Desktop -->
            <div class="hidden md:block overflow-x-auto rounded-xl border border-blue-200">
                <table class="min-w-full rounded-xl overflow-hidden">
                    <thead class="bg-blue-600 text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center">No</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Keterangan</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm bg-white">
                        @forelse ($persyaratan as $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 text-center font-semibold text-blue-600">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $data->nama }}</td>
                                <td class="px-4 py-3">{!! $data->keterangan !!}</td>
                                <td class="px-4 py-3 text-center flex justify-center gap-3">
                                    <a href="{{ route('persyaratan.edit', $data->id) }}"
                                        class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110"
                                        title="Edit">
                                        <i class="fa fa-edit text-lg"></i>
                                    </a>
                                    <a href="{{ route('persyaratan.delete', $data->id) }}"
                                        class="text-red-500 hover:text-red-600 transition transform hover:scale-110"
                                        title="Hapus">
                                        <i class="fa fa-trash text-lg"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-3">
                                    Tidak Ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tabel Mobile (Card Layout) -->
            <div class="block md:hidden space-y-3">
                @forelse ($persyaratan as $data)
                    <div class="bg-white rounded-lg border border-blue-200 shadow-sm p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">
                                        {{ $loop->iteration }}
                                    </span>
                                    <h3 class="font-semibold text-gray-800 text-sm">{{ $data->nama }}</h3>
                                </div>
                                <div class="text-xs text-gray-600 mb-3">
                                    <strong>Keterangan:</strong>
                                    <div class="mt-1">{!! $data->keterangan !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                            <a href="{{ route('persyaratan.edit', $data->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600 transition flex items-center gap-1">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('persyaratan.delete', $data->id) }}"
                                class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition flex items-center gap-1">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg border border-blue-200 p-6 text-center text-gray-500">
                        <i class="fa fa-inbox text-3xl mb-2 text-gray-300"></i>
                        <p>Tidak Ada data</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-2xl w-full max-w-md p-4 sm:p-6 relative transform scale-95 opacity-0 transition-all duration-300"
            id="modalContent">
            <!-- Tombol Close -->
            <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 transition">
                <i class="fa fa-times text-lg"></i>
            </button>

            <!-- Header Modal -->
            <h3 class="text-lg sm:text-xl font-bold mb-5 text-blue-700 flex items-center gap-2 pr-8">
                <i class="fa fa-plus-circle text-blue-500"></i> Tambah Persyaratan
            </h3>

            <!-- Form -->
            <form method="POST" action="{{ route('persyaratan.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Persyaratan</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Keterangan</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-400 resize-vertical">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-2 mt-6">
                    <button type="button" id="closeModalBtn2"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition text-sm order-2 sm:order-1">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-md transition text-sm order-1 sm:order-2">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
