@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <div class="flex justify-between items-center mb-6">
                <h2 class="lg:text-2xl md:text-[12px] font-extrabold text-blue-800 tracking-wide flex items-center gap-2">
                    <i class="fa fa-list-alt text-blue-600"></i> Daftar {{ $title }}
                </h2>
            </div>

            <div class="overflow-x-auto rounded-xl border border-blue-200">
                <table class="min-w-full rounded-xl overflow-hidden">
                    <thead class="bg-blue-600 text-white uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center">No</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Nomor WA</th>
                            <th class="px-4 py-3 text-left">Pelayanan</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm bg-white">
                        @forelse ($pengajuan as $data)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 text-center font-semibold text-blue-600">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $data->masyarakat->nama }}</td>
                                <td class="px-4 py-3">{{ $data->masyarakat->no_hp }}</td>
                                <td class="px-4 py-3">{{ $data->pelayanan->nama }}</td>
                                <td class="px-4 py-3 text-center flex justify-center gap-3">
                                    @if (!$data->verifikasiByAparatur(4)->first())
                                        <button data-id="{{ $data->id }}" data-nama="{{ $data->masyarakat->nama }}"
                                            onclick="openVerifikasiModal(this)"
                                            class="text-blue-500 hover:text-blue-600 transition transform hover:scale-110"
                                            title="Verifikasi">
                                            <i class="fa-solid fa-hand-pointer text-lg"></i>
                                        </button>
                                    @else
                                        <!-- Tombol Cetak -->
                                        <button type="button" onclick="openCetakModal('{{ $data->id }}')"
                                            class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110"
                                            title="Cetak Surat">
                                            <i class="fa-solid fa-print text-lg"></i>
                                        </button>
                                    @endif
                                    <button type="button" onclick="openDokumenModal('{{ $data->id }}')"
                                        class="text-gray-500 hover:text-gray-600 transition transform hover:scale-110"
                                        title="Detail Dokumen Pengajuan">
                                        <i class="fa-solid fa-eye text-lg"></i>
                                    </button>

                                    <!-- Modal Dokumen -->
                                    <div id="dokumenModal{{ $data->id }}"
                                        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                                        <div
                                            class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 transform transition-all scale-95 animate-fadeIn relative">

                                            <!-- Header -->
                                            <div class="flex items-center mb-4">
                                                <div
                                                    class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mr-3">
                                                    <i class="fa-solid fa-file-pdf text-2xl"></i>
                                                </div>
                                                <div>
                                                    <h2 class="text-lg font-bold text-gray-800">Detail Dokumen Pengajuan
                                                    </h2>
                                                    <p class="text-sm text-gray-500">Daftar dokumen persyaratan</p>
                                                </div>
                                                <button onclick="closeDokumenModal('{{ $data->id }}')"
                                                    class="absolute top-4 right-4 text-gray-500 hover:text-red-500">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>

                                            <!-- Isi Dokumen -->
                                            <div class="border-t border-gray-200 pt-4 max-h-[400px] overflow-y-auto">
                                                @if ($data->pelayanan && $data->dokumenPersyaratan->count())
                                                    @foreach ($data->dokumenPersyaratan as $i => $doc)
                                                        <div
                                                            class="flex justify-between items-center p-2 border rounded mb-2">
                                                            <span class="text-gray-700 text-sm">{{ $i + 1 }}.
                                                                {{ $doc->persyaratan->nama }}</span>
                                                            <a href="{{ route('list-pengajuan.stream', ['persyaratan_id' => $doc->persyaratan_id, 'pengajuan_id' => $doc->pengajuan_id]) }}"
                                                                target="_blank"
                                                                class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                                                <i class="fa fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p class="text-gray-500 text-sm">Tidak ada dokumen</p>
                                                @endif
                                            </div>

                                            <!-- Footer -->
                                            <div class="mt-6 flex justify-end">
                                                <button type="button" onclick="closeDokumenModal('{{ $data->id }}')"
                                                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-3">Tidak Ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div id="verifikasiModal"
                class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6 transform transition-all scale-95 animate-fadeIn">
                    <!-- Header -->
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mr-3">
                            <i class="fa-solid fa-circle-check text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Verifikasi Pengajuan</h2>
                            <p class="text-sm text-gray-500">Konfirmasi pengajuan masyarakat</p>
                        </div>
                    </div>

                    <!-- Isi -->
                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Apakah Anda ingin <span class="font-semibold text-green-600">memverifikasi</span> atau
                            <span class="font-semibold text-red-600">menolak</span> pengajuan atas nama
                            <span id="namaMasyarakat" class="font-semibold text-blue-600"></span>?
                        </p>
                    </div>

                    <!-- Form -->
                    <form id="formVerifikasi" method="POST" class="mt-6">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" id="statusPengajuan">

                        <div class="flex justify-end gap-3">
                            <button type="button" onclick="closeVerifikasiModal()"
                                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">
                                Batal
                            </button>
                            <button type="submit" onclick="setStatus('Ditolak')"
                                class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 shadow-md transition">
                                <i class="fa-solid fa-xmark mr-1"></i> Tolak
                            </button>
                            <button type="submit" onclick="setStatus('Terverifikasi')"
                                class="px-4 py-2 rounded-lg bg-green-500 text-white hover:bg-green-600 shadow-md transition">
                                <i class="fa-solid fa-check mr-1"></i> Verifikasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Cetak -->
            <div id="cetakModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div
                    class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 transform transition-all scale-95 animate-fadeIn relative">

                    <!-- Header -->
                    <div class="flex items-center mb-4">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                            <i class="fa-solid fa-print text-2xl"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Cetak Surat</h2>
                            <p class="text-sm text-gray-500">Lengkapi data sebelum cetak</p>
                        </div>
                        <button onclick="closeCetakModal()"
                            class="absolute top-4 right-4 text-gray-500 hover:text-red-500">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                    <!-- Form -->
                    <form id="formCetak" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Tanggal Cetak</label>
                            <input type="date" name="tgl_cetak" required
                                class="w-full border border-yellow-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                        </div>

                        <div class="mb-3">
                            <label class="block text-sm font-semibold text-gray-600 mb-1">Penanda Tangan</label>
                            <select name="aparatur_id" required
                                class="w-full border border-yellow-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400">
                                <option value="">-- Pilih --</option>
                                @foreach ($aparaturs as $aparatur)
                                    <option value="{{ $aparatur->id }}">{{ $aparatur->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Footer -->
                        <div class="flex justify-end gap-3 mt-6 border-t pt-4">
                            <button type="button" onclick="closeCetakModal()"
                                class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 rounded-lg bg-yellow-500 text-white hover:bg-yellow-600 shadow-md">
                                <i class="fa fa-print mr-1"></i> Cetak
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Animasi -->
            <style>
                @keyframes fadeIn {
                    from {
                        opacity: 0;
                        transform: scale(0.95);
                    }

                    to {
                        opacity: 1;
                        transform: scale(1);
                    }
                }

                .animate-fadeIn {
                    animation: fadeIn 0.25s ease-out;
                }
            </style>

            <script>
                // === CETAK MODAL ===
                function openCetakModal(id) {
                    document.getElementById("formCetak").action = "/list-pengajuan/cetak/" + id;
                    document.getElementById("cetakModal").classList.remove("hidden");
                }

                function closeCetakModal() {
                    document.getElementById("cetakModal").classList.add("hidden");
                }

                // === VERIFIKASI MODAL ===
                function openVerifikasiModal(button) {
                    const id = button.getAttribute("data-id");
                    const nama = button.getAttribute("data-nama");
                    document.getElementById("namaMasyarakat").innerText = nama;
                    document.getElementById("formVerifikasi").action = "/list-pengajuan/verifikasi/" + id;
                    document.getElementById("verifikasiModal").classList.remove("hidden");
                }

                function closeVerifikasiModal() {
                    document.getElementById("verifikasiModal").classList.add("hidden");
                }

                // === DOKUMEN MODAL ===
                function openDokumenModal(id) {
                    document.getElementById("dokumenModal" + id).classList.remove("hidden");
                }

                function closeDokumenModal(id) {
                    document.getElementById("dokumenModal" + id).classList.add("hidden");
                }

                function setStatus(status) {
                    document.getElementById("statusPengajuan").value = status;
                }
            </script>

        </div>
    </div>
@endsection
