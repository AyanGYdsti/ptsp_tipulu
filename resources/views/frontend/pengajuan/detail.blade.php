@extends('layouts.main_frontend')

@section('content')
    <div style="min-height: 50vh" class="flex flex-col bg-gray-50">
        {{-- Konten utama (form di tengah layar) --}}
        <main class="flex-grow flex items-center justify-center">
            <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold text-gray-700 mb-6 text-center">
                    Detail Pengajuan {{ ucfirst($pelayanan->nama) }}
                </h2>

                {{-- Form Pengajuan --}}
                <form action="{{ route('pengajuan.store', $pelayanan->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-5">
                    @csrf

                    <input type="hidden" name="nik" value="{{ $masyarakat->nik }}">

                    <input type="hidden" name="pelayanan_id" value="{{ $pelayanan->id }}">

                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-600">Nama Pengaju</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $masyarakat->nama) }}"
                            class="mt-2 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nama') border-red-500 @enderror"
                            placeholder="Masukkan Nama" disabled>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Loop persyaratan --}}
                    @foreach ($pelayanan->pelayananPersyaratan as $item)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                {{ $item->persyaratan->nama }}
                            </label>
                            <input type="file" name="dokumen[{{ $item->id }}]" required accept=".pdf,application/pdf"
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
