@extends('layouts.main')
@section('container')
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

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
<div class="bg-gray-100" style="height: 66vh;">
    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 h-full" style="margin-top: 110px;">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-green-400">
                    <div class="image overflow-hidden">
                        <img class="h-auto w-full mx-auto"
                            src="https://lavinephotography.com.au/wp-content/uploads/2017/01/PROFILE-Photography-112.jpg"
                            alt="">
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl leading-8 my-1">{{ auth()->user()->name }}</h1>
                    <h3 class="text-gray-600 font-lg text-semibold leading-6">Member</h3>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto"><span
                                    class="bg-green-500 py-1 px-2 rounded text-white text-sm">Active</span></span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Member since</span>
                            <span class="ml-auto">{{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('d M Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 h-64">
                <form action="{{ route('profile.update') }}" method="POST" class="bg-white p-3 shadow-sm rounded-sm">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">
                        <span clas="text-green-500">
                            <svg class="h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                        <span class="tracking-wide">Edit About</span>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-2 text-sm">
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">First Name</div>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" class="px-4 py-2 border rounded">
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Email</div>
                                <input type="text" name="email" value="{{ auth()->user()->email }}" class="px-4 py-2 border rounded">
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Password</div>
                                <input type="password" name="password" value="" class="px-4 py-2 border rounded">
                            </div>
                            <div class="grid grid-cols-2">
                                <div class="px-4 py-2 font-semibold">Confirm Passowrd</div>
                                <input type="password" name="confirm_password" value="" class="px-4 py-2 border rounded">
                            </div>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="block w-full text-white bg-blue-600 text-sm font-semibold rounded-lg hover:bg-blue-800 focus:outline-none focus:shadow-outline p-3 my-4">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

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