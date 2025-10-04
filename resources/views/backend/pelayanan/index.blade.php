@extends('layouts.main')

@push('styles')
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <style>
        /* Responsive table styles */
        @media (max-width: 1024px) {
            .table-responsive {
                font-size: 12px;
            }
            .table-responsive th,
            .table-responsive td {
                padding: 8px 6px !important;
            }
            .table-responsive .action-buttons {
                flex-direction: column;
                gap: 4px;
            }
        }

        @media (max-width: 768px) {
            .table-responsive {
                display: block;
                white-space: nowrap;
            }
            .table-responsive thead {
                font-size: 10px;
            }
            .table-responsive th,
            .table-responsive td {
                padding: 6px 4px !important;
                min-width: 80px;
            }
            .table-responsive .description-col {
                max-width: 120px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
            .table-responsive .requirements-col {
                max-width: 100px;
            }
            .table-responsive .requirements-col span {
                font-size: 9px;
                padding: 2px 4px;
                margin: 1px;
                display: inline-block;
            }
        }

        /* Updated mobile card styles to match persyaratan page */
        .mobile-card-view {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-card-view {
                display: block !important;
            }
            .desktop-table-view {
                display: none !important;
            }
        }

        #openModalBtn {
            position: relative;
            z-index: 50;
            pointer-events: auto;
        }
        .desktop-table-view {
            position: relative;
            z-index: 0;
        }
    </style>
@endpush

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-3 sm:p-6 border border-blue-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 sm:mb-6 gap-3 sm:gap-0">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold text-blue-800 tracking-wide flex items-center gap-2">
                    <i class="fa fa-list-alt text-blue-600"></i> Daftar {{ $title }}
                </h2>
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto relative z-50">
                    <!-- Search form -->
                    <form method="GET" action="{{ route('pelayanan') }}" class="flex w-full sm:w-auto">
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Cari pelayanan / persyaratan..."
                            class="border border-blue-300 rounded-l-lg px-3 py-2 text-sm w-full sm:w-64 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                        <button type="submit"
                            class="bg-blue-600 text-white px-3 py-2 rounded-r-lg hover:bg-blue-700 transition">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <!-- Tombol tambah -->
                    <button id="openModalBtn"
                        class="relative z-50 bg-gradient-to-r from-blue-600 to-blue-500 text-white px-3 sm:px-4 py-2 rounded-lg flex items-center gap-2 hover:from-blue-700 hover:to-blue-600 shadow-md transition text-xs sm:text-sm w-full sm:w-auto justify-center">
                        <i class="fa fa-plus"></i> Pelayanan
                    </button>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="desktop-table-view overflow-x-auto rounded-xl border border-blue-200">
                <table class="min-w-full rounded-xl overflow-hidden table-responsive">
                    <thead class="bg-blue-600 text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-2 sm:px-4 py-3 text-center w-12">No</th>
                            <th class="px-2 sm:px-4 py-3 text-left min-w-32">Nama Pelayanan</th>
                            <th class="px-2 sm:px-4 py-3 text-left w-16">Icon</th>
                            <th class="px-2 sm:px-4 py-3 text-left min-w-40">Deskripsi</th>
                            <th class="px-2 sm:px-4 py-3 text-left min-w-32">Persyaratan</th>
                            <th class="px-2 sm:px-4 py-3 text-center w-20">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm bg-white">
                        @forelse ($pelayanan as $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-2 sm:px-4 py-3 text-center font-semibold text-blue-600">{{ $loop->iteration }}</td>
                                <td class="px-2 sm:px-4 py-3 font-medium">{{ $data->nama }}</td>
                                <td class="px-2 sm:px-4 py-3 text-center">{!! $data->icon !!}</td>
                                <td class="px-2 sm:px-4 py-3 description-col" title="{{ $data->deskripsi }}">{{ $data->deskripsi }}</td>
                                <td class="px-2 sm:px-4 py-3 requirements-col">
                                    @foreach ($data->pelayananPersyaratan as $item)
                                        <span class="px-1 sm:px-2 py-1 bg-blue-500 text-white rounded text-xs mr-1 mb-1 inline-block">{{ $item->persyaratan->nama }}</span>
                                    @endforeach
                                </td>
                                <td class="px-2 sm:px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2 action-buttons">
                                        <a href="{{ route('pelayanan.edit', $data->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110 p-1"
                                            title="Edit">
                                            <i class="fa fa-edit text-sm sm:text-lg"></i>
                                        </a>
                                        <button onclick="confirmDelete('{{ route('pelayanan.delete', $data->id) }}', '{{ $data->nama }}')"
                                            class="text-red-500 hover:text-red-600 transition transform hover:scale-110 p-1"
                                            title="Hapus">
                                            <i class="fa fa-trash text-sm sm:text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-6 text-gray-500">
                                    <i class="fa fa-inbox text-2xl mb-2 block"></i>
                                    Tidak Ada Data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View - Updated to match persyaratan style -->
            <div class="mobile-card-view space-y-3">
                @forelse ($pelayanan as $data)
                    <div class="bg-white rounded-lg border border-blue-200 shadow-sm p-4">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded">
                                        {{ $loop->iteration }}
                                    </span>
                                    <h3 class="font-semibold text-gray-800 text-sm">{{ $data->nama }}</h3>
                                </div>

                                <div class="text-xs text-gray-600 mb-2">
                                    <strong>Icon:</strong>
                                    <div class="mt-1">{!! $data->icon !!}</div>
                                </div>

                                <div class="text-xs text-gray-600 mb-2">
                                    <strong>Deskripsi:</strong>
                                    <div class="mt-1">{{ $data->deskripsi }}</div>
                                </div>

                                <div class="text-xs text-gray-600 mb-3">
                                    <strong>Persyaratan:</strong>
                                    <div class="mt-1 flex flex-wrap gap-1">
                                        @foreach ($data->pelayananPersyaratan as $item)
                                            <span class="px-2 py-1 bg-blue-500 text-white rounded text-xs">{{ $item->persyaratan->nama }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                            <a href="{{ route('pelayanan.edit', $data->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600 transition flex items-center gap-1">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <button onclick="confirmDelete('{{ route('pelayanan.delete', $data->id) }}', '{{ $data->nama }}')"
                                class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition flex items-center gap-1">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg border border-blue-200 p-6 text-center text-gray-500">
                        <i class="fa fa-inbox text-3xl mb-2 text-gray-300"></i>
                        <p>Tidak Ada Data</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

    <!-- Modal Tambah Data -->
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4">
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-2xl w-full max-w-md p-4 sm:p-6 relative transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto"
            id="modalContent">
            <!-- Tombol Close -->
            <button id="closeModalBtn" class="absolute top-3 right-3 sm:top-4 sm:right-4 text-gray-500 hover:text-red-500 transition z-10">
                <i class="fa fa-times text-lg"></i>
            </button>

            <!-- Header Modal -->
            <h3 class="text-lg sm:text-xl font-bold mb-4 sm:mb-5 text-blue-700 flex items-center gap-2 pr-8">
                <i class="fa fa-plus-circle text-blue-500"></i> Tambah Pelayanan
            </h3>

            <!-- Form -->
            <form method="POST" action="{{ route('pelayanan.store') }}">
                @csrf
                <div class="mb-3 sm:mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Pelayanan</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 sm:mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Icon</label>
                    <input type="text" name="icon" value="{{ old('icon') }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm">
                    @error('icon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 sm:mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm resize-vertical">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4 sm:mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Persyaratan</label>
                    <select id="persyaratanSelect" name="persyaratan_id[]" multiple>
                        @foreach ($persyaratan as $item)
                            <option value="{{ $item->id }}"
                                {{ collect(old('persyaratan_id', []))->contains($item->id) ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('persyaratan_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-2 sm:gap-2 mt-4 sm:mt-6">
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

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[9999] p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative transform scale-95 opacity-0 transition-all duration-300"
            id="deleteModalContent">
            <!-- Icon Warning -->
            <div class="text-center mb-4">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fa fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
            </div>

            <!-- Header Modal -->
            <h3 class="text-xl font-bold mb-2 text-gray-900 text-center">
                Konfirmasi Hapus
            </h3>
            <p class="text-sm text-gray-500 text-center mb-6">
                Apakah Anda yakin ingin menghapus pelayanan <strong id="deleteName" class="text-gray-900"></strong>?
            </p>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button type="button" id="cancelDeleteBtn"
                    class="flex-1 bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition text-sm font-medium">
                    Batal
                </button>
                <a href="#" id="confirmDeleteBtn"
                    class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition text-sm font-medium text-center">
                    Ya, Hapus
                </a>
            </div>
        </div>
    </div>


@push('scripts')
    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize TomSelect
            new TomSelect("#persyaratanSelect", {
                plugins: ['remove_button'],
                persist: false,
                create: false,
                maxItems: null,
                sortField: {
                    field: "text",
                    direction: "asc"
                },
            });

            // Modal functionality
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');
            const openModalBtn = document.getElementById('openModalBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const closeModalBtn2 = document.getElementById('closeModalBtn2');

            function openModal() {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
                document.body.style.overflow = 'auto';
            }

            openModalBtn.addEventListener('click', openModal);
            closeModalBtn.addEventListener('click', closeModal);
            closeModalBtn2.addEventListener('click', closeModal);

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });

        // Delete confirmation functionality
        function confirmDelete(url, name) {
            const deleteModal = document.getElementById('deleteModal');
            const deleteModalContent = document.getElementById('deleteModalContent');
            const deleteName = document.getElementById('deleteName');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

            deleteName.textContent = name;
            confirmDeleteBtn.href = url;

            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                deleteModalContent.classList.remove('scale-95', 'opacity-0');
                deleteModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
            document.body.style.overflow = 'hidden';

            function closeDeleteModal() {
                deleteModalContent.classList.remove('scale-100', 'opacity-100');
                deleteModalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    deleteModal.classList.add('hidden');
                }, 300);
                document.body.style.overflow = 'auto';
            }

            cancelDeleteBtn.onclick = closeDeleteModal;

            deleteModal.onclick = function(e) {
                if (e.target === deleteModal) {
                    closeDeleteModal();
                }
            };

            document.addEventListener('keydown', function escHandler(e) {
                if (e.key === 'Escape' && !deleteModal.classList.contains('hidden')) {
                    closeDeleteModal();
                    document.removeEventListener('keydown', escHandler);
                }
            });
        }
    </script>
@endpush
