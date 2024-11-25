@extends('layouts.main')
@section('container')
<style>
    #toast-undo {
        position: fixed;
        top: -100px;  /* Mulai dari atas layar (di luar layar) */
        left: 50%;
        transform: translateX(-50%);  /* Posisikan di tengah secara horizontal */
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.5s ease-in-out, top 0.5s ease-in-out;
    }

    #toast-undo.show {
        opacity: 1;
        top: 20px;  /* Posisi saat tampil (sedikit di bawah atas layar) */
    }

    #toast-undo.hide {
        opacity: 0;
        top: -100px; 
    }
</style>
@if (session('status'))
    <div id="toast-undo" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 hide" role="alert">
        <div class="text-sm font-normal">
            {{ session('status') }}
        </div>
        <div class="flex items-center ms-auto space-x-2 rtl:space-x-reverse">
            <button type="button" class="ms-auto text-sm font-bold -mx-1.5 -my-1.5 p-1.5 inline-flex items-center justify-center h-8 w-8 text-gray-400 hover:text-gray-500" data-dismiss-target="#toast-undo" aria-label="Close">
                Oke
            </button>
        </div>
    </div>
@endif
<div class="mx-auto py-20 max-w-screen-xl">
    <h2 class="text-3xl font-semibold mb-6">Wishlist Anda</h2>

    @if($wishlists->isEmpty())
        <p class="text-lg text-gray-600">Wishlist Anda kosong.</p>
    @else
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
            @foreach ($wishlists as $item)
                <div class="py-6">
                    <div class="flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
                        <a href="{{ route('detail', $item->komik->id) }}" class="flex">
                            <div class="w-1/3 bg-cover bg-center" style="background-image: url('{{ asset($item->komik->photo) }}');">
                            </div> 
                            <div class="w-2/3 p-4">
                                <h1 class="text-gray-900 font-bold text-2xl">{{ $item->komik->title }}</h1>
                                <p class="mt-2 text-gray-600 text-sm">{{ Str::limit($item->komik->description, 50, '...') }}</p>
                            </div>
                        </a>
                        
                        <div >
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown-{{ $item->komik->id }}" class="border text-gray-900 text-md py-1 px-2 mx-2 mt-2 font-bold uppercase rounded hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium" type="button">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <div id="dropdown-{{ $item->komik->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <form action="{{ route('removeWishlist') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="komik_id" value="{{ $item->komik->id }}">
                                            <button type="submit" class="text-left w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Hapus</button>
                                        </form>
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@if (session('status'))
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const toast = document.getElementById('toast-undo');

            // Menampilkan toast dengan animasi dari atas ke bawah
            setTimeout(function() {
                toast.classList.remove('hide');
                toast.classList.add('show');
            }, 100);

            // Menyembunyikan toast dengan animasi dari bawah ke atas setelah beberapa detik (misalnya 5 detik)
            setTimeout(function() {
                toast.classList.remove('show');
                toast.classList.add('hide');
            }, 5000); // 5000 ms = 5 detik
        });
    </script>
@endif
@endsection