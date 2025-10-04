@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
                <h2 class="text-lg sm:text-xl lg:text-2xl font-extrabold text-blue-800 tracking-wide flex items-center gap-2">
                    <i class="fa fa-newspaper text-blue-600"></i> Daftar {{ $title }}
                </h2>
                <button id="openModalBtn"
                    class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-3 py-2 rounded-lg flex items-center gap-2 hover:from-blue-700 hover:to-blue-600 shadow-md transition text-sm w-full sm:w-auto justify-center sm:justify-start">
                    <i class="fa fa-plus"></i> Berita
                </button>
            </div>

            <!-- Tabel Desktop -->
            <div class="hidden lg:block overflow-x-auto rounded-xl border border-blue-200">
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
                                        <button onclick="confirmDelete('{{ route('berita.delete', $data->id) }}', '{{ $data->judul }}')"
                                            class="text-red-500 hover:text-red-600 transition transform hover:scale-110"
                                            title="Hapus">
                                            <i class="fa fa-trash text-lg"></i>
                                        </button>
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

            <!-- Tabel Mobile/Tablet - Card Layout -->
            <div class="lg:hidden space-y-4">
                @forelse ($berita as $data)
                    <div class="bg-white rounded-xl border border-blue-200 p-4 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start gap-4">
                            <!-- Thumbnail -->
                            <div class="flex-shrink-0">
                                @if ($data->thumbnail)
                                    <img src="{{ asset($data->thumbnail) }}" alt="thumb"
                                        class="w-16 h-16 object-cover rounded-lg shadow">
                                @else
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">No Image</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-2">
                                    <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-600 text-white rounded-full text-xs font-semibold">
                                        {{ $loop->iteration }}
                                    </span>
                                    <div class="flex gap-3">
                                        <a href="{{ route('berita.edit', $data->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110"
                                            title="Edit">
                                            <i class="fa fa-edit text-lg"></i>
                                        </a>
                                        <button onclick="confirmDelete('{{ route('berita.delete', $data->id) }}', '{{ $data->judul }}')"
                                            class="text-red-500 hover:text-red-600 transition transform hover:scale-110"
                                            title="Hapus">
                                            <i class="fa fa-trash text-lg"></i>
                                        </button>
                                    </div>
                                </div>

                                <h3 class="font-semibold text-gray-800 text-sm mb-2 line-clamp-2">{{ $data->judul }}</h3>
                                <p class="text-gray-600 text-xs leading-relaxed">{!! Str::limit($data->deskripsi, 100) !!}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl border border-blue-200 p-8 text-center">
                        <i class="fa fa-newspaper text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Tidak ada data berita</p>
                    </div>
                @endforelse
            </div>

            <!-- Alternatif: Tabel Horizontal Scroll untuk Tablet -->
            <div class="hidden md:block lg:hidden overflow-x-auto rounded-xl border border-blue-200">
                <table class="min-w-full rounded-xl overflow-hidden">
                    <thead class="bg-blue-600 text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-3 py-2 text-center">No</th>
                            <th class="px-3 py-2 text-left min-w-[150px]">Judul</th>
                            <th class="px-3 py-2 text-left min-w-[200px]">Deskripsi</th>
                            <th class="px-3 py-2 text-center min-w-[80px]">Thumbnail</th>
                            <th class="px-3 py-2 text-center min-w-[100px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm bg-white">
                        @forelse ($berita as $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-3 py-2 text-center font-semibold text-blue-600">{{ $loop->iteration }}</td>
                                <td class="px-3 py-2">{{ $data->judul }}</td>
                                <td class="px-3 py-2">{!! Str::limit($data->deskripsi, 60) !!}</td>
                                <td class="px-3 py-2 text-center">
                                    @if ($data->thumbnail)
                                        <img src="{{ asset($data->thumbnail) }}" alt="thumb"
                                            class="w-12 h-12 object-cover rounded-lg mx-auto shadow">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('berita.edit', $data->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition"
                                            title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete('{{ route('berita.delete', $data->id) }}', '{{ $data->judul }}')"
                                            class="text-red-500 hover:text-red-600 transition"
                                            title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
    <div id="modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-2xl w-full max-w-3xl p-6 relative transform scale-95 opacity-0 transition-all duration-300 max-h-[90vh] overflow-y-auto"
            id="modalContent">
            <!-- Tombol Close -->
            <button id="closeModalBtn" class="absolute top-4 right-4 text-gray-500 hover:text-red-500 transition">
                <i class="fa fa-times text-lg"></i>
            </button>

            <!-- Header Modal -->
            <h3 class="text-xl font-bold mb-5 text-blue-700 flex items-center gap-2 pr-8">
                <i class="fa fa-plus-circle text-blue-500"></i> Tambah Berita
            </h3>

            <!-- Form -->
            <form method="POST" action="{{ route('berita.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Judul Berita</label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm">
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Deskripsi</label>
                    <textarea id="editor" name="deskripsi" rows="4"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm resize-vertical">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Thumbnail</label>
                    <input type="file" name="thumbnail"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-sm"
                        accept="image/*">
                    @error('thumbnail')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
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

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 relative transform scale-95 opacity-0 transition-all duration-300"
            id="deleteModalContent">
            <!-- Icon Warning -->
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fa fa-exclamation-triangle text-red-500 text-3xl"></i>
                </div>
            </div>

            <!-- Header Modal -->
            <h3 class="text-xl font-bold mb-3 text-gray-800 text-center">
                Konfirmasi Hapus
            </h3>

            <!-- Message -->
            <p class="text-gray-600 text-center mb-6">
                Apakah Anda yakin ingin menghapus berita<br>
                <strong id="deleteItemName" class="text-gray-800"></strong>?
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <button type="button" id="cancelDeleteBtn"
                    class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition text-sm">
                    Batal
                </button>
                <a id="confirmDeleteBtn" href="#"
                    class="bg-gradient-to-r from-red-600 to-red-500 text-white px-6 py-2 rounded-lg hover:from-red-700 hover:to-red-600 shadow-md transition text-sm text-center">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </div>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <!-- TinyMCE CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>

    <script>
        // Inisialisasi TinyMCE
        let editorInstance = null;

        function initEditor() {
            if (editorInstance) {
                tinymce.remove('#editor');
            }

            tinymce.init({
                selector: '#editor',
                height: 300,
                menubar: false,
                plugins: [
                    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                    'insertdatetime', 'media', 'table', 'help', 'wordcount'
                ],
                toolbar: 'undo redo | blocks | ' +
                    'bold italic forecolor backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
                skin: 'oxide',
                content_css: 'default',
                language: 'id',
                branding: false,
                setup: function(editor) {
                    editorInstance = editor;
                }
            });
        }

        // Modal Tambah Berita
        const modal = document.getElementById('modal');
        const modalContent = document.getElementById('modalContent');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const closeModalBtn2 = document.getElementById('closeModalBtn2');

        openModalBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
                // Inisialisasi editor ketika modal dibuka
                initEditor();
            }, 10);
        });

        [closeModalBtn, closeModalBtn2].forEach(btn => {
            btn.addEventListener('click', () => {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    // Hapus instance editor ketika modal ditutup
                    if (editorInstance) {
                        tinymce.remove('#editor');
                        editorInstance = null;
                    }
                }, 300);
            });
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modalContent.classList.remove('scale-100', 'opacity-100');
                modalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    if (editorInstance) {
                        tinymce.remove('#editor');
                        editorInstance = null;
                    }
                }, 300);
            }
        });

        // Modal Konfirmasi Hapus
        const deleteModal = document.getElementById('deleteModal');
        const deleteModalContent = document.getElementById('deleteModalContent');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteItemName = document.getElementById('deleteItemName');

        function confirmDelete(url, itemName) {
            deleteItemName.textContent = itemName;
            confirmDeleteBtn.href = url;

            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                deleteModalContent.classList.remove('scale-95', 'opacity-0');
                deleteModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        cancelDeleteBtn.addEventListener('click', () => {
            deleteModalContent.classList.remove('scale-100', 'opacity-100');
            deleteModalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
            }, 300);
        });

        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                deleteModalContent.classList.remove('scale-100', 'opacity-100');
                deleteModalContent.classList.add('scale-95', 'opacity-0');
                setTimeout(() => {
                    deleteModal.classList.add('hidden');
                }, 300);
            }
        });
    </script>
@endsection
