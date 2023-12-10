<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl px-2 py-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded border">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        Create Adviser
                    </p>
                </div>
                <form action="{{ route('advisers.store') }}" class="px-4 py-5 flex flex-col" method="POST">
                    @csrf
                    <div class="sm:flex w-full gap-1">
                        <div class="w-full">
                            <div class="mb-2">
                                <x-input-label for="first_name" class="font-bold text-gray-800">First Name</x-input-label>
                                <x-text-input id="first_name" class="w-full" name="first_name" type="text" placeholder="Enter First name" />
                                <x-input-error :messages="$errors->get('first_name')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="middle_name" class="font-bold text-gray-800">Middle Name</x-input-label>
                                <x-text-input id="middle_name" class="w-full" name="middle_name" type="text" placeholder="Enter Middle name" />
                                <x-input-error :messages="$errors->get('middle_name')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="last_name" class="font-bold text-gray-800">Last Name</x-input-label>
                                <x-text-input id="last_name" class="w-full" name="last_name" type="text" placeholder="Enter Last name" />
                                <x-input-error :messages="$errors->get('last_name')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="email" class="font-bold text-gray-800">Email</x-input-label>
                                <x-text-input id="email" class="w-full" name="email" type="text" placeholder="Enter Email" />
                                <x-input-error :messages="$errors->get('email')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="phone" class="font-bold text-gray-800">Phone Number</x-input-label>
                                <x-text-input id="phone" class="w-full" name="phone" type="text" placeholder="Enter Phone Number" />
                                <x-input-error :messages="$errors->get('phone')" class="" />
                            </div>
                        </div>
                    
                    </div>
                    <div class="flex w-full items-end justify-end">
                        <a href="{{ route('advisers.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-300 mr-2">Back</a>
                        <x-primary-button class="">Create</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>