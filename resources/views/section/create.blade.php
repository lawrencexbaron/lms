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
                        Create Section
                    </p>
                </div>
                <form action="{{ route('section.store') }}" class="px-4 py-5" method="POST">
                    @csrf
                    <div class="mb-2">
                        <x-input-label for="name" class="font-bold text-gray-800">Name</x-input-label>
                        <x-text-input id="name" class="w-full" name="name" type="text" placeholder="Enter name" />
                        <x-input-error :messages="$errors->get('name')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="section_code" class="font-bold text-gray-800">Section Code</x-input-label>
                        <x-text-input id="section_code" class="w-full" name="section_code" type="text" placeholder="Enter section code" />
                        <x-input-error :messages="$errors->get('section_code')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="capacity" class="font-bold text-gray-800">Capacity</x-input-label>
                        <x-text-input id="capacity" class="w-full" name="capacity" type="number" placeholder="Enter capacity" />
                        <x-input-error :messages="$errors->get('capacity')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="teacher_id" class="font-bold text-gray-800">Adviser</x-input-label>
                        @if(
                            isset($teachers) && $teachers->count() > 0
                        )
                            <select name="adviser_id" id="adviser_id" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="0" selected disabled>Select Teacher</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->first_name }}, {{ $teacher->last_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="text-red-500">No teacher found.</p>
                        @endif
                        <x-input-error :messages="$errors->get('adviser_id')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="grade_level_id" class="font-bold text-gray-800">Grade Level</x-input-label>
                        @if(
                            isset($grade_levels) && $grade_levels->count() > 0
                        )   <select name="grade_level_id" id="grade_level_id" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="0" selected disabled>Select Grade Level</option>
                                @foreach($grade_levels as $grade_level)
                                    <option value="{{ $grade_level->id }}">{{ $grade_level->name }}</option>
                                @endforeach
                            </select>
                        @else
                        <select name="grade_level_id" id="grade_level_id" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0" selected disabled>No grade level found.</option>
                        </select>
                        @endif
                        <x-input-error :messages="$errors->get('grade_level_id')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="school_year_id" class="font-bold text-gray-800">School Year</x-input-label>
                        @if(
                            isset($school_years) && $school_years->count() > 0
                        )
                            <select name="school_year_id" id="school_year_id" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="0" selected disabled>Select School Year</option>
                                @foreach($school_years as $school_year)
                                    <option value="{{ $school_year->id }}">{{ $school_year->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <select name="school_year_id" id="school_year_id" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="0" selected disabled>No school year found.</option>
                            </select>
                        @endif
                        <x-input-error :messages="$errors->get('school_year_id')" class="" />
                    </div>
                    <div class="mb-2">
                       <x-input-label for="section_description" class="font-bold text-gray-800">Description</x-input-label>
                        <textarea placeholder="Optional" name="section_description" id="section_description" cols="30" rows="2" class="w-full border-gray-300 rounded mt-1 resize-none focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        <x-input-error :messages="$errors->get('section_description')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="status" class="font-bold text-gray-800">Status</x-input-label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="" />
                    </div>
                    <div class=" flex justify-end">
                        <a href="{{ route('sections.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-300 mr-2">Back</a>
                        <x-primary-button class="">Create</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>