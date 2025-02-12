<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <title>User Management</title>
    @include('layout.components.styles')
    @yield('styles')
</head>

<body>
    @include('layout.components.switcher')

    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('images/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        @yield('content')
    </div>


    @include('layout.components.scripts')
    @yield('scripts')
</body>

</html>
