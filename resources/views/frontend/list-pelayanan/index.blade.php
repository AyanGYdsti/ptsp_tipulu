@extends('layouts.main_frontend')

@section('content')
    <main class="container mx-auto px-4 py-10">
        <h2 class="text-3xl md:text-4xl font-extrabold text-center text-gray-800 mb-12">
            Layanan Kelurahan Tipulu
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($pelayanan as $item)
                <div
                    class="bg-gray-50 p-8 rounded-xl shadow-sm hover:shadow-lg hover:-translate-y-2 transition-all duration-300 fade-in-up">
                    <div class="bg-blue-100 text-blue-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                        {!! $item->icon !!}
                    </div>
                    <h3 class="text-2xl font-bold mb-3">{{ $item->nama }}</h3>
                    <p class="text-gray-600 mb-6">{!! $item->deskripsi !!}</p>
                    <a href="#" class="font-semibold text-blue-600 hover:text-blue-800">Ajukan Sekarang
                        →</a>
                </div>
            @endforeach
        </div>
    </main>
@endsection
