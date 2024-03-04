<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Colorset</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
         
        <!--Style-->
        <link href="/css/header.css" rel="stylesheet">
        <link href="/css/profile.css" rel="stylesheet">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <!-- Page Heading -->
        @if (isset($header))
            <header class="header_inline_block">
                {{ $header }}
            </header>
        @endif
    <body class="font-sans antialiased bg-dark" style="background-color: lightgray;">
        <div class="min-h-screen bg-lightgray-100 main_block">
            @include('layouts.navigation')
             Page Content 
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
