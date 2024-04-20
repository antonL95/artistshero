@php
    use App\Models\Artist;
@endphp

<div>
    <livewire:filters />
    @if (count($products))
        @foreach ($products as $artistId => $artistProducts)
            @php
                $artist = Artist::with('profileImage')->find($artistId);
            @endphp

            <div class="odd:bg-white even:bg-gray" wire:key="{{ $artistId }}">
                <div class="container mx-auto">
                    <div class="md:py-8">
                        <div class="flex px-5 pb-5">
                            <img
                                src="{{ $artist->profileImage->url }}"
                                alt="{{ $artist->name }}"
                                class="h-[80px] w-[80px] rounded-full"
                            />
                            <a
                                class="flex flex-col justify-items-center"
                                href="{{ route('artist.detail', ['id' => $artist->id]) }}"
                            >
                                <span class="my-auto self-center pl-2 text-2xl">
                                    {{ $artist->name }}
                                </span>
                            </a>
                        </div>
                        <div class="md:container md:mx-auto">
                            <livewire:carousel :items="$artistProducts" :key="$artist->id" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center md:py-36">
            <h2 class="text-3xl">{{ __('other.noProductsFound') }}</h2>
        </div>
    @endif
</div>
