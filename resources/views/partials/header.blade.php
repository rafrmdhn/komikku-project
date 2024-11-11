<div class="fixed top-0 left-0 w-full z-50 flex flex-wrap place-items-center">
    <section class="relative mx-auto">
        <!-- navbar -->
        <nav class="flex justify-between bg-gray-900 text-white w-screen">
            <div class="px-5 xl:px-12 py-3 flex w-full items-center">
                <a class="text-3xl font-bold font-heading" href="/">
                    KOMIKKU
                </a>
                <!-- Nav Links -->
                <div class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12 w-full justify-center">
                    <span class="w-full md:w-2/3 h-10 bg-gray-200 cursor-pointer border border-gray-300 text-sm rounded-full flex">
                        <input type="search" name="search" placeholder="Cari Komik"
                        class="flex-grow px-4 rounded-l-full rounded-r-full text-sm text-black focus:outline-none w-full">
                        <i class="fas fa-search m-3 mr-5 text-lg text-gray-700 w-4 h-4"></i>
                    </span>
                </div>
                <!-- Header Icons -->
                <div class="hidden xl:flex items-center space-x-5 items-center">
                    <a class="hover:text-gray-200" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    </a>
                    <a class="flex items-center hover:text-gray-200" href="{{ auth()->check() ? route('cart') : route('login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if (!$total_cart == 0)
                            <span class="flex absolute -mt-5 ml-4">
                                <span class="bg-pink-700 rounded-full text-xs text-white p-1 w-5 h-5 flex items-center justify-center">{{ $total_cart }}</span>
                            </span>
                        @endif            
                    </a>
                    <!-- Sign In / Register      -->
                    <a class="flex items-center hover:text-gray-200" href="/login">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </a>
                    
                </div>
            </div>
            <a class="xl:hidden flex mr-6 items-center" href="{{ route('cart') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="flex absolute -mt-5 ml-4">
                    <span class="bg-pink-700 rounded-full text-xs text-white p-1">{{ $total_cart }}</span>
                </span>
            </a>
            <a class="navbar-burger self-center mr-12 xl:hidden" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </a>
        </nav>
    </section>
  </div>