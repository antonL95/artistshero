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
        <script>
            !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(".");2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement("script")).type="text/javascript",p.async=!0,p.src=s.api_host+"/static/array.js",(r=t.getElementsByTagName("script")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a="posthog",u.people=u.people||[],u.toString=function(t){var e="posthog";return"posthog"!==a&&(e+="."+a),t||(e+=" (stub)"),e},u.people.toString=function(){return u.toString(1)+".people (stub)"},o="capture identify alias people.set people.set_once set_config register register_once unregister opt_out_capturing has_opted_out_capturing opt_in_capturing reset isFeatureEnabled onFeatureFlags getFeatureFlag getFeatureFlagPayload reloadFeatureFlags group updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures getActiveMatchingSurveys getSurveys onSessionId".split(" "),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
            posthog.init('phc_UfVGHkOeA0iYbKVmaREqfwSpQ5R4RPkXqUNHgSwSYp1', {api_host: "https://eu.posthog.com"})
        </script>
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
            <div class="flex lg:grid lg:grid-cols-2 lg:gap-x-5">
                <livewire:contact-form />
                <div>
                    <img src="{{ asset('img/contact_image.jpg') }}" alt="{{ __('contact us') }}" />
                </div>
            </div>
        </x-ts-modal>
    </body>
</html>
