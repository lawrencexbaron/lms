<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Grade Level') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-1/2 px-2 py-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded border">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        Edit Grade Level
                    </p>
                </div>
                <form action="{{ route('grade.update', $grade->id) }}" class="px-4 py-5" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <x-input-label for="name" class="font-bold text-gray-800">Name</x-input-label>
                        <x-text-input value="{{ $grade->name }}" id="name" class="w-full" name="name" type="text" placeholder="Enter name" />
                        <x-input-error :messages="$errors->get('name')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="status" class="font-bold text-gray-800">Status</x-input-label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="active" {{ $grade->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $grade->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="" />
                    </div>
                    <div class=" flex justify-end">
                        <a href="{{ route('graderoom.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-300 mr-2">Back</a>
                        <x-primary-button class="">Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>