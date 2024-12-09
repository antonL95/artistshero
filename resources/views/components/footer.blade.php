<div class="bg-black">
    <section
        class="container grid grid-cols-1 items-center justify-center pt-16 md:mx-auto md:flex md:w-5/12 md:flex-col md:justify-center"
    >
        <h2
            class="text-center text-[2rem] font-medium text-white md:mb-12 md:mt-28 md:text-center md:text-5xl 2xl:whitespace-pre-line"
        >
            {{ __('footer.heading') }}
        </h2>
        <div class="grid grid-cols-1 md:flex md:flex-row md:justify-between">
            <x-button
                onclick="$modalOpen('contact-form-modal')"
                class="mb-4 mt-8 border border-white bg-white text-black hover:border-white hover:bg-black hover:text-white md:mb-0 md:mr-5 md:mt-0"
            >
                {{ __('contact.button') }}
            </x-button>

            <x-link-button
                wire:navigate.hover
                href="{{ route('gallery') }}"
                class="border border-white bg-black text-white hover:bg-white hover:text-black md:mr-0"
            >
                {{ __('gallery.button') }}
            </x-link-button>
        </div>
        <div class="text-white md:mt-5">
            <h2 class="p-2.5 text-center text-3xl">
                <img
                    class="mx-auto mb-10 w-6/12 rounded-full"
                    src="{{ asset('img/marek.webp') }}"
                    alt="{{ config('app.name') }} - Marek Jakubek"
                />
                Marek Jakúbek, Founder & CEO
            </h2>
            <p class="flex flex-col md:grid md:grid-cols-2">
                <span class="text-center">
                    <a href="mailto:marek@artistshero.com" class="w-full p-2.5 text-center text-lg underline">
                        marek@artistshero.com
                    </a>
                </span>
                <span class="text-center">
                    <a href="tel:+421951121167" class="w-full p-2.5 text-lg underline">+421 951 121 167</a>
                </span>
            </p>
        </div>
    </section>
    <div class="container mx-auto pb-14 md:pb-16">
        <hr class="mb-16 mt-24 h-px w-full border-b border-white border-opacity-20" />
        <img src="{{ asset('img/logo_white.svg') }}" alt="{{ config('app.name') }} - logo" width="100" height="100" />
        <p class="mt-4 text-xs text-gray-80">
            © {{ now()->year }}
            {{ config('app.name') }}
        </p>
    </div>
</div>
