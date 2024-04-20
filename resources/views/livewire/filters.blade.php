<div class="container mx-auto flex flex-col py-16 md:flex-row md:justify-around">
    <div x-data="{
        dropdown: false,
    }" class="relative" x-on:click.outside="dropdown = false">
        <button
            x-on:click="dropdown = !dropdown"
            class="w-full border border-b-0 border-black px-8 py-4 hover:bg-gray md:w-56 md:border-b"
        >
            {{ __('gallery.filterRow.artists') }}
        </button>
        <ul
            x-transition:enter="transition duration-100 ease-out"
            x-transition:enter-start="scale-95 transform opacity-0"
            x-transition:enter-end="scale-100 transform opacity-100"
            x-transition:leave="transition duration-75 ease-in"
            x-transition:leave-start="scale-100 transform opacity-100"
            x-transition:leave-end="scale-95 transform opacity-0"
            x-cloak
            x-show="dropdown"
            class="absolute left-0 top-14 z-10 mt-[-1px] w-full origin-top-right border border-black bg-white md:absolute md:w-72"
        >
            @foreach ($filterArtists as $artist)
                <button
                    class="w-full px-4 hover:bg-gray"
                    wire:click="filterArtist({{ $artist['id'] }}); dropdown = !dropdown"
                    :key="{{ $artist['id'] }}"
                >
                    <li class="flex flex-row py-2 text-sm">
                        <span class="flex w-72 flex-row items-center">
                            <x-icon name="check" class="mr-4 h-6 w-6 {{ $artist['active'] ? '' : 'hidden'}}" />
                            <img
                                class="mx-2 inline-block h-10 w-10 rounded-full object-contain object-center"
                                src="{{ $artist['url'] }}"
                                alt="{{ $artist['name'] }}"
                            />
                            {{ $artist['name'] }}
                        </span>
                    </li>
                </button>
            @endforeach
        </ul>
    </div>
    @foreach ($filters as $type => $values)
        <div :key="{{ $type }}">
            <div
                x-data="{
                    dropdown: false,
                }"
                class="relative"
                x-on:click.outside="dropdown = false"
            >
                <button
                    class="w-full border border-black px-8 py-4 hover:bg-gray md:w-56"
                    x-on:click="dropdown = !dropdown"
                >
                    {{ $type }}
                </button>
                <ul
                    x-transition:enter="transition duration-100 ease-out"
                    x-transition:enter-start="scale-95 transform opacity-0"
                    x-transition:enter-end="scale-100 transform opacity-100"
                    x-transition:leave="transition duration-75 ease-in"
                    x-transition:leave-start="scale-100 transform opacity-100"
                    x-transition:leave-end="scale-95 transform opacity-0"
                    x-cloak
                    x-show="dropdown"
                    class="absolute left-0 top-14 z-10 mt-[-1px] w-full origin-top-right border border-black bg-white md:absolute md:w-72"
                >
                    @foreach ($values as $value)
                        <button
                            class="w-full px-4 hover:bg-gray"
                            wire:click="setFilter('{{ $type }}', {{ $value['id'] }});dropdown = !dropdown"
                            :key="{{ $value['id'] }}"
                        >
                            <li class="flex flex-row py-2 text-sm">
                                <span class="flex w-72 flex-row items-center">
                                    <x-icon name="check" class="h-6 w-6 {{ $value['active'] ? '' : 'hidden'}}" />
                                    {{ $value['name'] }}
                                </span>
                            </li>
                        </button>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach

    @if ($artistId !== null || $activeFilter !== null)
        <div class="relative inline-block w-full text-center md:w-56">
            <button
                class="z-50 flex w-full cursor-pointer flex-row justify-center px-8 py-4 hover:bg-gray"
                wire:click="clearFilters()"
            >
                <x-icon name="x" class="h-6 w-6" />
                {{ __('gallery.filterRow.clearAll') }}
            </button>
        </div>
    @endif
</div>
