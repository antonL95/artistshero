<div
    {{ $attributes->merge(['class' => 'flex flex-col justify-center']) }}
    x-data="{
        expanded: false,
        toggle() {
            this.expanded = ! this.expanded
        },
    }"
>
    <article
        x-collapse.min.240px
        x-show="expanded"
        class="mt-4 grid grid-cols-1 justify-items-center self-center overflow-y-hidden whitespace-pre-line"
    >
        {{ $content }}
    </article>
    <button x-on:click="toggle()">
        <x-icon name="plus" class="mx-auto h-6 w-6" x-bind:class="{'hidden': expanded}" />
        <x-icon name="minus" class="mx-auto h-6 w-6" x-cloak x-bind:class="{'hidden': !expanded}" />
    </button>
</div>
