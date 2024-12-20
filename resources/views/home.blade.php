@extends('layouts.main')

@section('container')

<style>
    .hide-scroll-bar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
    .hide-scroll-bar::-webkit-scrollbar {
      display: none;
    }
    #toast-undo {
        position: fixed;
        top: -100px; 
        left: 50%;
        transform: translateX(-50%); 
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.5s ease-in-out, top 0.5s ease-in-out;
    }

    #toast-undo.show {
        opacity: 1;
        top: 20px; 
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
<section class="bg-white mt-20">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">Jelajahi Dunia Fantasi Tanpa Batas!</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Temukan ribuan komik seru dari berbagai genre, semua dalam genggamanmu. Baca sekarang dan rasakan petualangannya!</p>
            <a href="#" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                Mulai
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="storage/images/komik.png" alt="komik">
        </div>                
    </div>
</section>

<div class="w-10/12 grid grid-cols-1 md:grid-cols-3 gap-6 mx-auto justify-center">
    <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
        <img src="icons/delivery-van.svg" alt="Delivery" class="w-12 h-12 object-contain">
        <div>
            <h4 class="font-medium capitalize text-lg">Transaksi Cepat</h4>
            <p class="text-gray-500 text-sm">Pengalaman transaksi yang cepat</p>
        </div>
    </div>
    <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
        <img src="icons/money-back.svg" alt="Delivery" class="w-12 h-12 object-contain">
        <div>
            <h4 class="font-medium capitalize text-lg">Jaminan Uang Kembali</h4>
            <p class="text-gray-500 text-sm">Maksimal 30 hari uang kembali</p>
        </div>
    </div>
    <div class="border border-primary rounded-sm px-3 py-6 flex justify-center items-center gap-5">
        <img src="icons/service-hours.svg" alt="Delivery" class="w-12 h-12 object-contain">
        <div>
            <h4 class="font-medium capitalize text-lg">Dukungan 24/7</h4>
            <p class="text-gray-500 text-sm">Dukungan pelanggan</p>
        </div>
    </div>
</div>

<div class="flex flex-col bg-white m-auto p-auto mt-20">
    <h1 class="flex py-5 justify-center font-bold text-4xl text-gray-800 mb-[60px] lg:mb-10">
        Komik Populer
    </h1>
        <div class="flex overflow-x-scroll pb-10 hide-scroll-bar">
            <div class="flex flex-nowrap lg:ml-40 md:ml-20 ml-10 ">
                @foreach ($komik_populer as $item)
                    <div class="inline-block px-3">
                        <a href="/detail/{{ $item->id }}">
                            <div class="w-80 h-[360px] max-w-xs overflow-hidden rounded-lg border shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                <div class="bg-white relative shadow-lg hover:shadow-xl transition duration-500 rounded-lg">
                                    <img class="rounded-t-lg bg-auto mx-auto w-64 h-64 object-contain" src="{{ $item->photo }}" alt="{{ $item->title }}" />
                                    <div class="py-6 px-8 rounded-lg bg-white">
                                        <h1 class="text-gray-700 font-bold text-2xl hover:text-gray-900">{{ $item->title }}</h1>
                                        <p class="text-gray-700 tracking-wide">{{ $item->author }}</p>
                                    </div>
                                    <div class="absolute top-2 right-2 py-2 px-4 bg-white rounded-lg">
                                        <span class="text-md">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>            
        </div>
</div>

<section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20">
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
            @foreach ($recommends as $item)
                <div class="w-full md:w-1/2 lg:w-1/4 px-4">
                    <div class="max-w-[370px] mx-auto mb-10">
                        <div class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <a href="/detail/{{ $item->id }}" class="overflow-hidden rounded">
                                <img class="mx-auto h-64 w-44 dark:hidden" src="{{ asset($item->photo) }}" alt="imac image" />
                                <img class="mx-auto hidden h-44 w-44 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg" alt="imac image" />
                            </a>
                            <div>
                                <a href="/detail/{{ $item->id }}" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">{{ $item->title }}</a>
                                <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">{{ Str::limit($item->description, 100, '...') }}</p>
                            </div>
                            <div>
                                <p class="text-lg font-bold leading-tight text-gray-900">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="mt-6 flex items-center gap-2.5">
                                @if (in_array($item->id, $wishlistKomikIds))
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

            setTimeout(function() {
                toast.classList.remove('hide');
                toast.classList.add('show');
            }, 100);

            setTimeout(function() {
                toast.classList.remove('show');
                toast.classList.add('hide');
            }, 5000); 
        });
    </script>
@endif
@endsection