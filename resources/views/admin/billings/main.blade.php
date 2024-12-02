@extends('admin.layouts.main')
@section('container')
<div class="sm:ml-64 mb-4">
    <table id="default-table">
        <thead>
            <tr>
                <th>
                    <span class="flex items-center">
                        Nomor Invoice
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th data-type="date" data-format="YYYY/DD/MM">
                    <span class="flex items-center">
                        Nama Pembeli
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Tanggal Pembelian
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Total Pembayaran
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Status
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Bukti Pembayaran
                        <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                    </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Action
                    </span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($billings as $billing)
            <tr>
                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $billing->pembelian->invoice_number }}</td>
                <td>{{ $billing->pembelian->user->name }}</td>
                <td>{{ $billing->pembelian->tanggal_pembelian }}</td>
                <td>Rp{{ number_format($billing->pembelian->total_pembayaran, 0, ',', '.') }}</td>
                <td>{{ $billing->pembelian->status }}</td>
                <td>
                    <img id="img{{ $billing->id }}" class="h-32 mx-auto rounded-lg shadow-xl cursor-pointer dark:shadow-gray-800" src="{{ asset('storage/' . $billing->pembelian->bukti_tf) }}" alt="Bukti {{ $billing->id }}">
                </td>
                <td class="p-4 space-x-2 whitespace-nowrap">
                    <a href="{{ route('admin.billings.show', $billing->id) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                          </svg>                          
                        Detail Invoice
                    </a>
                    @include('admin.billings.edit')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="modal"
		class="hidden fixed top-0 left-0 z-50 
				w-screen h-screen bg-black/70 flex 
				justify-center items-center">

		<!-- The close button -->
		<a class="fixed z-60 top-6 right-8 
				text-white text-5xl font-bold" 
		href="javascript:void(0)"
		onclick="closeModal()">
			×
		</a>

		<!-- A big image will be displayed here -->
		<img id="modal-img"
			class="max-w-[800px] max-h-[600px] object-cover"/>
	</div>
</div>

<script>
    if (document.getElementById("default-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#default-table", {
            searchable: true,
            perPageSelect: false,
        });
    }
</script>

<script>
    // Get all the img elements in the grid
    var images = document.querySelectorAll('img.h-32');

    // Loop through each img element
    images.forEach(function (img) {
        
    // Add a click event listener to each img element
        img.addEventListener('click', function () {
            showModal(img.src);
        });
    });

    // Get the modal by id
    var modal = document.getElementById("modal");

    // Get the modal image tag
    var modalImg = document.getElementById("modal-img");

    // This function is called when a small image is clicked
    function showModal(src) {
        modal.classList.remove('hidden');
        modalImg.src = src;
    }

    // This function is called when the close button is clicked
    function closeModal() {
        modal.classList.add('hidden');
    }
</script>
@endsection