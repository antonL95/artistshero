<div class="container mx-auto md:mb-8">
    <div class="py-5 md:py-10">
        {{ Breadcrumbs::render('product.detail', $product) }}
    </div>
    <div class="flex flex-col md:grid md:grid-cols-2">
        <div class="flex justify-center">
            <section class="splide" id="main-carousel">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($product->images as $item)
                            <li class="splide__slide flex justify-center px-4">
                                <img
                                    class="max-h-[400px] justify-self-center"
                                    src="{{ $item->url }}"
                                    alt="{{ $product->name }}"
                                />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        <div class="md:mx-auto md:w-8/12">
            <h1 class="my-4 text-3xl md:my-0">
                {{ $product->name }}
            </h1>
            <p class="md:my-8">
                {{ __('gallery.productDetail.by') }}
                <a class="text-gray-60 underline" href="{{ route('artist.detail', ['id' => $product->artist->id]) }}">
                    {{ $product->artist->name }}
                </a>
            </p>
            @foreach ($product->filters as $filter)
                <div :key="{{ $filter->id }}">
                    <p class="mt-8 text-sm uppercase text-gray-60">
                        {{ $filter->type }}
                    </p>
                    <p class="mt-1 text-base">
                        {{ $filter->name }}
                    </p>
                </div>
            @endforeach

            <p class="mt-8 text-sm uppercase text-gray-60">
                {{ __('gallery.productDetail.description') }}
            </p>
            <article class="prose">
                {!! $product->description !!}
            </article>
        </div>
    </div>
    @if ($otherProducts !== null)
        <div class="py-4">
            <h2 class="text-2xl font-medium">
                {{ __('gallery.productDetail.otherArtworks') }}
            </h2>
            <livewire:carousel :items="$otherProducts" />
        </div>
    @endif
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
