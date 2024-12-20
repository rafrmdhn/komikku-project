<nav class="fixed md:top-16 top-14 left-0 w-full z-50 bg-white shadow dark:bg-gray-800">
    <div class="container flex items-center justify-center p-3 mx-auto text-gray-600 capitalize dark:text-gray-300">
        <a href="/" class="border-b-2 hover:text-gray-800 dark:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6 {{ Request::is('/') ? 'border-b-2 border-blue-500' : 'border-transparent' }}">Beranda</a>

        <a href="/komik-terbaru" class="border-b-2 hover:text-gray-800 dark:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6 {{ request()->routeIs('komik.terbaru') || Request::is('komik-terbaru*') ? 'border-b-2 border-blue-500' : 'border-transparent' }}">Terbaru</a>

        <a href="/daftar-komik" class="border-b-2 hover:text-gray-800 dark:text-gray-200 hover:border-blue-500 mx-1.5 sm:mx-6 {{ request()->routeIs('daftar.komik') || Request::is('daftar-komik*') ? 'border-b-2 border-blue-500' : 'border-transparent' }}">Daftar Komik</a>
    </div>
</nav>