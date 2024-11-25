@extends('layouts.main')
@section('container')
<section class="body-font h-screen pt-10 text-gray-600 mt-20 ">
    <div class="container mx-auto mt-10 flex max-w-3xl flex-wrap justify-center rounded-lg bg-white px-5 py-24 border shadow-md">
      <!-- QR Code Number Account & Uploadfile -->
      <div class="flex-wrap md:flex">
        <div class="mx-auto">
          <img class="mx-auto mt-12 h-52 w-52 rounded-lg border p-2 md:mt-0" src="{{ asset('images/qr.jpg') }}" alt="step" />
          <div>
            <h1 class="font-laonoto mt-4 text-center text-xl font-bold">DANA</h1>
            <p class="mt-2 text-center font-semibold text-gray-600">RAFI RAMADHAN</p>
            <p class="mt-1 text-center font-medium text-red-500">0812-1863-8343</p>
          </div>
          <!-- component -->
          <div class="mx-auto w-52">
            <div class="m-4">
              <div class="flex w-full items-center justify-center">
                <label class="flex h-14 w-full cursor-pointer flex-col border-4 border-dashed border-gray-200 hover:border-gray-300 hover:bg-gray-100">
                  <div class="mt-3 flex items-center justify-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-400">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                    </svg>
  
                    <p class="text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Unggah Bukti</p>
                  </div>
                  <form action="{{ route('process-payment') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id_pembelian }}">
                    <input type="file" class="opacity-0" name="bukti_tf" required />
                </label>
              </div>
            </div>
          </div>
          <button type="submit" class="mx-auto block rounded-md border bg-blue-500 px-6 py-2 text-white outline-none">Submit</button>
          </form>
        </div>
        <!-- Step Checkout -->
        <div class="mt-8 max-w-sm md:mt-0 md:ml-10 md:w-2/3">
          <div class="mb-8">
            <p>Pembayaran yang harus dibayar sebesar</p><b> Rp{{ number_format($total_harga, 0, ',', '.') }}</b>
          </div>          
          <div class="relative flex pb-12">
            <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
              <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
            </div>
            <div class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              </svg>
            </div>
            <div class="flex-grow pl-4">
              <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">STEP 1</h2>
              <p class="font-laonoto leading-relaxed">
                Bayar dengan Pindai Bayar
                <b>QR CODE </b>
              </p>
            </div>
          </div>
          <div class="relative flex pb-12">
            <div class="absolute inset-0 flex h-full w-10 items-center justify-center">
              <div class="pointer-events-none h-full w-1 bg-gray-200"></div>
            </div>
            <div class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
              </svg>
            </div>
            <div class="flex-grow pl-4">
              <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">STEP 2</h2>
              <p class="font-laonoto leading-relaxed">Upload bukti pembayaran.</p>
            </div>
          </div>
          <div class="relative flex pb-12">
            <div class="relative z-10 inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-blue-500 text-white">
              <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-5 w-5" viewBox="0 0 24 24">
                <circle cx="12" cy="5" r="3"></circle>
                <path d="M12 22V8M5 12H2a10 10 0 0020 0h-3"></path>
              </svg>
            </div>
            <div class="flex-grow pl-4">
              <h2 class="title-font mb-1 text-sm font-medium tracking-wider text-gray-900">STEP 3</h2>
              <p class="font-laonoto leading-relaxed">
                Transfer selesai, silakan tunggu staf verifikasi. Anda dapat memeriksa status pembayaran<span></span
                >.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection