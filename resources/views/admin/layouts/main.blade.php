<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Komik Ku</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
    <script src="https://kit.fontawesome.com/27b3d82bd5.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@9.0.3"></script>
</head>
<body>
    @include('admin.partials.sidebar')
    
    @include('admin.partials.navbar')

    @if (!request()->routeIs('admin.dashboard', 'admin.billings.show', 'admin.profile.index'))
        @include('admin.partials.header')    
    @endif

    <div class="container max-w-full sm:ml-64 mt-2">
        @yield('container')
    </div>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>