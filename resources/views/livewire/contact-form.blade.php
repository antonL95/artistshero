<div class="flex flex-col justify-between w-full">
    <h2 class="font-urbanist text-center text-4xl">
        {{ __('contact.heading') }}
    </h2>
    <form wire:submit="sendMessage">
        <x-input-group name="name" wire:model="name" label="{{ __('contact.form.name') }}" />
        <x-input-group name="email" wire:model="email" label="{{ __('contact.form.email') }}" />
        <x-input-group name="subject" wire:model="subject" label="{{ __('contact.form.subject') }}" />
        <div>
            <label for="message" class="font-urbanist block text-sm font-medium leading-6 text-gray-900">
                {{ __('contact.form.message') }}
            </label>
            <div class="relative mt-2 rounded-md shadow-sm">
                <textarea
                    id="message"
                    name="message"
                    wire:model="message"
                    :class="{'text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500': {{ $errors->has('message') ? 'true' : 'false' }} }"
                    class="block w-full border-0 py-1.5 pr-10 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6"
                ></textarea>
            </div>

            @error('message')
                <p class="mt-2 text-sm text-red-600" id="email-error">
                    {{ $message }}
                </p>
            @enderror
        </div>
        <x-button type="submit" class="mt-3 w-full bg-black text-white hover:bg-white hover:text-black">
            {{ __('contact.form.button') }}
        </x-button>
    </form>
</div>
