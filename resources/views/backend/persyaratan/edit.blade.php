@extends('layouts.main')

@section('content')
    <div class="mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 shadow-xl rounded-2xl p-6 border border-blue-200">
            <!-- Form -->
            <form method="POST" action="{{ route('persyaratan.update', $persyaratan->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Nama Persyaratan</label>
                    <input type="text" name="nama" value="{{ old('nama', $persyaratan->nama) }}"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">
                    @error('nama')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Keterangan</label>
                    <textarea name="keterangan"
                        class="w-full border border-blue-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ old('nama', $persyaratan->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('persyaratan') }}"
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
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    // Buka notifikasi Laravel (jika ada error)
    @if ($errors->any())
        tampilkanNotifikasi('Mohon periksa kembali field yang belum diisi dengan benar', 'error');
    @endif

    form.addEventListener('submit', function(e) {
        const nama = form.querySelector('[name="nama"]');
        const ket = form.querySelector('[name="keterangan"]');

        let hasError = false;
        let firstError = null;

        // hapus pesan error lama
        form.querySelectorAll('.error-message-custom').forEach(m => m.remove());

        if (!nama.value.trim()) {
            tampilkanError(nama, 'Nama persyaratan harus diisi');
            hasError = true;
            if (!firstError) firstError = nama;
        }

        if (!ket.value.trim()) {
            tampilkanError(ket, 'Keterangan harus diisi');
            hasError = true;
            if (!firstError) firstError = ket;
        }

        if (hasError) {
            e.preventDefault();
            tampilkanNotifikasi('Mohon lengkapi semua field yang wajib diisi dengan benar', 'error');
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    });

    function tampilkanError(field, pesan) {
        const old = field.parentElement.querySelector('.error-message-custom');
        if (old) old.remove();
        field.classList.add('border-red-500', '!border-red-500');
        field.classList.remove('border-blue-300');

        const err = document.createElement('p');
        err.className = 'error-message-custom text-red-500 text-sm mt-1';
        err.innerHTML = `<i class="fa fa-exclamation-circle"></i> ${pesan}`;
        field.parentElement.appendChild(err);
    }

    // Hapus error ketika user mengetik
    form.querySelectorAll('input, textarea').forEach(el => {
        el.addEventListener('input', () => {
            el.classList.remove('border-red-500', '!border-red-500');
            el.classList.add('border-blue-300');
            const msg = el.parentElement.querySelector('.error-message-custom');
            if (msg) msg.remove();
        });
    });

    // Fungsi notifikasi (sama seperti modal tambah)
    function tampilkanNotifikasi(pesan, tipe = 'error') {
        const oldNotif = document.querySelector('.notifikasi-custom');
        if (oldNotif) oldNotif.remove();

        const notif = document.createElement('div');
        notif.className = 'notifikasi-custom fixed top-4 right-4 px-6 py-4 rounded-lg shadow-2xl z-[10000] animate-slide-in max-w-md';
        if (tipe === 'error') {
            notif.classList.add('bg-red-500', 'text-white');
            notif.innerHTML = `<div class="flex items-center gap-3">
                <i class="fa fa-exclamation-circle text-xl"></i>
                <span class="font-medium">${pesan}</span></div>`;
        } else {
            notif.classList.add('bg-green-500', 'text-white');
            notif.innerHTML = `<div class="flex items-center gap-3">
                <i class="fa fa-check-circle text-xl"></i>
                <span class="font-medium">${pesan}</span></div>`;
        }
        document.body.appendChild(notif);
        setTimeout(() => {
            notif.style.animation = 'slide-out 0.3s ease-out';
            setTimeout(() => notif.remove(), 300);
        }, 5000);
    }
});
</script>
@endsection
