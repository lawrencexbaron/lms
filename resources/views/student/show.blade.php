<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Students') }}
        </h2>
    </x-slot>

    <div class="py-12 flex" x-data="StudentShow()">
        <div class="max-w-7xl w-full flex flex-col sm:flex-row gap-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white sm:w-1/4 sm:h-[410px] flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="px-5 py-8 flex flex-col border-b items-center justify-center text-center">
                    <p class="font-bold text-2xl mb-2">
                        {{ $student->first_name }} {{ $student->last_name }} {{ $student->suffix ?? ''  }}
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
                        <form class="w-full" action="{{ route('student.destroy', $student->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="text-center w-full justify-center" onclick="return confirm('Are you sure you want to delete this student?')">
                                Archive Student
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
            <div x-cloak x-bind:class="{
                'sm:h-[320px]': activeTab === 1,
                'sm:h-[290px]': activeTab === 2
            }" class="bg-white p-3 sm:w-3/4 flex-col border rounded shadow-sm mt-2">
                <div class="flex border-b gap-4 w-full">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <div class="flex-1 py-2 text-center cursor-pointer items-center justify-center"
                            :class="activeTab===index ? 'border-b-2 text-black border-blue-800 cursor-pointer hover:border-b-2 hover:border-b-blue-800 py-2 hover:text-black font-medium transition' : 'cursor-pointer hover:border-b-2 hover:border-b-blue-800 py-2 text-gray-500 hover:text-black font-medium transition'"
                            @click="setActiveTab(index)">
                            <p x-text="tab" class="text-xs sm:text-sm flex items-center justify-center"></p>
                        </div>
                    </template>
                </div>
                <div class="flex flex-col">
                    <div class="flex my-2 w-full px-2 items-center justify-center">
                        <div x-show="activeTab === 0" class="flex flex-col w-full justify-between">
                            <div class="flex flex-col gap-2">
                                {{-- First Row --}}
                                <div class="sm:flex gap-2 w-full grid grid-cols-2">
                                    <div class="w-full">
                                        <x-input-label for="first_name" :value="__('First Name')" />
                                        <x-text-input x-model="formData.first_name" id="first_name" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="first_name" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="middle_name" :value="__('Middle Name')" />
                                        <x-text-input x-model="formData.middle_name" id="middle_name" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="middle_name" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="last_name" :value="__('Last Name')" />
                                        <x-text-input x-model="formData.last_name" id="last_name" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="last_name" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="suffix" :value="__('Suffix')" />
                                        <x-text-input x-model="formData.suffix" id="suffix" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="suffix" required autofocus />
                                    </div>
                                </div>
                                {{-- Second Row --}}
                                <div class="sm:flex gap-2 w-full grid grid-cols-2">
                                    <div class="w-full">
                                        <x-input-label for="student_number" :value="__('Student Number')" />
                                        <x-text-input id="student_number" class="block mt-1 w-full" type="text" disabled name="student_number" :value="$student->student_number" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="grade_level" :value="__('Grade Level')" />
                                        <select x-model="formData.grade_level" x-bind:disabled="!studentProfileEdit" name="grade_level" id="grade_level" class="border-gray-300 mt-1 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="" disabled readonly>Select Grade Level</option>
                                            @if(isset($grades))
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade->id }}" {{ $grade->id == $student->grade_level_id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="section" :value="__('Section')" />
                                        <select x-model="formData.section" x-bind:disabled="!studentProfileEdit" name="section" id="section" class="border-gray-300 mt-1 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="" readonly selected>Not Enrolled</option>
                                            @if(isset($sections))
                                                @foreach($sections as $section)
                                                    <option value="{{ $section->id }}" {{ $section->id == $student->section_id ? 'selected' : '' }}>{{ $section->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="student_type" :value="__('Student Type')" />
                                        <select x-model="formData.student_type" name="student_type" id="student_type" x-bind:disabled="!studentProfileEdit" class="border-gray-300 mt-1 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="new" {{ $student->student_type == 'new' ? 'selected' : '' }}>New Student</option>
                                            <option value="old" {{ $student->student_type == 'old' ? 'selected' : '' }}>Old Student</option>
                                            <option value="transferee" {{ $student->student_type == 'transferee' ? 'selected' : '' }}>Transferee</option>
                                            <option value="balik_aral" {{ $student->student_type == 'balik_aral' ? 'selected' : '' }}>Balik Aral</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- Third Row --}}
                                <div class="sm:flex gap-2 w-full grid grid-cols-2">
                                    <div class="w-full">
                                        <x-input-label for="lrn" :value="__('Learner Status')" />
                                        {{-- <x-text-input id="lrn" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="lrn" :value="$student->learner_status" required autofocus /> --}}
                                        <select x-model="formData.learner_status" name="learner_status" id="learner_status" x-bind:disabled="!studentProfileEdit" class="border-gray-300 mt-1 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="" disabled readonly>Select Learner Status</option>
                                            <option value="1" {{ $student->learner_status == 1 ? 'selected' : '' }}>No LRN</option>
                                            <option value="2" {{ $student->learner_status == 2 ? 'selected' : '' }}>With LRN</option>
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="lrn" :value="__('LRN')" />
                                        <x-text-input x-model="formData.lrn" id="lrn" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="lrn" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="psa" :value="__('PSA No.')" />
                                        <x-text-input x-model="formData.psa_no" id="psa" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="psa" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="gender" :value="__('Gender')" />
                                        <select x-model="formData.gender" name="gender" id="gender" x-bind:disabled="!studentProfileEdit" class="capitalize border-gray-300 mt-1 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- Fourth Row --}}
                                <div class="sm:flex gap-2 w-full grid grid-cols-2">
                                    <div class="w-full">
                                        <x-input-label for="birthdate" :value="__('Birthdate')" />
                                        <x-text-input x-model="formData.date_of_birth" id="birthdate" class="block w-full mt-1" max="{{ date('Y-m-d') }}" type="date" x-bind:disabled="!studentProfileEdit" name="birthdate" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="age" :value="__('Age')" />
                                        <x-text-input id="age" class="block mt-1 w-full" type="text" disabled name="age" :value="$age = date('Y') - date('Y', strtotime($student->birthdate))" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="birthplace" :value="__('Birth Place')" />
                                        <x-text-input x-model="formData.place_of_birth" id="birthplace" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="birthplace" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="mothertongue" :value="__('Mother Tongue')" />
                                        {{-- <x-text-input id="mothertongue" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="mothertongue" :value="$student->mother_tongue" required autofocus /> --}}
                                        <select x-model="formData.mother_tongue" name="mother_tongue" id="mother_tongue" x-bind:disabled="!studentProfileEdit" class="border-gray-300 mt-1 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="">Select Mother Tongue</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Tagalog">Tagalog</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Cebuano">Cebuano</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Ilocano">Ilocano</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Hiligaynon">Hiligaynon</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Waray">Waray</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Kapampangan">Kapampangan</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Bicolano">Bicolano</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Pangasinense">Pangasinense</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Maranao">Maranao</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Maguindanaoan">Maguindanaoan</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Tausug">Tausug</option>
                                            <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- Fifth Row --}}
                                <div class="sm:flex gap-2 w-full grid grid-cols-2">
                                    <div class="w-full">
                                        <x-input-label for="previouslevel" :value="__('Last Grade Level')" />
                                            <select x-model="formData.previous_level" name="previous_level" id="previous_level" x-bind:disabled="!studentProfileEdit" class="border-gray-300 mt-1 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                {{-- <option {{ $student->mother_tongue == $student->mother_tongue ? 'selected' : '' }} value="">Select Mother Tongue</option> --}}
                                                @if(isset($grades) && $grades->count() > 0)
                                                    @foreach($grades as $grade)
                                                        @if ($student->previous_level == '' || $student->previous_level == null)
                                                            <option value="" hidden selected>N/A</option>
                                                        @endif
                                                        <option value="{{ $grade->name }}" {{ $grade->name == $student->previous_level ? 'selected' : '' }}>{{ $grade->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="schoolyear" :value="__('Last School Year')" />
                                        <x-text-input id="schoolyear" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="schoolyear" :value="$student->previous_sy_attended ?? 'N/A' " required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="section" :value="__('Last Section')" />
                                        <x-text-input id="section" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="section" :value="$student->previous_section ?? 'N/A' " required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="gwa" :value="__('General Weighted Average')" />
                                        <x-text-input x-model="formData.gwa" id="gwa" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="gwa" required autofocus />
                                    </div>
                                </div>
                                {{-- Sixth Row --}}
                                <div class="sm:flex gap-2 w-full grid grid-cols-2">
                                    <div class="w-full">
                                        <x-input-label for="houseno" :value="__('House No.')" />
                                        <x-text-input x-model="formData.house_no" id="houseno" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="houseno" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="street" :value="__('Street')" />
                                        <x-text-input x-model="formData.street" id="street" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="street" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="barangay" :value="__('Barangay')" />
                                        <x-text-input x-model="formData.barangay" id="barangay" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="barangay" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="city" :value="__('City/Municipality')" />
                                        <x-text-input x-model="formData.city_municipality" id="city" class="block mt-1 w-full" type="text" x-bind:disabled="!studentProfileEdit" name="city" required autofocus />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="activeTab === 1" class="flex flex-col gap-2 w-full justify-between">
                            <div class="flex flex-col gap-2">
                                {{-- First Row --}}
                                <div class="flex gap-2 w-full">
                                    <div class="w-full">
                                        <x-input-label for="father_name" :value="__('Father\'s Name')" />
                                        <x-text-input x-model="formData.father_name" id="father_name" class="block mt-1 w-full" type="text" x-bind:disabled="!parentInfoEdit" name="father_name" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="father_contact_number" :value="__('Father\'s Contact No.')" />
                                        <x-text-input x-model="formData.father_contact_number" id="father_contact_number" class="block mt-1 w-full" type="text" x-bind:disabled="!parentInfoEdit" name="father_contact_number" required autofocus />
                                    </div>
                                </div>
                                {{-- Second Row --}}
                                <div class="flex gap-2 w-full">
                                    <div class="w-full">
                                        <x-input-label for="mother_name" :value="__('Mother\'s Name')" />
                                        <x-text-input x-model="formData.mother_name" id="mother_name" class="block mt-1 w-full" type="text" x-bind:disabled="!parentInfoEdit" name="mother_name" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="mother_contact_number" :value="__('Mother\'s Contact No.')" />
                                        <x-text-input x-model="formData.mother_contact_number" id="mother_contact_number" class="block mt-1 w-full" type="text" x-bind:disabled="!parentInfoEdit" name="mother_contact_number" required autofocus />
                                    </div>
                                </div>
                                {{-- Third Row --}}
                                <div class="flex gap-2 w-full">
                                    <div class="w-full">
                                        <x-input-label for="guardian_name" :value="__('Guardian\'s Name')" />
                                        <x-text-input x-model="formData.guardian_name" id="guardian_name" class="block mt-1 w-full" type="text" x-bind:disabled="!parentInfoEdit" ame="guardian_name" required autofocus />
                                    </div>
                                    <div class="w-full">
                                        <x-input-label for="guardian_contact_number" :value="__('Guardian\'s Contact No.')" />
                                        <x-text-input x-model="formData.guardian_contact_number" id="guardian_contact_number" class="block mt-1 w-full" type="text" x-bind:disabled="!parentInfoEdit" name="guardian_contact_number" required autofocus />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="activeTab === 2" class="flex flex-col w-full gap-2">
                            <div class="flex gap-1 w-full items-center justify-center">
                                <p>Preferred Distance Learning Modules to Distance Learning</p>
                            </div>
                            <div class="flex gap-1 items-center justify-center">
                                <div class="grid grid-cols-2 gap-2 my-4">
                                    @if(isset($modules) && $modules->count() > 0)
                                        @foreach($modules as $module)
                                        <div class="flex gap-2 items-center">
                                            <input x-model="formData.modules"
                                                x-bind:disabled="!preferredModulesEdit"
                                                type="checkbox"
                                                value="{{ $module->id }}"
                                                name="modules[]"
                                                id="module_{{ $module->id }}"
                                                class="border-gray-300 rounded-md"
                                                {{ $student->modules->contains($module->id) ? 'checked' : '' }}   
                                            >
                                            <x-input-label :for="'module_' . $module->id" :value="$module->name" />
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex border-t gap-2 w-full pt-1.5 justify-end items-center">
                        <div class="flex gap-2 justify-end items-center" x-show="activeTab === 0">
                            <x-primary-button @click="updateStudent()" x-show="studentProfileEdit" class="text-center">
                                Save
                            </x-primary-button>
                            <x-secondary-button @click="studentProfileEdit = !studentProfileEdit" class="text-center">
                                Edit Student Profile
                            </x-secondary-button>
                        </div>
                        <div class="flex gap-2 justify-end items-center" x-show="activeTab === 1">
                            <x-primary-button @click="updateStudent()" x-show="parentInfoEdit" class="text-center">
                                Save
                            </x-primary-button>
                            <x-secondary-button @click="parentInfoEdit = !parentInfoEdit" class="text-center">
                                Edit Student Profile
                            </x-secondary-button>
                        </div>
                        <div class="flex gap-2 justify-end items-center" x-show="activeTab === 2">
                            <x-primary-button @click="updateStudent()" x-show="preferredModulesEdit" class="text-center">
                                Save
                            </x-primary-button>
                            <x-secondary-button @click="preferredModulesEdit = !preferredModulesEdit" class="text-center">
                                Edit Student Profile
                            </x-secondary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function StudentShow(){
            return{
                activeTab: parseInt(localStorage.getItem('activeTab')) || 0,
                student_id: @js($student->id),
                studentProfileEdit: false,
                parentInfoEdit: false,
                message : '',
                preferredModulesEdit: false,
                tabs: [
                    'Student Profile',
                    'Parent/Guardian Information',
                    'Preferred Learning Modules'
                ],
                formData: {
                    // step 1 fields
                    grade_level: @js($student->grade_level_id),
                    student_type: @js($student->student_type),
                    learner_status: @js($student->learner_status),
                    psa_no: @js($student->psa_no),
                    lrn: @js($student->lrn),
                    first_name: @js($student->first_name), // done
                    middle_name: @js($student->middle_name), // done
                    last_name: @js($student->last_name), // done
                    suffix: @js($student->suffix), // done
                    date_of_birth: @js($student->birthdate),
                    place_of_birth: @js($student->place_of_birth),
                    gender: @js($student->gender),
                    gwa: @js($student->gwa),
                    section: @js($student->section_id),
                    // last grade level
                    previous_level: @js($student->previous_level),
                    // last school year
                    previous_sy_attended: @js($student->previous_sy_attended),
                    // last section
                    previous_section: @js($student->previous_section),
                    mother_tongue: @js($student->mother_tongue),
                    house_no: @js($student->address->house_no),
                    street: @js($student->address->street),
                    barangay: @js($student->address->barangay),
                    city_municipality: @js($student->address->city_municipality),
                    // step 2 fields
                    father_name: @js($student->parent->father_name),
                    father_contact_number: @js($student->parent->father_contact_number),
                    mother_name: @js($student->parent->mother_name),
                    mother_contact_number: @js($student->parent->mother_contact_number),
                    guardian_name: @js($student->parent->guardian_name),
                    guardian_contact_number: @js($student->parent->guardian_contact_number),
                    // step 3 fields
                    // what does pluck do?
                    modules: @js($student->modules->pluck('id')),
                },
                setActiveTab(index){
                    this.activeTab = index
                    localStorage.setItem('activeTab', index)
                },
                updateStudent(){
                    fetch(`/student/${this.student_id}/update`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(this.formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data){
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })
                            this.studentProfileEdit = false
                            this.parentInfoEdit = false
                            this.preferredModulesEdit = false
                            this.message = data.message;   
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: "Error updating profile",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
                },
            }
        }
    </script>
</x-app-layout>