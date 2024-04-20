<section class="splide max-h-[520px]">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach ($items as $item)
                <li class="splide__slide w-[300px] px-4">
                    <a href="/products/{{ $item->id }}">
                        <img class="max-h-[400px] w-full" src="{{ $item->images[0]->url }}" alt="{{ $item->name }}" />
                        <h2 class="text-2xl">{{ $item->name }}</h2>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
