@extends('layouts.main')
@section('container')
<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang</h2>
  
        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <div class="space-y-6">
                    @foreach ($cart as $item)
                    <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                        <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                            <a href="#" class="shrink-0 md:order-1">
                                <img class="h-20 w-20 dark:hidden" src="{{ asset($item->komik->photo) }}" alt="{{ $item->komik->title }}" />
                                <img class="hidden h-20 w-20 dark:block" src="{{ asset($item->komik->photo) }}" alt="{{ $item->komik->title }}"/>
                            </a>
            
                            <label for="counter-input" class="sr-only">Choose quantity:</label>
                            <div class="flex items-center justify-between md:order-3 md:justify-end">
                                <div class="flex items-center">
                                    <button type="button" data-cart-id="{{ $item->id }}" data-quantity="{{ $item->jumlah - 1 }}" data-input-counter-decrement="counter-input" class="decrement-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                    </svg>
                                    </button>
                                    <input type="text" id="counter-input" data-cart-id="{{ $item->id }}" data-input-counter class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{ $item->jumlah }}" required />
                                    <button type="button" data-cart-id="{{ $item->id }}" data-quantity="{{ $item->jumlah + 1 }}" data-input-counter-increment="counter-input" class="increment-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                    </button>
                                </div>
                                <div class="text-end md:order-4 md:w-32">
                                    <p class="text-base font-bold text-gray-900 dark:text-white">Rp{{ number_format($item->komik->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
            
                            <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                <a href="/detail/{{ $item->komik->id }}" class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item->komik->title }}</a>
            
                                <div class="flex items-center gap-2">
                                    @if (in_array($item->komik->id, $wishlistItems))
                                        <form action="{{ route('removeWishlist') }}" method="POST" class="inline-flex items-center">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="komik_id" value="{{ $item->komik->id }}">
                                            <button type="submit" class="inline-flex items-center text-md font-medium text-red-500 hover:text-red-500 hover:underline ">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('addWishlist') }}" method="POST" class="inline-flex items-center">
                                            @csrf
                                            <input type="hidden" name="komik_id" value="{{ $item->komik->id }}">
                                            <button type="submit" class="inline-flex items-center text-md font-medium text-gray-500 hover:text-gray-900 hover:underline ">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('cart.delete', $item->id) }}" method="POST" class="inline-flex">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="inline-flex items-center text-md font-medium text-red-600 hover:underline dark:text-red-500">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>    
                    @endforeach
                </div>
                <div class="hidden xl:mt-8 xl:block">
                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">People also bought</h3>
                    <div class="mt-6 grid grid-cols-3 gap-4 sm:mt-8">
                        <div class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <a href="#" class="overflow-hidden rounded">
                            <img class="mx-auto h-44 w-44 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                            <img class="mx-auto hidden h-44 w-44 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac image" />
                            </a>
                            <div>
                            <a href="#" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">iMac 27”</a>
                            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This generation has some improvements, including a longer continuous battery life.</p>
                            </div>
                            <div>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">
                                <span class="line-through"> $399,99 </span>
                            </p>
                            <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$299</p>
                            </div>
                            <div class="mt-6 flex items-center gap-2.5">
                            <button data-tooltip-target="favourites-tooltip-1" type="button" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                                </svg>
                            </button>
                            <div id="favourites-tooltip-1" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Add to favourites
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <button type="button" class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                </svg>
                                Add to cart
                            </button>
                            </div>
                        </div>
                        <div class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <a href="#" class="overflow-hidden rounded">
                            <img class="mx-auto h-44 w-44 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-light.svg" alt="imac image" />
                            <img class="mx-auto hidden h-44 w-44 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-dark.svg" alt="imac image" />
                            </a>
                            <div>
                            <a href="#" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Playstation 5</a>
                            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This generation has some improvements, including a longer continuous battery life.</p>
                            </div>
                            <div>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">
                                <span class="line-through"> $799,99 </span>
                            </p>
                            <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$499</p>
                            </div>
                            <div class="mt-6 flex items-center gap-2.5">
                            <button data-tooltip-target="favourites-tooltip-2" type="button" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                                </svg>
                            </button>
                            <div id="favourites-tooltip-2" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Add to favourites
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                            <button type="button" class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                </svg>
                                Add to cart
                            </button>
                            </div>
                        </div>
                        <div class="space-y-6 overflow-hidden rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <a href="#" class="overflow-hidden rounded">
                            <img class="mx-auto h-44 w-44 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-light.svg" alt="imac image" />
                            <img class="mx-auto hidden h-44 w-44 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg" alt="imac image" />
                            </a>
                            <div>
                            <a href="#" class="text-lg font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Apple Watch Series 8</a>
                            <p class="mt-2 text-base font-normal text-gray-500 dark:text-gray-400">This generation has some improvements, including a longer continuous battery life.</p>
                            </div>
                            <div>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">
                                <span class="line-through"> $1799,99 </span>
                            </p>
                            <p class="text-lg font-bold leading-tight text-red-600 dark:text-red-500">$1199</p>
                            </div>
                            <div class="mt-6 flex items-center gap-2.5">
                            <button data-tooltip-target="favourites-tooltip-3" type="button" class="inline-flex items-center justify-center gap-2 rounded-lg border border-gray-200 bg-white p-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                                </svg>
                            </button>
                            <div id="favourites-tooltip-3" role="tooltip" class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                                Add to favourites
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
            
                            <button type="button" class="inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium  text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7h-1M8 7h-.688M13 5v4m-2-2h4" />
                                </svg>
                                Add to cart
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Belanja</p>
        
                    <div class="space-y-4">
                    <dl class="flex items-center justify-between gap-4 border-b border-gray-200 pb-5 dark:border-gray-700">
                        <dt class="text-base font-normal text-gray-900 dark:text-white">Total</dt>
                        <dd id="total-price" class="text-base font-bold text-gray-900 dark:text-white">Rp{{ number_format($cart->sum(function($item) {
                            return $item->komik->price * $item->jumlah;
                        }), 0, ',', '.') }}</dd>
                    </dl>
                    </div>
                    
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Beli</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $(".increment-button").click(function() {
            var cartId = $(this).data("cart-id");
            var quantity = parseInt($("input[data-cart-id='" + cartId + "']").val()); 
            quantity++; 

            updateQuantity(cartId, quantity); 
        });

        $(".decrement-button").click(function() {
            var cartId = $(this).data("cart-id");
            var quantity = parseInt($("input[data-cart-id='" + cartId + "']").val()); 
            if (quantity > 1) { 
                quantity--; 
                updateQuantity(cartId, quantity); 
            }
        });

        function updateQuantity(cartId, quantity) {
            $.ajax({
                url: "/cart/update/" + cartId,
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    jumlah: quantity 
                },
                success: function(response) {
                    $("input[data-cart-id='" + cartId + "']").val(response.new_quantity);

                    $("#total-price").text("Rp" + response.new_total_price);

                    console.log(response);
                },
                error: function() {
                    alert("An error occurred while updating the cart.");
                }
            });
        }
    });
</script>    
@endsection