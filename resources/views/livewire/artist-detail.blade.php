@php
    use Diglactic\Breadcrumbs\Breadcrumbs;
@endphp

<div>
    <div class="relative -z-50">
        <img
            class="z-0 h-[150px] w-full object-cover object-[center_12%] md:h-[500px]"
            src="{{ $artist->coverImage->url }}"
            alt="{{ $artist->name }}"
        />
        <div class="absolute top-0 z-0 flex h-[150px] w-full flex-col bg-black/[.5] md:h-[500px]"></div>
    </div>
    <div class="container z-10 mx-auto mt-[-50px] md:mt-[-150px]">
        <img
            src="{{ $artist->profileImage->url }}"
            alt="{{ $artist->name }}"
            class="h-[100px] w-[100px] flex-none rounded-full border-4 border-white object-contain object-center md:h-[200px] md:w-[200px]"
        />
    </div>
    <div class="container mx-auto py-5 md:py-10">
        <h1 class="text-5xl text-black">
            {{ $artist->name }}
        </h1>
        <div class="md:grid md:grid-cols-2">
            <div>
                <article class="prose">
                    {!! $artist->bio !!}
                </article>
            </div>
            <section class="splide" id="main-carousel">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($artist->otherImages as $item)
                            <li class="splide__slide flex justify-center px-4">
                                <img
                                    class="max-h-[400px] justify-self-center"
                                    src="{{ $item->url }}"
                                    alt="{{ $artist->name }}"
                                />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
    @if ($artist->products)
        <div class="container mx-auto py-5 md:py-10">
            <h2 class="text-3xl text-black">
                {{ __('gallery.artistDetail.artworks') }}
            </h2>
            <livewire:carousel :items="$artist->products()->with('images')->get()->toArray()" />
        </div>
    @endif

    <div class="container mx-auto py-5 md:py-10">
        {{ Breadcrumbs::render('artist.detail', $artist) }}
    </div>
</div>

@script
    <script>
        new Splide(document.querySelector('#main-carousel'), {
            pagination: false,
            arrows: true,
            perPage: 1,
        }).mount();
    </script>
@endscript
