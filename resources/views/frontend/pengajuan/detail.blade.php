@extends('layouts.main_frontend')

@section('content')
    <div style="min-height: 50vh" class="flex flex-col bg-gray-50">
        {{-- Konten utama (form di tengah layar) --}}
        <main class="flex-grow flex items-center justify-center">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">
                    Detail Pengajuan {{ ucfirst($pelayanan->nama) }}
                </h2>

                {{-- Flash success --}}
                @if (session('success'))
                    {{-- Latar Belakang Gelap (Overlay) --}}
                    <div
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
                        aria-labelledby="modal-title"
                        role="dialog"
                        aria-modal="true"
                    >
                        {{-- Kotak Popup --}}
                        <div
                            @click.away="show = false"
                            class="mx-4 w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <div class="text-center">
                                {{-- Ikon Centang --}}
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>

                                {{-- Judul dan Pesan --}}
                                <h3 class="mt-4 text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                    Berhasil!
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        {{ session('success') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="mt-5 sm:mt-6">
                                <a href="{{ route('beranda') }}" {{-- Ganti 'beranda' dengan nama route homepage Anda --}}
                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:text-sm">
                                    Oke, Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Flash error (single message) --}}
                @if (session('error'))
                    <div
                        class="auto-hide mb-6 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg flex items-start justify-between">
                        <div class="flex-1">
                            <p class="font-medium">{{ session('error') }}</p>
                        </div>
                        <button type="button" onclick="this.closest('.auto-hide').remove()"
                            class="ml-4 text-red-600">✕</button>
                    </div>
                @endif

                {{-- Form Pengajuan --}}
                <form action="{{ route('pengajuan.store', $pelayanan->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <input type="hidden" name="nik" value="{{ $masyarakat->nik }}">
                    <input type="hidden" name="pelayanan_id" value="{{ $pelayanan->id }}">

                    {{-- Nama Pengaju --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-600">Nama Pengaju</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $masyarakat->nama) }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan Nama" disabled>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
              @if ($pelayanan->nama == "Surat Keterangan Kematian")
                    {{-- Nama Meninggal --}}
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-600">Nama Meninggal</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan Nama Yang Meninggal" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-600">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('jenis_kelamin') border-red-500 @enderror" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Umur --}}
                    <div>
                        <label for="umur" class="block text-sm font-medium text-gray-600">Umur</label>
                        <input type="number" name="umur" id="umur" value="{{ old('umur') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('umur') border-red-500 @enderror"
                            placeholder="Masukkan Umur" required>
                        @error('umur')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-600">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('alamat') border-red-500 @enderror"
                            placeholder="Masukkan Alamat Lengkap" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Hari --}}
                    <div>
                        <label for="hari" class="block text-sm font-medium text-gray-600">Hari</label>
                        <input type="text" name="hari" id="hari" value="{{ old('hari') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('hari') border-red-500 @enderror"
                            placeholder="Masukkan Hari Meninggal" required>
                        @error('hari')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Meninggal --}}
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-600">Tanggal Meninggal</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('tanggal') border-red-500 @enderror" required>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tempat Meninggal --}}
                    <div>
                        <label for="tempat" class="block text-sm font-medium text-gray-600">Tempat Meninggal</label>
                        <input type="text" name="tempat" id="tempat" value="{{ old('tempat') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('tempat') border-red-500 @enderror"
                            placeholder="Masukkan Tempat Meninggal" required>
                        @error('tempat')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Penyebab --}}
                    <div>
                        <label for="sebab_kematian" class="block text-sm font-medium text-gray-600">Penyebab</label>
                        <input type="text" name="sebab_kematian" id="sebab_kematian" value="{{ old('sebab_kematian') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('sebab_kematian') border-red-500 @enderror"
                            placeholder="Masukkan Penyebab Kematian" required>
                        @error('sebab_kematian')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @elseif ($pelayanan->nama == "Surat Keterangan Pindah Penduduk")
                    {{-- FORM PINDAH PENDUDUK --}}
                    {{-- Desa/Kelurahan --}}
                    <div>
                        <label for="desa_kelurahan" class="block text-sm font-medium text-gray-600">Desa / Kelurahan</label>
                        <input type="text" name="desa_kelurahan" id="desa_kelurahan" value="{{ old('desa_kelurahan') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('desa_kelurahan') border-red-500 @enderror"
                            placeholder="Masukkan Desa / Kelurahan Pindah" required>
                        @error('desa_kelurahan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kecamatan --}}
                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-600">Kecamatan</label>
                        <input type="text" name="kecamatan" id="kecamatan" value="{{ old('kecamatan') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('kecamatan') border-red-500 @enderror"
                            placeholder="Masukkan Kecamatan Pindah" required>
                        @error('kecamatan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kabupaten / Kodya --}}
                    <div>
                        <label for="kab_kota" class="block text-sm font-medium text-gray-600">Kabupaten / Kota</label>
                        <input type="text" name="kab_kota" id="kab_kota" value="{{ old('kab_kota') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('kab_kota') border-red-500 @enderror"
                            placeholder="Masukkan Kabupaten / Kota Pindah" required>
                        @error('kab_kotaa')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Provinsi --}}
                    <div>
                        <label for="provinsi" class="block text-sm font-medium text-gray-600">Provinsi</label>
                        <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('provinsi') border-red-500 @enderror"
                            placeholder="Masukkan Provinsi Pindah" required>
                        @error('provinsi')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Pindah --}}
                    <div>
                        <label for="tanggal_pindah" class="block text-sm font-medium text-gray-600">Tanggal Pindah</label>
                        <input type="date" name="tanggal_pindah" id="tanggal_pindah" value="{{ old('tanggal_pindah') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('tanggal_pindah') border-red-500 @enderror" required>
                        @error('tanggal_pindah')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alasan Pindah --}}
                    <div>
                        <label for="alasan_pindah" class="block text-sm font-medium text-gray-600">Alasan Pindah</label>
                        <textarea name="alasan_pindah" id="alasan_pindah" rows="3"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('alasan_pindah') border-red-500 @enderror"
                            placeholder="Masukkan Alasan Pindah">{{ old('alasan_pindah') }}</textarea>
                        @error('alasan_pindah')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pengikut --}}
                    <div>
                        <label for="pengikut" class="block text-sm font-medium text-gray-600">Pengikut</label>
                        <input type="number" name="pengikut" id="pengikut" value="{{ old('pengikut') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('pengikut') border-red-500 @enderror"
                            placeholder="Masukkan Jumlah Pengikut">
                        @error('pengikut')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                @elseif($pelayanan->nama == "Surat Keterangan Domisili Usaha dan Yayasan")
                    {{-- Nama Usaha / Yayasan --}}
                    <div>
                        <label for="nama_usaha" class="block text-sm font-medium text-gray-600">Nama Usaha / Yayasan</label>
                        <input type="text" name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nama_usaha') border-red-500 @enderror"
                            placeholder="Masukkan Nama Usaha / Yayasan" required>
                        @error('nama_usaha')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="alamat_usaha" class="block text-sm font-medium text-gray-600">Alamat Usaha / Yayasan</label>
                        <textarea name="alamat_usaha" id="alamat_usaha" rows="3"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('alamat_usaha') border-red-500 @enderror"
                            placeholder="Masukkan Alamat Usaha / Yayasan" required>{{ old('alamat_usaha') }}</textarea>
                        @error('alamat_usaha')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jenis_kegiatan_usaha" class="block text-sm font-medium text-gray-600">Jenis Kegiatan Usaha</label>
                        <input type="text" name="jenis_kegiatan_usaha" id="jenis_kegiatan_usaha" value="{{ old('jenis_kegiatan_usaha') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('jenis_kegiatan_usaha') border-red-500 @enderror"
                            placeholder="Masukkan Jenis Kegiatan Usaha" required>
                        @error('jenis_kegiatan_usaha')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="penanggung_jawab" class="block text-sm font-medium text-gray-600">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab" value="{{ old('penanggung_jawab') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('penanggung_jawab') border-red-500 @enderror"
                            placeholder="Masukkan Penanggung Jawab" required>
                        @error('penanggung_jawab')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                @elseif($pelayanan->nama == "Surat Keterangan Memiliki Usaha (SKU)")
                    {{-- Nama Usaha --}}
                    <div>
                        <label for="nama_usaha" class="block text-sm font-medium text-gray-600">Nama Usaha</label>
                        <input type="text" name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nama_usaha') border-red-500 @enderror"
                            placeholder="Masukkan Nama Usaha" required>
                        @error('nama_usaha')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tahun Berdiri --}}
                    <div>
                        <label for="tahun_berdiri" class="block text-sm font-medium text-gray-600">Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" id="tahun_berdiri" value="{{ old('tahun_berdiri') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('tahun_berdiri') border-red-500 @enderror"
                            placeholder="Masukkan Tahun Berdiri Usaha (contoh: 2020)" required>
                        @error('tahun_berdiri')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @elseif ($pelayanan->nama == "Surat Keterangan Tidak Mampu (SKTM)" || $pelayanan->nama == "Surat Keterangan Belum Bekerja")
                    <div>
                        <label for="keperluan" class="block text-sm font-medium text-gray-600">Keperluan</label>
                        <input type="text" name="keperluan" id="keperluan" value="{{ old('keperluan') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('keperluan') border-red-500 @enderror"
                            placeholder="Masukkan Keperluan" required>
                        @error('keperluan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                @endif

                    {{-- Keperluan --}}

                    {{-- Nomor WhatsApp --}}
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-600">Nomor WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('no_hp') border-red-500 @enderror"
                            placeholder="contoh: 081234567890" required>
                        @error('no_hp')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Loop persyaratan --}}
                    @foreach ($pelayanan->pelayananPersyaratan as $item)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $item->persyaratan->nama }}
                            </label>
                            <input type="file" name="dokumen[{{ $item->persyaratan_id }}]" required
                                accept=".pdf,application/pdf"
                                class="block w-full border border-gray-300 rounded-lg shadow-sm text-sm p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    @endforeach

                    {{-- Tombol Submit --}}
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                            Ajukan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
