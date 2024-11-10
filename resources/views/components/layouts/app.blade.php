<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <tallstackui:script />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- prettier-ignore -->
        <script defer data-domain="artistshero.com" src="https://analytics.antonloginov.com/js/script.js"></script>
    </head>
    <body class="font-sans antialiased">
        <x-ts-toast />
        <div class="min-h-screen" id="root">
            <header class="sticky top-0 z-50 bg-white">
                <x-navbar />
            </header>
            <main>
                {{ $slot }}
            </main>
            <footer>
                <x-footer />
            </footer>
        </div>

        @livewireScripts

        <x-ts-modal x-ref="contact-modal" id="contact-form-modal">
            <div class="flex w-full lg:grid lg:grid-cols-2 lg:gap-x-5">
                <livewire:contact-form />
                <div class="max-lg:hidden">
                    <img src="{{ asset('img/contact_image.jpg') }}" alt="{{ __('contact us') }}" />
                </div>
            </div>
        </x-ts-modal>
    </body>
</html>
