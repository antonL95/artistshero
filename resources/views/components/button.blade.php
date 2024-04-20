<button
    @isset($modal)
        x-on:click="$modalOpen('{{ $modal }}')"
    @endisset
    {{ $attributes->merge(["class" => "border border-black px-8 py-4 font-roboto font-normal focus:outline-none"]) }}
>
    {{ $slot }}
</button>
