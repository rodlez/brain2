<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fontawesome/css/solid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fontawesome/css/brands.css') }}">


    <!-- Virtual Select Plugin -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/virtualselect/virtual-select.min.js') }}">
    <script src="{{ asset('assets/virtualselect/virtual-select.min.js') }}"></script>

    <!-- optional -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/tooltip/tooltip.min.css') }}">
    <script src="{{ asset('assets/tooltip/tooltip.min.js') }}"></script>

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            <!-- Session to pass the message for the CRUD operations success or error -->
            <div class="container max-w-6xl mx-auto px-6 pt-4">
                @if (session()->has('message'))
                    <div class="flex flex-row justify-between item-center <?php echo substr(session('message'), 0, 5) == 'Error' ? 'bg-red-600' : 'bg-green-700'; ?>  text-white p-2 rounded-md">
                        <h2 class="text-md italic px-2">{{ session('message') }}</h2>
                        <a href="{{ URL::current() }}" class="px-2">X</a>
                    </div>
                @endif
            </div>

            {{ $slot }}
        </main>
    </div>
    @livewireScripts
    @stack('js')
</body>

</html>
