@extends('admin.layouts.main')
@section('container')
<div class="p-4 sm:ml-64 mt-10">
   <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
          <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
              <div class="flex justify-between mb-6">
                  <div>
                      <div class="flex items-center mb-1">
                          <div class="text-2xl font-semibold">{{ $komik }}</div>
                      </div>
                      <div class="text-sm font-medium text-gray-400">Komik</div>
                  </div>
              </div>

              <a href="{{ route('admin.products.index') }}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
          </div>
          <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
              <div class="flex justify-between mb-4">
                  <div>
                      <div class="flex items-center mb-1">
                          <div class="text-2xl font-semibold">{{ $pembelian }}</div>
                      </div>
                      <div class="text-sm font-medium text-gray-400">Pembelian</div>
                  </div>
              </div>
              <a href="{{ route('admin.billings.index') }}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
          </div>
          <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
              <div class="flex justify-between mb-6">
                  <div>
                      <div class="text-2xl font-semibold mb-1">{{ $pengguna }}</div>
                      <div class="text-sm font-medium text-gray-400">Pengguna</div>
                  </div>
              </div>
              <a href="{{ route('admin.users.index') }}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
          </div>
      </div>   
</div>
@endsection