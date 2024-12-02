@extends('admin.layouts.main')
@section('container')
<section class="bg-gray-100 py-20 sm:ml-64">
    <div class="max-w-2xl mx-auto py-0 md:py-16">
      <article class="shadow-none md:shadow-md md:rounded-md overflow-hidden">
        <div class="md:rounded-b-md  bg-white">
          <div class="p-9 border-b border-gray-200">
            <div class="space-y-6">
              <div class="flex justify-between items-top">
                <div class="space-y-4">
                  <div>
                    <p class="font-bold text-xl">KOMIKKU</p>
                    <p class="font-bold text-lg"> Tagihan </p>
                  </div>
                  <div>
                    <p class="font-medium text-sm text-gray-400"> Tagihan ke </p>
                    <p> {{ $billing->user->name }} </p>
                    <p> {{ $billing->user->email }} </p>
                  </div>
                </div>
                <div class="space-y-2">
                  <div>
                    <p class="font-medium text-sm text-gray-400"> Nomor Tagihan </p>
                    <p> {{ $billing->invoice_number }} </p>
                  </div>
                  <div>
                    <p class="font-medium text-sm text-gray-400"> Tanggal Tagihan </p>
                    <p> {{ \Carbon\Carbon::parse($billing->tanggal_pembelian)->format('d M Y') }} </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table class="w-full divide-y divide-gray-200 text-sm">
            <thead>
              <tr>
                <th scope="col" class="px-9 py-4 text-left font-semibold text-gray-400"> Komik </th>
                <th scope="col" class="py-3 text-left font-semibold text-gray-400"> Jumlah </th>
                <th scope="col" class="py-3 text-left font-semibold text-gray-400"> Diskon </th>
                <th scope="col" class="py-3 text-left font-semibold text-gray-400"> Harga </th>
                <th scope="col" class="py-3 text-left font-semibold text-gray-400"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($billing->detail_pembelians as $detail_pembelian)
                <tr>
                    <td class="px-9 py-5 whitespace-nowrap space-x-1 flex items-center">
                    <div>
                        <p> {{ $detail_pembelian->komik->title }} </p>
                        <p class="text-sm text-gray-400"> {{ $detail_pembelian->komik->category->name }} </p>
                    </div>
                    </td>
                    <td class="whitespace-nowrap text-gray-600 truncate"> {{ $detail_pembelian->jumlah }} </td>
                    <td class="whitespace-nowrap text-gray-600 truncate"> 0% </td>
                    <td class="whitespace-nowrap text-gray-600 truncate"> Rp{{ number_format($detail_pembelian->komik->price * $detail_pembelian->jumlah, 0, ',', '.') }} </td>
                </tr>    
                @endforeach
            </tbody>
          </table>
          <div class="p-9 border-b border-gray-200">
            <div class="space-y-3">
              <div class="flex justify-between">
                <div>
                  <p class="text-gray-500 text-sm"> Subtotal </p>
                </div>
                <p class="text-gray-500 text-sm"> Rp{{ number_format($billing->total_pembayaran, 0, ',', '.') }} </p>
              </div>
              <div class="flex justify-between">
                <div>
                  <p class="text-gray-500 text-sm"> Pajak </p>
                </div>
                <p class="text-gray-500 text-sm"> Rp0 </p>
              </div>
              <div class="flex justify-between">
                <div>
                  <p class="text-gray-500 text-sm"> Total </p>
                </div>
                <p class="text-gray-500 text-sm"> Rp{{ number_format($billing->total_pembayaran, 0, ',', '.') }} </p>
              </div>
            </div>
          </div>
          <div class="p-9 border-b border-gray-200">
            <div class="space-y-3">
              <div class="flex justify-between">
                <div>
                  <p class="font-bold text-black text-lg"> Jumlah yang harus dibayar </p>
                </div>
                <p class="font-bold text-black text-lg"> Rp{{ number_format($billing->total_pembayaran, 0, ',', '.') }} </p>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
</section>
@endsection