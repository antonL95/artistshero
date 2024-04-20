<div>
    <div class="relative -z-50">
        <img
            src="{{ $post->coverImage->url }}"
            alt="{{ $post->title }}"
            class="z-0 h-[150px] w-full object-cover object-[center_12%] md:h-[500px]"
        />
        <div class="absolute top-0 z-0 flex h-[150px] w-full flex-col bg-black/[.5] md:h-[500px]"></div>
    </div>
    <div class="container mx-auto py-5 md:py-10">
        <h1 class="text-5xl text-black">{{ $post->title }}</h1>
        @if ($post->subtitle)
            <h3 class="text-2xl text-black">{{ $post->subtitle }}</h3>
        @endif

        <div class="@if($post->images->count() > 0) md:grid md:grid-cols-2 @else md:flex @endif">
            <div>
                <article class="prose">
                    {!! $post->content !!}
                </article>
            </div>
            @if ($post->images->count() > 0)
                <div>
                    <section class="splide" id="main-carousel">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach ($post->images as $item)
                                    <li class="splide__slide flex justify-center px-4">
                                        <img
                                            class="max-h-[400px] justify-self-center"
                                            src="{{ $item->url }}"
                                            alt="{{ $post->title }}"
                                        />
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                </div>
            @endif
        </div>
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
