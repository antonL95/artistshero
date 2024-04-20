@props([
    'name',
    'label',
])
<div>
    <label for="{{ $name }}" class="font-urbanist block text-sm leading-6 text-gray-900">
        {{ $label }}
    </label>
    <div class="relative mt-2 rounded-md shadow-sm">
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $attributes }}
            :class="{'text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500': {{ $errors->has($name) ? 'true' : 'false' }} }"
            class="block w-full border-0 py-1.5 pr-10 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
        />
    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600">
            {{ $message }}
        </p>
    @enderror
</div>
