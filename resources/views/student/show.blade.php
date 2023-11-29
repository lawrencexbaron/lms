<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12 flex" x-data="StudentShow()">
        <div class="max-w-7xl w-full flex gap-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white w-1/4 sm:h-[410px] flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="px-5 py-8 flex flex-col border-b items-center justify-center text-center">
                    <p class="font-bold text-2xl mb-2">
                        {{ $student->first_name }} {{ $student->last_name }}
                    </p>
                    <p class="text-md">
                        {{ $student->student_number }}
                    </p>
                    <p class="text-md font-semibold text-blue-800">
                        {{ $student->grade->name }} Student
                    </p>
                    <p class="text-md font-semibold text-blue-800">
                        {{ $student->section ? $student->section->name : '' }}
                    </p>
                </div>
                <div class="p-3 flex flex-col">
                    <div class="flex justify-between px-2.5 py-2 border-b">
                        <p class="font-semibold">Student Type:</p>
                        <p class="capitalize text-sm">{{ $student->student_type }}</p>
                    </div>
                    <div class="flex justify-between px-2.5 py-2 border-b">
                        <p class="font-semibold">Birthdate:</p>
                        <p class="text-sm">{{ date('F j, Y', strtotime($student->birthdate)) }}</p>
                    </div>
                    <div class="flex justify-between px-2.5 py-2 border-b">
                        <p class="font-semibold">Date Enrolled:</p>
                        <p class="text-sm">{{ date('F j, Y', strtotime($student->created_at)) }}</p>
                    </div>
                    <div class="flex justify-between px-2.5 py-2">
                        <p class="font-semibold">Status:</p>
                        <p class="capitalize text-sm">
                            @if($student->status == 'active')
                                <span class="text-green-600 font-semibold">Active</span>
                            @else
                                <span class="text-red-600 font-semibold">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div class="my-1 flex">
                        <x-danger-button class="w-full justify-center text-center">
                            Archive Student
                        </x-danger-button>
                    </div>
                </div>
            </div>
            <div class="bg-white p-3 w-3/4 flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="flex border-b gap-4 w-full">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <div class="flex-1 py-2 text-center cursor-pointer"
                            :class="activeTab===index ? 'border-b-2 text-black border-blue-800 cursor-pointer hover:border-b-2 hover:border-b-blue-800 py-2 hover:text-black font-medium transition' : 'cursor-pointer hover:border-b-2 hover:border-b-blue-800 py-2 text-gray-500 hover:text-black font-medium transition'"
                            @click="setActiveTab(index)">
                            <p x-text="tab"></p>
                        </div>
                    </template>
                </div>
                <div class="flex my-2 w-full px-2 items-center justify-center">
                    <div x-show="activeTab === 0" class="flex flex-col gap-2">
                        {{-- First Row --}}
                        <div class="flex gap-1">
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" />
                                <x-text-input id="first_name" class="block mt-1 w-full" type="text" readonly name="first_name" :value="$student->first_name" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="middle_name" :value="__('Middle Name')" />
                                <x-text-input id="middle_name" class="block mt-1 w-full" type="text" readonly name="middle_name" :value="$student->middle_name" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="last_name" :value="__('Last Name')" />
                                <x-text-input id="last_name" class="block mt-1 w-full" type="text" readonly name="last_name" :value="$student->last_name" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="suffix" :value="__('Suffix')" />
                                <x-text-input id="suffix" class="block mt-1 w-full" type="text" readonly name="suffix" :value="$student->suffix" required autofocus />
                            </div>
                        </div>
                        {{-- Second Row --}}
                        <div class="flex gap-1">
                            <div>
                                <x-input-label for="student_number" :value="__('Student Number')" />
                                <x-text-input id="student_number" class="block mt-1 w-full" type="text" readonly name="student_number" :value="$student->student_number" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="grade_level" :value="__('Grade Level')" />
                                <x-text-input id="grade_level" class="block mt-1 w-full" type="text" readonly name="grade_level" :value="$student->grade->name" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="section" :value="__('Section')" />
                                <x-text-input id="section" class="block mt-1 w-full" type="text" readonly name="section" :value="$student->section ? $student->section->name : 'Not Enrolled'" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="student_type" :value="__('Student Type')" />
                                <x-text-input id="student_type" class="block mt-1 w-full" type="text" readonly name="student_type" :value="$student->student_type" required autofocus />
                            </div>
                        </div>
                        {{-- Third Row --}}
                        <div class="gap-1 flex">
                            <div>
                                <x-input-label for="lrn" :value="__('LRN Status')" />
                                <x-text-input id="lrn" class="block mt-1 w-full" type="text" readonly name="lrn" :value="$student->learner_status" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="lrn" :value="__('LRN')" />
                                <x-text-input id="lrn" class="block mt-1 w-full" type="text" readonly name="lrn" :value="$student->lrn" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="psa" :value="__('PSA No.')" />
                                <x-text-input id="psa" class="block mt-1 w-full" type="text" readonly name="psa" :value="$student->psa_no" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="gender" :value="__('Gender')" />
                                <x-text-input id="gender" class="block mt-1 w-full" type="text" readonly name="gender" :value="$student->gender" required autofocus />
                            </div>
                        </div>
                        {{-- Fourth Row --}}
                        <div class="flex gap-1">
                            <div>
                                <x-input-label for="birthdate" :value="__('Birthdate')" />
                                <x-text-input id="birthdate" class="block mt-1 w-full" type="text" readonly name="birthdate" :value="date('F j, Y', strtotime($student->birthdate))" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="age" :value="__('Age')" />
                                <x-text-input id="age" class="block mt-1 w-full" type="text" readonly name="age" :value="$age = date('Y') - date('Y', strtotime($student->birthdate))" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="birthplace" :value="__('Birth Place')" />
                                <x-text-input id="birthplace" class="block mt-1 w-full" type="text" readonly name="birthplace" :value="$student->place_of_birth" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="mothertongue" :value="__('Mother Tongue')" />
                                <x-text-input id="mothertongue" class="block mt-1 w-full" type="text" readonly name="mothertongue" :value="$student->mother_tongue" required autofocus />
                            </div>
                        </div>
                        {{-- Fifth Row --}}
                        <div class="flex gap-1">
                            <div>
                                <x-input-label for="previouslevel" :value="__('Last Grade Level')" />
                                <x-text-input id="previouslevel" class="block mt-1 w-full" type="text" readonly name="previouslevel" :value="$student->previous_level ?? 'N/A' " required autofocus />
                            </div>
                            <div>
                                <x-input-label for="schoolyear" :value="__('Last School Year')" />
                                <x-text-input id="schoolyear" class="block mt-1 w-full" type="text" readonly name="schoolyear" :value="$student->previous_sy_attended ?? 'N/A' " required autofocus />
                            </div>
                            <div>
                                <x-input-label for="section" :value="__('Last School Year')" />
                                <x-text-input id="section" class="block mt-1 w-full" type="text" readonly name="section" :value="$student->previous_section ?? 'N/A' " required autofocus />
                            </div>
                            <div>
                                <x-input-label for="gwa" :value="__('General Weighted Average')" />
                                <x-text-input id="gwa" class="block mt-1 w-full" type="text" readonly name="gwa" :value="$student->gwa" required autofocus />
                            </div>
                        </div>
                        {{-- Sixth Row --}}
                        <div class="flex gap-1">
                            <div>
                                <x-input-label for="houseno" :value="__('House No.')" />
                                <x-text-input id="houseno" class="block mt-1 w-full" type="text" readonly name="houseno" :value="$student->address->house_no" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="street" :value="__('Street')" />
                                <x-text-input id="street" class="block mt-1 w-full" type="text" readonly name="street" :value="$student->address->street" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="barangay" :value="__('Barangay')" />
                                <x-text-input id="barangay" class="block mt-1 w-full" type="text" readonly name="barangay" :value="$student->address->barangay" required autofocus />
                            </div>
                            <div>
                                <x-input-label for="city" :value="__('City/Municipality')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" readonly name="city" :value="$student->address->city_municipality" required autofocus />
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 1" class="flex flex-col gap-2 w-full">
                        {{-- First Row --}}
                        <div class="flex gap-1 w-full">
                            <div class="w-full">
                                <x-input-label for="father_name" :value="__('Father\'s Name')" />
                                <x-text-input id="father_name" class="block mt-1 w-full" type="text" readonly name="father_name" :value="$student->parent->father_name" required autofocus />
                            </div>
                            <div class="w-full">
                                <x-input-label for="father_contact" :value="__('Father\'s Contact No.')" />
                                <x-text-input id="father_contact" class="block mt-1 w-full" type="text" readonly name="father_contact" :value="$student->parent->father_contact_number" required autofocus />
                            </div>
                        </div>
                        {{-- Second Row --}}
                        <div class="flex gap-1 w-full">
                            <div class="w-full">
                                <x-input-label for="mother_name" :value="__('Mother\'s Name')" />
                                <x-text-input id="mother_name" class="block mt-1 w-full" type="text" readonly name="mother_name" :value="$student->parent->mother_name" required autofocus />
                            </div>
                            <div class="w-full">
                                <x-input-label for="mother_contact" :value="__('Mother\'s Contact No.')" />
                                <x-text-input id="mother_contact" class="block mt-1 w-full" type="text" readonly name="mother_contact" :value="$student->parent->mother_contact_number" required autofocus />
                            </div>
                        </div>
                        {{-- Third Row --}}
                        <div class="flex gap-1 w-full">
                            <div class="w-full">
                                <x-input-label for="guardian_name" :value="__('Guardian\'s Name')" />
                                <x-text-input id="guardian_name" class="block mt-1 w-full" type="text" readonly name="guardian_name" :value="$student->parent->guardian_name" required autofocus />
                            </div>
                            <div class="w-full">
                                <x-input-label for="guardian_contact" :value="__('Guardian\'s Contact No.')" />
                                <x-text-input id="guardian_contact" class="block mt-1 w-full" type="text" readonly name="guardian_contact" :value="$student->parent->guardian_contact_number" required autofocus />
                            </div>
                        </div>
                    </div>
                    <div x-show="activeTab === 2" class="flex flex-col gap-2">
                        <div class="flex gap-1 w-full">
                            <p>Preferred Distance Learning Modules to Distance Learning</p>
                        </div>
                        <div class="flex gap-1">
                            <div class="grid grid-cols-2 gap-2 my-4">
                                @if(isset($modules) && $modules->count() > 0)
                                    @foreach($modules as $module)
                                        <div class="flex gap-2 items-center">
                                            <input type="checkbox" value="{{ $module->id }}" name="modules[]" id="module_{{ $module->id }}" class="border-gray-300 rounded-md" {{ $student->modules->contains('module_id', $module->id) ? 'checked' : '' }} />
                                            <x-input-label :for="'module_' . $module->id" :value="$module->name" />
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function StudentShow(){
        return{
            activeTab: 0,
            tabs: [
                'Student Profile',
                'Parent/Guardian Information',
                'Preferred Learning Modules'
            ],
            setActiveTab(index){
                this.activeTab = index
            }
        }
    }
</script>