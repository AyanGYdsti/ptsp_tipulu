@extends('layouts.main')
@push('styles')
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
@endpush

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <!-- Form -->
            <form method="POST" action="{{ route('pelayanan.update', $pelayanan->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Pelayanan</label>
                    <input type="text" name="nama" value="{{ old('nama', $pelayanan->nama) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('nama')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', $pelayanan->icon) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('icon')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Deskripsi</label>
                    <textarea name="deskripsi"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('deskripsi', $pelayanan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Keterangan Surat</label>
                    <textarea name="keterangan-surat"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('keterangan-surat', $pelayanan->keterangan_surat) }}</textarea>
                    @error('keterangan_surat')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Persyaratan</label>
                    <select id="persyaratanSelect" name="persyaratan_id[]" multiple>
                        @foreach ($persyaratan as $item)
                            <option value="{{ $item->id }}" @if (collect(old('persyaratan_id', $pelayanan->pelayananPersyaratan->pluck('persyaratan_id') ?? []))->contains(
                                    $item->id)) selected @endif>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('persyaratan_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('pelayanan') }}"
                        class="bg-gray-400 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">
                        Back
                    </a>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-500 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-blue-600 shadow-md transition">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#persyaratanSelect", {
                plugins: ['remove_button'], // ada tombol hapus tiap pilihan
                persist: false,
                create: false,
                maxItems: null, // unlimited
                sortField: {
                    field: "text",
                    direction: "asc"
                },
            });
        })
    </script>
@endpush
