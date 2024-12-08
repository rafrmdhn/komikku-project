@extends('admin.layouts.main')
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
<div class="min-h-screen p-6 flex items-center justify-center sm:ml-64">
    <div class="container max-w-screen-lg mx-auto">
        <div>
            <div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                    <p class="font-medium text-lg">Personal Info Admin</p>
                    </div>
                    <form action="{{ route('profile.update', auth()->user()->id) }}" method="POST" class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                                @csrf
                                @method('PUT')
                            
                                <div class="md:col-span-5">
                                    <label for="name">Full Name</label>
                                    <input type="text" name="name" id="name" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ auth()->user()->name }}" required />
                                </div>
                            
                                <div class="md:col-span-5">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ auth()->user()->email }}" required />
                                </div>
                            
                                <div class="md:col-span-2">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Password" />
                                </div>
                            
                                <div class="md:col-span-2">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" placeholder="Confirm Password" />
                                </div>
                            
                                <div class="md:col-span-5 text-right">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
                                </div>
                            
                        </div>
                    </form>
                </div>
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