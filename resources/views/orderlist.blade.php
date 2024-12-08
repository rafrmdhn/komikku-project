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
<section class="py-24 relative">
    <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
        <h2 class="font-manrope font-extrabold text-3xl lead-10 text-black mb-9">Daftar Transaksi</h2>

        <div class="flex sm:flex-col lg:flex-row sm:items-center justify-between">
            <ul class="flex max-sm:flex-col sm:items-center gap-x-14 gap-y-3">
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-indigo-600 transition-all duration-500 hover:text-indigo-600">
                    Semua</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600">
                    Berlangsung</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600">
                    Berhasil</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600">
                    Cancelled</li>
            </ul>
        </div>
        @forelse ($orders as $item)
            <div class="mt-7 border border-gray-300 pt-9">
                <div class="flex max-md:flex-col items-center justify-between px-3 md:px-11">
                    <div class="data">
                        <p class="font-medium text-lg leading-8 text-black whitespace-nowrap">Order : {{ $item->invoice_number }}</p>
                        <p class="font-medium text-lg leading-8 text-black mt-3 whitespace-nowrap">Order Payment : {{ \Carbon\Carbon::parse($item->tanggal_pembelian)->format('d M Y') }}</p>
                    </div>
                    <div class="flex items-center gap-3 max-md:mt-5">
                        <button
                            class="rounded-full px-7 py-3 bg-white text-gray-900 border border-gray-300 font-semibold text-sm shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-200 hover:bg-gray-50 hover:border-gray-400">Show
                            Invoice</button>

                    </div>
                </div>
                
                @foreach ($item->detail_pembelians as $detail_pembelian)
                    <svg class="my-9 w-full" xmlns="http://www.w3.org/2000/svg" width="1216" height="2" viewBox="0 0 1216 2"
                        fill="none">
                        <path d="M0 1H1216" stroke="#D1D5DB" />
                    </svg>
                    <div class="flex max-lg:flex-col items-center gap-8 lg:gap-24 px-3 md:px-11">

                        <div class="grid grid-cols-4 w-full">
                            <div class="col-span-4 sm:col-span-1">
                                <img src="{{ asset($detail_pembelian->komik->photo) }}" alt="" class="max-sm:mx-auto object-cover">
                            </div>
                            <div
                                class="col-span-4 sm:col-span-3 max-sm:mt-4 sm:pl-8 flex flex-col justify-center max-sm:items-center">
                                <h6 class="font-manrope font-semibold text-2xl leading-9 text-black mb-3 whitespace-nowrap">
                                    {{ $detail_pembelian->komik->title }}
                                </h6>
                                <p class="font-normal text-lg leading-8 text-gray-500 mb-8 whitespace-nowrap">
                                    {{ $detail_pembelian->komik->author }}
                                </p>
                                <div class="flex items-center max-sm:flex-col gap-x-10 gap-y-3">
                                    <span class="font-normal text-lg leading-8 text-gray-500 whitespace-nowrap">Jumlah: {{ $detail_pembelian->jumlah }}</span>
                                    <p class="font-semibold text-xl leading-8 text-black whitespace-nowrap">Rp{{ number_format($detail_pembelian->komik->price * $detail_pembelian->jumlah, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-around w-full  sm:pl-28 lg:pl-0">
                            <div class="flex flex-col justify-center items-start max-sm:items-center">
                                <p class="font-normal text-lg text-gray-500 leading-8 mb-2 text-left whitespace-nowrap">
                                    Status</p>
                                <p class="font-semibold text-lg leading-8 text-left whitespace-nowrap 
                                    {{ $item->status == 'Sukses' ? 'text-green-500' : ($item->status == 'Batal' ? 'text-red-500' : 'text-yellow-500') }}">
                                    {{ $item->status }}
                                </p>                                
                            </div>
                            <div class="flex flex-col justify-center items-start max-sm:items-center">
                                <p class="font-normal text-lg text-gray-500 leading-8 mb-2 text-left whitespace-nowrap">
                                    Verifikasi selesai pada tanggal
                                </p>
                                <p class="font-semibold text-lg leading-8 text-black text-left whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->tanggal_pembelian)->addDays(2)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <svg class="mt-9 w-full" xmlns="http://www.w3.org/2000/svg" width="1216" height="2" viewBox="0 0 1216 2"
                    fill="none">
                    <path d="M0 1H1216" stroke="#D1D5DB" />
                </svg>

                <div class="pr-3 md:pr-11 flex items-center justify-between max-sm:flex-col-reverse">
                    <div class="flex max-sm:flex-col-reverse items-center">
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                            class="flex items-center gap-3 py-10 pr-8 pl-7 sm:border-r border-gray-300 font-normal text-xl leading-8 text-gray-500 group transition-all duration-500 hover:text-indigo-600">
                            <svg width="40" height="41" viewBox="0 0 40 41" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="stroke-gray-600 transition-all duration-500 group-hover:stroke-indigo-600"
                                    d="M14.0261 14.7259L25.5755 26.2753M14.0261 26.2753L25.5755 14.7259" stroke=""
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Batal Order
                        </button>
                        <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin untuk membatalkan pesanan ini?</h3>
                                        <form action="{{ route('order.cancel') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <button data-modal-hide="popup-modal" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Ya, saya yakin
                                            </button>
                                            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak, batal</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="font-normal text-xl leading-8 text-gray-500 sm:pl-8">Pembayaran Berhasil</p>
                    </div>
                    <p class="font-medium text-xl leading-8 text-black max-sm:py-4"> <span class="text-gray-500">Total: </span> &nbsp;Rp{{ number_format($item->total_pembayaran, 0, ',', '.') }}</p>
                </div>
            </div>
            @empty
                <p class="text-center font-medium text-lg text-gray-500 mt-7 p-9">Tidak ada transaksi</p>

                <section class="pt-20 lg:pt-[120px] pb-10 lg:pb-20">
                    <div class="flex flex-wrap justify-center -mx-4">
                        <div class="w-full px-4">
                            <div class="text-center mx-auto mb-[60px] lg:mb-20 max-w-[510px]">
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
                                                        Add to favourites
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
                                                        Add to favourites
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
                                                    Add to cart
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
        @endforelse
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