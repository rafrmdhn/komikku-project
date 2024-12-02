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
        top: -100px;  /* Toast menghilang kembali ke atas */
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
<section class="text-gray-700 body-font overflow-hidden bg-white mt-20">
    <div class="container px-5 py-24 mx-auto">
        <div class="justify-center mx-auto flex flex-wrap">
            <img alt="{{ $nama_komik }}" class="lg:w-1/2 w-full max-w-xs object-cover object-center rounded border border-gray-200" src="{{ asset($gambar) }}">
            @if ($isInWishlist)
                <form action="{{ route('removeWishlist') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="komik_id" value="{{ $id }}">
                    <button type="submit" class="rounded-full w-10 h-10 bg-red-500 p-0 border-0 inline-flex items-center justify-center text-white ml-4 hover:bg-red-600">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                        </svg>
                    </button>
                </form>
            @else
                <form action="{{ route('addWishlist') }}" method="POST">
                    @csrf
                    <input type="hidden" name="komik_id" value="{{ $id }}">
                    <button type="submit" class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4 hover:text-pink-500 hover:bg-pink-200">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
                        </svg>
                    </button>
                </form>
            @endif
            <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                <h2 class="text-sm title-font text-gray-500 tracking-widest">{{ $category }}</h2>
                <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $nama_komik }}</h1>
                <div class="flex mb-4">
                    <span class="flex items-center">
                        {{-- <span class="text-gray-600">4 Terjual</span> --}}
                    </span>
                </div>
                <p class="leading-relaxed pb-5">{{ $deskripsi }}</p>
                <form action="{{ route('addCart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="komik_id" value="{{ $id }}">
                    <div class="flex justify-end items-center mb-4">
                        <div class="flex items-center max-w-[8rem]">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="jumlah" value="1" min="1" required />
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                
                    <div class="flex">
                        <span class="title-font font-medium text-2xl text-gray-900">Rp{{ number_format($harga, 0, ',', '.') }}</span>    
                        <div class="flex ml-auto">
                            <button class="flex items-center ml-auto text-white bg-blue-600 border-0 py-2 px-6 focus:outline-none hover:bg-blue-700 rounded">
                                <i class="fa-solid fa-plus mr-2"></i>
                                Keranjang
                            </button>
                        </div>
                    </form>
                </div>     
            </div>
        </div>
    </div>
</section>
<section class="pt-20 lg:pt-[10px] pb-10 lg:pb-20">
    <div class="container">
        <div class="flex flex-wrap justify-center -mx-4">
            <div class="w-full px-4">
                <div class="text-center mx-auto mb-[60px] lg:mb-10 max-w-[510px]">
                    <h2 class="font-bold text-3xl sm:text-4xl md:text-[40px] text-dark">
                    Rekomendasi Komik
                    </h2>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-4">
            @foreach ($recommend_komiks as $item)
            <div class="w-full md:w-1/2 lg:w-1/4 px-4">
                <div class="max-w-[370px] mx-auto mb-10">
                    <div class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <a href="/detail/{{ $item->id }}" class="overflow-hidden rounded">
                            <img class="mx-auto h-64 w-44 dark:hidden" src="{{ asset($item->photo) }}" alt="{{ $item->title }}" />
                            <img class="mx-auto hidden h-64 w-44 dark:block" src="{{ asset($item->photo) }}" alt="{{ $item->title }}" />
                        </a>
                        <div>
                            <a href="/detail/{{ $item->id }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $item->title }}</a>
                            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">{{ Str::limit($item->description, 100, '...') }}</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold leading-tight text-gray-900">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="mt-6 flex items-center gap-2.5">
                            @php
                                $isInWishlist = in_array($item->id, $wishlistKomikIds);
                            @endphp
                            @if ($isInWishlist)
                                <form action="{{ route('removeWishlist') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="komik_id" value="{{ $item->id }}">
                                    <button data-tooltip-target="favourites-tooltip-3" type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-red-600 hover:bg-gray-100 hover:text-red-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                                        </svg>
                                    </button>
                                    <div id="favourites-tooltip-3" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                        Tambah ke wishlist
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('addWishlist') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="komik_id" value="{{ $item->id }}">
                                    <button data-tooltip-target="favourites-tooltip-3" type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                                        </svg>
                                    </button>
                                    <div id="favourites-tooltip-3" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                        Tambah ke wishlist
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </form>
                            @endif
                            
                            <form action="{{ route('addCart') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $item->id }}" name="komik_id">
                                <input type="hidden" name="jumlah" value="1" min="1" required />
                                <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600">
                                    <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                    </svg>
                                    Tambah ke Keranjang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>
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