@extends('layouts.main')
@section('container')
<section class="py-24 relative">
    <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
        <h2 class="font-manrope font-extrabold text-3xl lead-10 text-black mb-9">Order History</h2>

        <div class="flex sm:flex-col lg:flex-row sm:items-center justify-between">
            <ul class="flex max-sm:flex-col sm:items-center gap-x-14 gap-y-3">
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-indigo-600 transition-all duration-500 hover:text-indigo-600">
                    All Order</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600">
                    Summary</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600">
                    Completed</li>
                <li
                    class="font-medium text-lg leading-8 cursor-pointer text-black transition-all duration-500 hover:text-indigo-600">
                    Cancelled</li>
            </ul>
        </div>
        @foreach ($orders as $item)
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
                                <p class="font-semibold text-lg leading-8 text-green-500 text-left whitespace-nowrap">
                                    {{ $item->status }}
                                </p>
                            </div>
                            <div class="flex flex-col justify-center items-start max-sm:items-center">
                                <p class="font-normal text-lg text-gray-500 leading-8 mb-2 text-left whitespace-nowrap">
                                    Delivery Expected by</p>
                                <p class="font-semibold text-lg leading-8 text-black text-left whitespace-nowrap">23rd March
                                    2021</p>
                            </div>
                        </div>

                    </div>
                @endforeach

                <svg class="mt-9 w-full" xmlns="http://www.w3.org/2000/svg" width="1216" height="2" viewBox="0 0 1216 2"
                    fill="none">
                    <path d="M0 1H1216" stroke="#D1D5DB" />
                </svg>

                <div class="px-3 md:px-11 flex items-center justify-between max-sm:flex-col-reverse">
                    <div class="flex max-sm:flex-col-reverse items-center">
                        <button
                            class="flex items-center gap-3 py-10 pr-8 sm:border-r border-gray-300 font-normal text-xl leading-8 text-gray-500 group transition-all duration-500 hover:text-indigo-600">
                            <svg width="40" height="41" viewBox="0 0 40 41" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="stroke-gray-600 transition-all duration-500 group-hover:stroke-indigo-600"
                                    d="M14.0261 14.7259L25.5755 26.2753M14.0261 26.2753L25.5755 14.7259" stroke=""
                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            cancel order
                        </button>
                        <p class="font-normal text-xl leading-8 text-gray-500 sm:pl-8">Pembayaran Berhasil</p>
                    </div>
                    <p class="font-medium text-xl leading-8 text-black max-sm:py-4"> <span class="text-gray-500">Total: </span> &nbsp;Rp{{ number_format($item->total_pembayaran, 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection