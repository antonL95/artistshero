<section class="splide max-h-[520px]">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach ($items as $item)
                <li class="splide__slide w-[300px] px-4">
                    <a href="{{ route('product.detail', ['id' => $item['id']]) }}" wire:navigate.hover>
                        <img
                            class="max-h-[400px] w-full"
                            src="{{ $item['images'][0]['url'] }}"
                            alt="{{ $item['name'][app()->getLocale()] }}"
                        />
                        <h2 class="text-2xl">{{ $item['name'][app()->getLocale()] }}</h2>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>

@script
    <script>
        const carousels = document.querySelectorAll('.splide');

        for (let i = 0; i < carousels.length; i++) {
            new Splide(carousels[i], {
                pagination: false,
                autoWidth: true,
                breakpoints: {
                    850: {
                        perPage: 1,
                    },
                },
            }).mount();
        }
    </script>
@endscript
