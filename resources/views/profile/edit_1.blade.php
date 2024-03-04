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
        @vite(['resources/js/app.js'])
    </head>
    
    <body class="font-sans antialiased bg-dark" style="background-color: lightgray;">
        <div class="container">
            <header class="header_inline_block">
                <h1>Colorset</h1>
                <nav>
                    <ul>
                        <li><h1><a href="{{ route('profile.edit') }}">PROFILE</a></h1></li>
                        <li><h1><a href="/cloths/items">ITEMS</a></h1></li>
                        <li><h1><a href="/cloths/patterns">PATTERNS</a></h1></li>
                    </ul>
                </nav>
            </header>
            <div class="bg-lightgray-100 main_block">
                <!--include('layouts.navigation')-->
                <!-- Page Content -->
                <main>
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-profile-information-form')
                                </div>
                            </div>
                
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('Log out this account') }}
                                        </h2>
                                
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ __("If you want to log out this account, click below the button.") }}
                                        </p>
                                    </header>
                                    <form method="POST" action="{{ route('logout') }}" class="space-y-6">
                                        @csrf
                                            <x-danger-button>
                                                {{ __('Log out') }}
                                            </x-danger-button>
                                        <!--<a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="https://6bb06c2ba4e747b08c4f8fe125bcaef6.vfs.cloud9.us-east-1.amazonaws.com/logout" onclick="event.preventDefault();-->
                                        <!--                    this.closest('form').submit();">Log Out</a>-->
                                    </form> 
                                </div>
                            </div>
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    @include('profile.partials.delete-user-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
