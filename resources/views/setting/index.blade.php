<x-app-layout>

<div class="py-12">
    <div class="max-w-5xl flex flex-col mx-auto sm:px-6 lg:px-8">
        <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
            <div class="border-b px-3 py-2">
                <p class="text-md font-medium">
                    {{ __('Settings') }}
                </p>
            </div>
            <div class="p-5 overflow-y-auto flex flex-col gap-1">
                <div class="flex flex-col">
                    <x-input-label for="name" :value="__('System Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" disabled />
                </div>
                <div class="flex flex-col">
                    <x-input-label for="email" :value="__('System Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" disabled />
                </div>
                <div class="flex flex-col">
                    <x-input-label for="logo" :value="__('Logo')" />
                    <x-text-input id="logo" class="block mt-1 w-full" type="text" name="logo" disabled />
                </div>
                <div class="flex flex-col">
                    <x-input-label for="favicon" :value="__('Favicon')" />
                    <x-text-input id="favicon" class="block mt-1 w-full" type="text" name="favicon" disabled />
                </div>
                <div class="flex flex-col">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" disabled />
                </div>
                <div class="flex flex-col">
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" disabled />
                </div>
                <div class="flex justify-end w-full mt-1">
                    <x-primary-button class="ml-3">
                        {{ __('Save') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>