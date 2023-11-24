<x-header-layout>
    <div class="py-12 w-full">
        <div x-data="EnrollmentApplication()" class="mx-auto sm:max-w-6xl">
            <div class="bg-white w-full overflow-hidden shadow-lg">
                <div class="bg-blue-600 flex-col px-3 py-6 text-white items-center flex justify-center w-full">
                    <p class="font-semibold text-2xl">Enhanced Basic Education Enrollment System</p>
                    <p>Schools Division of Navotas City</p>
                    <p>S.Y. 2022-2023</p>
                </div>
                <div class="px-5 flex flex-col py-4 w-full" x-show="step == 1">
                    <div class="flex flex-col w-full space-y-3">
                        <div class="w-full">
                            <p class="text-2xl font-medium">
                                Learner Information
                            </p>
                        </div>
                        <div class="w-full flex gap-4 items-center my-auto">
                            <div class="flex flex-col">
                                <x-input-label for="lrn" :value="__('School Year')" />
                                <p>2022-2023</p>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Grade Level')" />
                                <select @focus="clearError('grade_level')" x-model="formData.grade_level" name="grade_level" id="grade_level" class="border px-2 py-1 border-gray-300 rounded-md">
                                    <option value="">Select Grade Level</option>
                                    @if(isset($grades))
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span x-show="hasError('grade_level')" x-text="getError('grade_level')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex-col flex">
                                <x-input-label for="type" :value="__('Student Type')" />
                                <div class="flex gap-2">
                                    <div class="flex gap-2 items-center">
                                        <input @focus="clearError('student_type')" x-model="formData.student_type" value="old" type="radio" name="student_type" id="student_type" class="border-gray-300 rounded-md" />
                                        <x-input-label for="student_type" :value="__('Old Student')" />
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <input @focus="clearError('student_type')" x-model="formData.student_type" value="new" type="radio" name="student_type" id="student_type" class="border-gray-300 rounded-md" />
                                        <x-input-label for="student_type" :value="__('New Student')" />
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <input @focus="clearError('student_type')" x-model="formData.student_type" value="balik_aral" type="radio" name="student_type" id="student_type" class="border-gray-300 rounded-md" />
                                        <x-input-label for="student_type" :value="__('Balik Aral')" />
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <input @focus="clearError('student_type')" x-model="formData.student_type" value="transferee" type="radio" name="student_type" id="student_type" class="border-gray-300 rounded-md" />
                                        <x-input-label for="student_type" :value="__('Transferee')" />
                                    </div>
                                </div>
                                <span x-show="hasError('student_type')" x-text="getError('student_type')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Learner Status')" />
                                <select @focus="clearError('learner_status')" x-model="formData.learner_status" name="learner_status" id="learner_status" class="border px-2 py-1 border-gray-300 rounded-md">
                                    <option value="">Select Learner Status</option>
                                    <option value="1">No LRN</option>
                                    <option value="2">With LRN</option>
                                </select>
                                <span x-show="hasError('learner_status')" x-text="getError('learner_status')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full flex gap-2 items-center my-auto">
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('PSA Birth Cert. No (If available upon enrollment)')" />
                                <x-text-input @focus="clearError('psa_no')" x-model="formData.psa_no" id="psa_no" class="block mt-1 w-full" type="text" name="psa_no" :value="old('psa_no')" required autofocus />
                                <span x-show="hasError('psa_no')" x-text="getError('psa_no')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('LRN')" />
                                <x-text-input @focus="clearError('lrn')" x-model="formData.lrn" id="lrn" class="block mt-1 w-full" type="text" name="lrn" :value="old('lrn')" required autofocus />
                                <span x-show="hasError('lrn')" x-text="getError('lrn')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full flex gap-2 items-center my-auto">
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('First Name')" />
                                <x-text-input @focus="clearError('first_name')" x-model="formData.first_name" id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                                <span x-show="hasError('first_name')" x-text="getError('first_name')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Middle Name')" />
                                <x-text-input @focus="clearError('middle_name')" x-model="formData.middle_name" id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" :value="old('middle_name')" required autofocus />
                                <span x-show="hasError('middle_name')" x-text="getError('middle_name')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Last Name')" />
                                <x-text-input @focus="clearError('last_name')" x-model="formData.last_name" id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                                <span x-show="hasError('last_name')" x-text="getError('last_name')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Extension Name')" />
                                <x-text-input @focus="clearError('extension_name')" x-model="formData.extension_name" id="extension_name" class="block mt-1 w-full" type="text" name="extension_name" :value="old('extension_name')" required autofocus />
                                <span x-show="hasError('extension_name')" x-text="getError('extension_name')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full flex gap-2 items-center my-auto">
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Date of Birth')" />
                                <x-text-input max="{{ date('Y-m-d')}}" @focus="clearError('date_of_birth')" x-model="formData.date_of_birth" id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autofocus />
                                <span x-show="hasError('date_of_birth')" x-text="getError('date_of_birth')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Place of Birth')" />
                                <x-text-input @focus="clearError('place_of_birth')" x-model="formData.place_of_birth" id="place_of_birth" class="block mt-1 w-full" type="text" name="place_of_birth" :value="old('place_of_birth')" required autofocus />
                                <span x-show="hasError('place_of_birth')" x-text="getError('place_of_birth')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Gender')" />
                                <div class="flex gap-4">
                                    <div class="flex gap-2 items-center">
                                        <input x-model="formData.gender" @focus="clearError('gender')" type="radio" name="gender" value="male" id="gender" class="border-gray-300 rounded-md" />
                                        <x-input-label for="male" :value="__('Male')" />
                                    </div>
                                    <div class="flex gap-2 items-center">
                                        <input x-model="formData.gender" @focus="clearError('gender')" type="radio" name="gender" value="female" id="gender" class="border-gray-300 rounded-md" />
                                        <x-input-label for="female" :value="__('Female')" />
                                    </div>
                                </div>
                                <span x-show="hasError('gender')" x-text="getError('gender')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Mother Tongue')" />
                                <select @focus="clearError('mother_tongue')" x-model="formData.mother_tongue" name="mother_tongue" id="mother_tongue" class="border px-2 py-1 border-gray-300 rounded-md">
                                    <option value="">Select Mother Tongue</option>
                                    <option value="Tagalog">Tagalog</option>
                                    <option value="Cebuano">Cebuano</option>
                                    <option value="Ilocano">Ilocano</option>
                                    <option value="Hiligaynon">Hiligaynon</option>
                                    <option value="Waray">Waray</option>
                                    <option value="Kapampangan">Kapampangan</option>
                                    <option value="Bicolano">Bicolano</option>
                                    <option value="Pangasinense">Pangasinense</option>
                                    <option value="Maranao">Maranao</option>
                                    <option value="Maguindanaoan">Maguindanaoan</option>
                                    <option value="Tausug">Tausug</option>
                                    <option value="Others">Others</option>
                                </select>
                                <span x-show="hasError('mother_tongue')" x-text="getError('mother_tongue')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full flex items-center gap-2 my-auto">
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('House No.')" />
                                <x-text-input @focus="clearError('house_no')" x-model="formData.house_no" id="house_no" class="block mt-1 w-full" type="text" name="house_no" :value="old('house_no')" required autofocus />
                                <span x-show="hasError('house_no')" x-text="getError('house_no')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Street')" />
                                <x-text-input @focus="clearError('street')" x-model="formData.street" id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" required autofocus />
                                <span x-show="hasError('street')" x-text="getError('street')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('Barangay')" />
                                <x-text-input @focus="clearError('barangay')" x-model="formData.barangay" id="barangay" class="block mt-1 w-full" type="text" name="barangay" :value="old('barangay')" required autofocus />
                                <span x-show="hasError('barangay')" x-text="getError('barangay')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/4">
                                <x-input-label for="lrn" :value="__('City/Municipality')" />
                                <x-text-input @focus="clearError('city_municipality')" x-model="formData.city_municipality" id="city_municipality" class="block mt-1 w-full" type="text" name="city_municipality" :value="old('city_municipality')" required autofocus />
                                <span x-show="hasError('city_municipality')" x-text="getError('city_municipality')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full my-auto flex items-center">
                            <x-primary-button @click="nextStep()" class="ml-auto w-full py-3 justify-center">
                                {{ __('Next') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
                <div class="px-5 flex flex-col py-4 w-full" x-show="step == 2">
                    <div class="flex flex-col w-full space-y-3">
                        <div class="w-full">
                            <p class="text-2xl font-medium">
                                Parent's Information
                            </p>
                        </div>
                        <div class="w-full flex gap-2 items-center my-auto">
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Father Name')" />
                                <x-text-input x-model="formData.father_name" @focus="clearError('father_name')" id="father_name" class="block mt-1 w-full" type="text" name="father_name" :value="old('father_name')" required autofocus />
                                <span x-show="hasError('father_name')" x-text="getError('father_name')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Contact Number')" />
                                <x-text-input x-model="formData.father_contact_number" @focus="clearError('father_contact_number')" id="father_contact_number" class="block mt-1 w-full" type="text" name="father_contact_number" :value="old('father_contact_number')" required autofocus />
                                <span x-show="hasError('father_contact_number')" x-text="getError('father_contact_number')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full flex gap-2 items-center my-auto">
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Mother Name')" />
                                <x-text-input x-model="formData.mother_name" @focus="clearError('mother_name')" id="mother_name" class="block mt-1 w-full" type="text" name="mother_name" :value="old('father_name')" required autofocus />
                                <span x-show="hasError('mother_name')" x-text="getError('mother_name')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Contact Number')" />
                                <x-text-input x-model="formData.mother_contact_number" @focus="clearError('mother_contact_number')" id="mother_contact_number" class="block mt-1 w-full" type="text" name="mother_contact_number" :value="old('mother_contact_number')" required autofocus />
                                <span x-show="hasError('mother_contact_number')" x-text="getError('mother_contact_number')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full flex gap-2 items-center my-auto">
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Guardian Name')" />
                                <x-text-input x-model="formData.guardian_name" @focus="clearError('guardian_name')" id="guardian_name" class="block mt-1 w-full" type="text" name="guardian_name" :value="old('father_name')" required autofocus />
                                <span x-show="hasError('guardian_name')" x-text="getError('guardian_name')" class="text-red-500 text-xs"></span>
                            </div>
                            <div class="flex flex-col w-1/2">
                                <x-input-label for="lrn" :value="__('Contact Number')" />
                                <x-text-input x-model="formData.guardian_contact_number" @focus="clearError('guardian_contact_number')" id="guardian_contact_number" class="block mt-1 w-full" type="text" name="guardian_contact_number" :value="old('mother_contact_number')" required autofocus />
                                <span x-show="hasError('guardian_contact_number')" x-text="getError('guardian_contact_number')" class="text-red-500 text-xs"></span>
                            </div>
                        </div>
                        <div class="w-full my-auto flex items-center gap-1">
                            <x-primary-button @click="prevStep()" class="ml-auto w-full py-3 justify-center">
                                {{ __('Back') }}
                            </x-primary-button>
                            <x-primary-button @click="nextStep()" class="ml-auto w-full py-3 justify-center">
                                {{ __('Next') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
                <div class="px-5 flex flex-col py-4 w-full" x-show="step == 3">
                    <div class="flex flex-col w-full space-y-3">
                        <div class="w-full">
                            <p class="text-2xl font-medium">
                                Preferred Learning Modules
                            </p>
                        </div>
                        <div class="flex">
                            <div class="w-1/2 flex gap-2 items-center my-auto">
                                <div class="flex flex-col">
                                    <span x-show="hasError('learning_modules')" x-text="getError('learning_modules')" class="text-red-500 text-xs"></span>
                                    <x-input-label for="lrn" :value="__('Learning Modules')" />
                                    <div class="grid grid-cols-2 gap-2 my-4">
                                        <div class="flex gap-2 items-center">
                                            <input @focus="clearError('learning_modules')" type="checkbox" x-model="formData.learning_modules" value="modular_printed" name="modular" id="modular" class="border-gray-300 rounded-md" />
                                            <x-input-label for="modular" :value="__('Modular (Printed)')" />
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input @focus="clearError('learning_modules')" type="checkbox" x-model="formData.learning_modules" value="modular_digital" name="modular" id="modular" class="border-gray-300 rounded-md" />
                                            <x-input-label for="modular" :value="__('Modular (Digital)')" />
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input @focus="clearError('learning_modules')" type="checkbox" x-model="formData.learning_modules" value="online" name="online" id="online" class="border-gray-300 rounded-md" />
                                            <x-input-label for="online" :value="__('Online')" />
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input @focus="clearError('learning_modules')" type="checkbox" x-model="formData.learning_modules" value="tv" name="tv" id="tv" class="border-gray-300 rounded-md" />
                                            <x-input-label for="tv" :value="__('Educational Television')" />
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input @focus="clearError('learning_modules')" type="checkbox" x-model="formData.learning_modules" value="radio" name="radio" id="radio" class="border-gray-300 rounded-md" />
                                            <x-input-label for="radio" :value="__('Radio-based Instruction')" />
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input @focus="clearError('learning_modules')" type="checkbox" x-model="formData.learning_modules" value="blended" name="blended" id="blended" class="border-gray-300 rounded-md" />
                                            <x-input-label for="blended" :value="__('Blended')" />
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input @focus="clearError('learning_modules')" type="checkbox" x-model="formData.learning_modules" value="facetoface" name="facetoface" id="facetoface" class="border-gray-300 rounded-md" />
                                            <x-input-label for="facetoface" :value="__('Face to face')" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-1/2 flex flex-col gap-2">
                                <div class="flex flex-col">
                                    <span x-show="hasError('gwa')" x-text="getError('gwa')" class="text-red-500 text-xs"></span>
                                    <x-input-label for="lrn" :value="__('General Weighted Average')" />
                                    <x-text-input @focus="clearError('gwa')" x-model="formData.gwa" id="gwa" class="block mt-1 w-full" type="text" name="gwa" :value="old('gwa')" required autofocus />
                                </div>
                                <div class="flex flex-col">
                                    <span x-show="hasError('previous_section')" x-text="getError('previous_section')" class="text-red-500 text-xs"></span>
                                    <x-input-label for="lrn" :value="__('Previous Section')" />
                                    <x-text-input @focus="clearError('previous_section')" x-model="formData.previous_section" id="previous_section" class="block mt-1 w-full" type="text" name="previous_section" :value="old('previous_section')" required autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="w-full my-auto flex items-center gap-1">
                            <x-primary-button @click="prevStep()" class="ml-auto w-full py-3 justify-center">
                                {{ __('Back') }}
                            </x-primary-button>
                            <x-primary-button @click="submit()" class="ml-auto w-full py-3 justify-center">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-header-layout>
<script>
function EnrollmentApplication(){
    return {
        step: 1,
        formData: {
            // step 1 fields
            grade_level: null,
            student_type: null,
            learner_status: null,
            psa_no: null,
            lrn: null,
            first_name: null,
            middle_name: null,
            last_name: null,
            extension_name: null,
            date_of_birth: null,
            place_of_birth: null,
            gender: null,
            mother_tongue: null,
            house_no: null,
            street: null,
            barangay: null,
            city_municipality: null,

            // step 2 fields
            father_name: null,
            father_contact_number: null,
            mother_name: null,
            mother_contact_number: null,
            guardian_name: null,
            guardian_contact_number: null,

            // step 3 fields
            learning_modules: [],
            gwa: null,
            previous_section: null,

        },

        errors: {},

        clearErrors(){
            this.errors = {};
        },
        clearError(field){
            this.errors[field] = null;
        },
        hasError(field){
            return this.errors.hasOwnProperty(field);
        },
        getError(field){
            if(this.errors[field]){
                return this.errors[field];
            }
        },
        validateStep3(){
            this.clearErrors();
            if(this.formData.learning_modules.length == 0){
                this.errors.learning_modules = "At least one learning module is required";
            }
            if(!this.formData.gwa || this.formData.gwa.trim() === ''){
                this.errors.gwa = "GWA is required";
            }
            if(!this.formData.previous_section || this.formData.previous_section.trim() === ''){
                this.errors.previous_section = "Previous section is required";
            }
        },

        validateStep2(){
            this.clearErrors();
            if((!this.formData.father_name || this.formData.father_name.trim() === '') &&
            (!this.formData.mother_name || this.formData.mother_name.trim() === '') &&
            (!this.formData.guardian_name || this.formData.guardian_name.trim() === '')){
                this.errors.father_name = "At least one parent or guardian is required";
                this.errors.mother_name = "At least one parent or guardian is required";
                this.errors.guardian_name = "At least one parent or guardian is required";
            }

            if(this.formData.father_name && (!this.formData.father_contact_number || this.formData.father_contact_number.trim() === '')){
                this.errors.father_contact_number = "Father's contact number is required";
            }
            if(this.formData.mother_name && (!this.formData.mother_contact_number || this.formData.mother_contact_number.trim() === '')){
                this.errors.mother_contact_number = "Mother's contact number is required";
            }
            if(this.formData.guardian_name && (!this.formData.guardian_contact_number || this.formData.guardian_contact_number.trim() === '')){
                this.errors.guardian_contact_number = "Guardian's contact number is required";
            }
             // add validation for contact number for only 11 digits starting with 09
            if(this.formData.father_contact_number && !this.formData.father_contact_number.match(/^(09|\+639)\d{9}$/)){
                this.errors.father_contact_number = "Contact number must be 11 digits starting with 09"
            }

            if(this.formData.mother_contact_number && !this.formData.mother_contact_number.match(/^(09|\+639)\d{9}$/)){
                this.errors.mother_contact_number = "Contact number must be 11 digits starting with 09"
            }

            if(this.formData.guardian_contact_number && !this.formData.guardian_contact_number.match(/^(09|\+639)\d{9}$/)){
                this.errors.guardian_contact_number = "Contact number must be 11 digits starting with 09";
            }

        },

        validateStep1(){
            this.clearErrors();
            if(!this.formData.grade_level || this.formData.grade_level.trim() === ''){
                this.errors.grade_level = "Grade level is required";
            }
            if(!this.formData.student_type || this.formData.student_type.trim() === ''){
                this.errors.student_type = "Student type is required";
            }
            if(!this.formData.learner_status || this.formData.learner_status.trim() === ''){
                this.errors.learner_status = "Learner status is required";
            }
            if(!this.formData.gender || this.formData.gender.trim() === ''){
                this.errors.gender = "Gender is required";
            }
            if(!this.formData.psa_no || this.formData.psa_no.trim() === ''){
                this.errors.psa_no = "PSA Birth Cert. No is required";
            }
            if(!this.formData.lrn || this.formData.lrn.trim() === ''){
                this.errors.lrn = "LRN is required";
            }
            if(!this.formData.first_name || this.formData.first_name.trim() === ''){
                this.errors.first_name = "First name is required";
            }
            if(!this.formData.middle_name || this.formData.middle_name.trim() === ''){
                this.errors.middle_name = "Middle name is required";
            }
            if(!this.formData.last_name || this.formData.last_name.trim() === ''){
                this.errors.last_name = "Last name is required";
            }
            if(!this.formData.extension_name || this.formData.extension_name.trim() === ''){
                this.errors.extension_name = "Extension name is required";
            }
            if(!this.formData.date_of_birth || this.formData.date_of_birth.trim() === ''){
                this.errors.date_of_birth = "Date of birth is required";
            }
            if(!this.formData.place_of_birth || this.formData.place_of_birth.trim() === ''){
                this.errors.place_of_birth = "Place of birth is required";
            }
            if(!this.formData.house_no || this.formData.house_no.trim() === ''){
                this.errors.house_no = "House no is required";
            }
            if(!this.formData.street || this.formData.street.trim() === ''){
                this.errors.street = "Street is required";
            }
            if(!this.formData.barangay || this.formData.barangay.trim() === ''){
                this.errors.barangay = "Barangay is required";
            }
            if(!this.formData.city_municipality || this.formData.city_municipality.trim() === ''){
                this.errors.city_municipality = "City/Municipality is required";
            }
        },
        nextStep(){
            if(this.step >= 3){
                return;
            }
            if(this.step == 1){
                this.validateStep1();
                if(Object.keys(this.errors).length > 0){
                    return;
                }
            }
            if(this.step == 2){
                this.validateStep2();
                if(Object.keys(this.errors).length > 0){
                    return;
                }
            }
            if(this.step == 3){
                this.validateStep3();
                if(Object.keys(this.errors).length > 0){
                    return;
                }
            }
            
            this.step++;
        },
        prevStep(){
            if(this.step <= 1){
                return;
            }
            this.step--;
        },
        submit(){
            this.validateStep1();
            this.validateStep2();
            this.validateStep3();
            if(Object.keys(this.errors).length > 0){
                return;
            }
            alert('submit');
            console.log(this.formData);

            const fdata = JSON.stringify(this.formData);

            fetch('/enroll', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: fdata
            }).then(response => response.json())
            .then(data => {
                console.log(data.data);
                // redirect to enrollment success page with the data
                window.location.href = '/enroll/success/' + data.data.student_number;

            })
            .catch((error) => {
                console.error('Error:', error);
            }); 

        }

    }
}
</script>