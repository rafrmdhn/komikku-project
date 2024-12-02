@extends('layouts.main')
@section('container')
    <!-- component -->
<div class="py-20 max-w-screen-lg mx-auto p-5">
    <div class="container">
        <div class="mx-auto max-w-4xl sm:text-center">
            <img src="storage/images/komik.png" class="w-40 mx-auto" alt="">
            <h2 class="md:text-5xl text-3xl font-semibold tracking-tight">Komik Terbaru</h2>
            <div class="flex justify-center">
                <p class="md:w-1/2 mt-6 text-xl/8 font-medium text-gray-500 dark:text-gray-400">Temukan komik yang sesuai dengan anda.</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 grikd-cols-1 gap-6 mt-16">
            @foreach ($komiks as $item)
                <div>
                    <div class="p-7 rounded-md border bg-gray-50 shadow-md dark:bg-neutral-700/70">
                        <img src="{{ asset($item->photo) }}" alt="{{ $item->title }}" width="200" class="justify-items-center mx-auto mb-2">
                        <h3 class="text-xl font-semibold mb-2">{{ $item->title }}</h3>
                        <p class="font-medium leading-7 text-gray-500 mb-6 dark:text-gray-400">{{ Str::limit($item->description, 100, '...') }}</p>
                        <a href="/detail/{{ $item->id }}" class="py-3 flex items-center justify-center w-full font-semibold rounded-lg bg-blue-700 hover:bg-blue-800 text-white transition-all duration-500 gap-2">
                            <i class="fa-solid fa-eye"></i>
                            Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection