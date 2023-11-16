<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Section Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl px-2 py-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded px-4 py-5 border">
                <div class="mb-2">
                    <x-input-label for="name" class="font-bold text-gray-800">Name</x-input-label>
                    <x-text-input id="name" name="name" type="text" class="w-full" value="{{ $section->name }}" disabled />
                </div>
                <div class="mb-2">
                    <x-input-label for="section_code" class="font-bold text-gray-800">Section Code</x-input-label>
                    <x-text-input id="section_code" name="section_code" type="text" class="w-full" value="{{ $section->section_code }}" disabled />
                </div>
                <div class="mb-2">
                    <x-input-label for="capacity" class="font-bold text-gray-800">Capacity</x-in    put-label>  
                    <x-text-input id="capacity" name="capacity" type="text" class="w-full" value="{{ $section->capacity }}" disabled />
                </div>
                <div class="mb-2">
                    <x-input-label for="adviser_id" class="font-bold text-gray-800">Adviser</x-input-label>
                    <x-text-input id="adviser_id" name="adviser_id" type="text" class="w-full" value="{{ $section->adviser->first_name }}, {{ $section->adviser->last_name }}" disabled />
                </div>
                <div class="mb-2">
                    <x-input-label for="grade_level_id" class="font-bold text-gray-800">Grade Level</x-input-label>
                    <x-text-input id="grade_level_id" name="grade_level_id" type="text" class="w-full" value="{{ $section->grade->name }}" disabled />
                </div>
                <div class="mb-2">
                    <x-input-label for="school_year_id" class="font-bold text-gray-800">School Year</x-input-label>
                    <x-text-input id="school_year_id" name="school_year_id" type="text" class="w-full" value="{{ $section->schoolyear->name }}" disabled />
                </div>
                <div class="mb-2">
                    <x-input-label for="section_description" class="font-bold text-gray-800">Description</x-input-label>
                    <x-text-input id="section_description" name="section_description" type="text" class="w-full" value="{{ $section->section_description }}" disabled />
                </div>
                <div class="mb-2">
                    <x-input-label for="status" class="font-bold text-gray-800">Status</x-input-label>
                    @if($section->status == 'active')
                        <x-text-input id="status" name="status" type="text" class="w-full" value="Active" disabled />
                    @else
                        <x-text-input id="status" name="status" type="text" class="w-full" value="Inactive" disabled />
                    @endif
                </div>
                <div class=" flex justify-end">
                    <a href="{{ route('sections.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-300 mr-2">Back</a>
                    <a href="{{ route('section.edit', $section->id) }}" class="bg-blue-500 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-600">Edit</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>