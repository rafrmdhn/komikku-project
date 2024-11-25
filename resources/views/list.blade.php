@extends('layouts.main')
@section('container')

<div class="py-20 max-w-4xl mx-auto p-5">
    @if (!empty($search))
        <h2 class="text-xl font-semibold mb-4">Hasil pencarian untuk: "{{ $search }}"</h2>
    @else
        <h2 class="text-lg font-bold mb-4">Filter Komik:</h2>
        <div class="flex space-x-4 mb-6">
            <a href="{{ route('daftar.komik') }}" class="px-4 py-2 bg-gray-200 rounded shadow hover:bg-gray-300">Semua</a>
            @foreach ($categories as $category)
                <a href="{{ route('daftar.komik', ['kategori' => $category->name]) }}" class="px-4 py-2 bg-gray-200 rounded shadow hover:bg-gray-300">{{ $category->name }}</a>
            @endforeach
        </div>
        <h2 class="text-xl font-bold mb-4">Daftar Komik</h2>
    @endif
    <div class="grid grid-cols-2 gap-6 mb-6">
        @foreach ($komiks as $komik)
            <a href="/detail/{{ $komik->id }}" class="bg-white rounded-lg border shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 ease-in-out">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <img class="h-32 w-32 object-cover" src="{{ asset('storage/' . $komik->photo) }}" alt="Event image">
                    </div>
                    <div class="p-2">
                        <p class="text-xs text-gray-400">{{ $komik->author }}</p>
                        <div class="text-sm font-bold text-indigo-500">{{ $komik->title }}</div>
                        <p class="text-sm text-black">{{ Str::limit($komik->description, 30) }}</p>
                        <p class="mt-1 text-xs text-gray-500">Update {{ $komik->updated_at->diffForHumans() }}</p>
                        <p class="mt-1 text-md font-bold text-black">Rp{{ number_format($komik->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{ $komiks->links() }}
</div>

@endsection
