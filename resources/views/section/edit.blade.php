<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Section') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl px-2 py-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded border">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        Edit Section
                    </p>
                </div>
                <form class="px-4 py-5 flex flex-col" action="{{ route('section.update', $section->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="sm:flex w-full gap-1">
                        <div class="w-full">
                            <div class="mb-2">
                                <x-input-label for="name" class="font-bold text-gray-800">Name</x-input-label>
                                <x-text-input id="name" class="w-full" name="name" type="text" placeholder="Enter name" :value="$section->name" />
                                <x-input-error :messages="$errors->get('name')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="section_code" class="font-bold text-gray-800">Section Code</x-input-label>
                                <x-text-input id="section_code" class="w-full" name="section_code" type="text" placeholder="Enter section code" :value="$section->section_code" />
                                <x-input-error :messages="$errors->get('section_code')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="capacity" class="font-bold text-gray-800">Capacity</x-input-label>
                                <x-text-input id="capacity" class="w-full" name="capacity" type="number" placeholder="Enter capacity" :value="$section->capacity" />
                                <x-input-error :messages="$errors->get('capacity')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="teacher_id" class="font-bold text-gray-800">Adviser</x-input-label>
                                @if(
                                    isset($teachers) && $teachers->count() > 0
                                )
                                    <select name="adviser_id" id="adviser_id" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ $teacher->id == $section->adviser_id ? 'selected' : '' }}>{{ $teacher->first_name }}, {{ $teacher->last_name }}</option>
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
                                )   <select name="grade_level_id" id="grade_level_id" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach($grade_levels as $grade_level)
                                            <option value="{{ $grade_level->id }}" {{ $grade_level->id == $section->grade_level_id ? 'selected' : '' }}>{{ $grade_level->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                <select name="grade_level_id" id="grade_level_id" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="0" selected disabled>No grade level found.</option>
                                </select>
                                @endif
                                <x-input-error :messages="$errors->get('grade_level_id')" class="" />
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="mb-2">
                                <x-input-label for="school_year_id" class="font-bold text-gray-800">Room</x-input-label>
                                @if(
                                    isset($rooms) && $rooms->count() > 0
                                )
                                    <select name="room_id" id="room_id" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="0" selected disabled>Select Room</option>
                                        @foreach($rooms as $room)
                                            <option value="{{ $room->id }}" {{ $room->id == $section->room_id ? 'selected' : '' }}>{{ $room->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                <select name="room_id" id="room_id" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="0" selected disabled>No room found.</option>
                                </select>
                                @endif
                                <x-input-error :messages="$errors->get('room_id')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="school_year_id" class="font-bold text-gray-800">School Year</x-input-label>
                                @if(
                                    isset($school_years) && $school_years->count() > 0
                                )
                                    <select name="school_year_id" id="school_year_id" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        @foreach($school_years as $school_year)
                                            <option value="{{ $school_year->id }}" {{ $school_year->id == $section->school_year_id ? 'selected' : '' }}>{{ $school_year->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="school_year_id" id="school_year_id" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="0" selected disabled>No school year found.</option>
                                    </select>
                                @endif
                                <x-input-error :messages="$errors->get('school_year_id')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="status" class="font-bold text-gray-800">Status</x-input-label>
                                <select name="status" id="status" class="w-full border-gray-300 rounded focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="active" {{ $section->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $section->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="" />
                            </div>
                            <div class="mb-2">
                                <x-input-label for="section_description" class="font-bold text-gray-800">Description</x-input-label>
                                <textarea placeholder="Optional" name="section_description" id="section_description" cols="30" rows="2" class="w-full border-gray-300 rounded resize-none focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $section->section_description }}</textarea>
                                <x-input-error :messages="$errors->get('section_description')" class="" />
                            </div>
                            
                        </div>
                    </div>
                    <div class=" flex justify-end">
                        <a href="{{ route('sections.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-300 mr-2">Back</a>
                        <x-primary-button class="">Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>