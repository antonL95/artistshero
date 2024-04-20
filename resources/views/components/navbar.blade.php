<div
    x-data="{
        openMenu: false,
        toggle() {
            this.openMenu = ! this.openMenu
        },
    }"
    class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8"
>
    <div class="relative flex justify-between">
        <div class="flex md:absolute md:inset-y-0 md:left-0 lg:static xl:col-span-2">
            <div class="flex flex-shrink-0 items-center">
                <a href="{{ route('home') }}" wire:navigate.hover>
                    <img class="h-8 w-auto" src="{{ asset('img/logo_black.svg') }}" alt="{{ config('app.name') }}" />
                </a>
            </div>
        </div>
        <div class="flex items-center md:absolute md:inset-y-0 md:right-0 lg:hidden">
            <button
                x-on:click="toggle()"
                type="button"
                class="text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:ring-indigo-500 relative -mx-2 inline-flex items-center justify-center rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-inset"
                aria-expanded="false"
            >
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Open menu</span>
                <x-icon name="list" x-show="!openMenu" class="h-6 w-6" />
                <x-icon name="x" x-cloak x-show="openMenu" class="h-6 w-6" />
            </button>
        </div>
        <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
            <x-link-button
                wire:navigate.hover
                href="{{ route('gallery') }}"
                class="border border-black bg-white text-black hover:bg-black hover:text-white"
            >
                {{ __('gallery.button') }}
            </x-link-button>

            <x-button modal="contact-form-modal" class="bg-black text-white hover:bg-white hover:text-black">
                {{ __('contact.button') }}
            </x-button>
        </div>
    </div>

    <nav x-show="openMenu" class="lg:hidden" aria-label="Global" x-on:click.outsite="toggle()">
        <div class="mx-auto max-w-3xl space-y-1 px-2 pb-3 pt-2 sm:px-4">
            <div class="grid grid-cols-1 text-center">
                <a class="py-2" x-on:click="handleNavLinkClick('intro')" href="{{ route('home') }}#intro">
                    {{ __('navigation.intro') }}
                </a>
                <a class="py-2" x-on:click="handleNavLinkClick('why')" href="{{ route('home') }}#why">
                    {{ __('navigation.why') }}
                </a>
                <a class="py-2" x-on:click="handleNavLinkClick('benefits')" href="{{ route('home') }}#benefits">
                    {{ __('navigation.benefits') }}
                </a>
                <a
                    class="py-2"
                    x-on:click="handleNavLinkClick('benefits-of-renting')"
                    href="{{ route('home') }}#benefits-of-renting"
                >
                    {{ __('navigation.benefitsOfRenting') }}
                </a>
                <a class="py-2" x-on:click="handleNavLinkClick('how')" href="{{ route('home') }}#how">
                    {{ __('navigation.how') }}
                </a>
                <a class="py-2" x-on:click="handleNavLinkClick('latest')" href="{{ route('home') }}#latest">
                    {{ __('navigation.latest') }}
                </a>
                <a class="py-2" x-on:click="handleNavLinkClick('about')" href="{{ route('home') }}#about">
                    {{ __('navigation.about') }}
                </a>

                <x-link-button
                    wire:navigate.hover
                    href="{{ route('gallery') }}"
                    class="border border-black bg-white text-black hover:bg-black hover:text-white"
                >
                    {{ __('gallery.button') }}
                </x-link-button>

                <x-button modal="contact-form-modal" class="bg-black text-white hover:bg-white hover:text-black">
                    {{ __('contact.button') }}
                </x-button>
            </div>
        </div>
    </nav>
    <script>
        function handleNavLinkClick(elId) {
            document.getElementById(elId).scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    </script>
</div>
