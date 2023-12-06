<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sections') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="dataTable()" x-init="fetchStudents()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ session()->get('status') }}</strong>
                </div>
            @endif
            <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        All {{ $section->name }} Students
                    </p>
                </div>
                <div class="my-2 gap-1.5 flex p-5 justify-end">
                    <x-primary-link href="{{ route('section.export-pdf', ['section_id' => $section->id]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                        </svg>                          
                        Print Information
                    </x-primary-link>
                    <x-secondary-link :href="route('section.export-exel', ['section_id' => $section->id])">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>                          
                        Print to Excel
                    </x-secondary-link>
                    
                </div>
                <div class="my-2 p-5 flex-col gap-1.5 flex items-center text-center justify-center">
                    <p class="text-2xl font-bold">
                        {{ $section->adviser->first_name }} {{ $section->adviser->last_name }}
                    </p>
                    <p class="text-lg font-medium">
                        {{ $section->grade->name }} - {{ $section->name }}
                    </p>
                    <p class="text-md">
                        {{ $section->room->code}}
                    </p>
                </div>
                <div class="px-5 py-5 overflow-y-auto">
                    <div class="flex gap-2 justify-between">
                        {{-- <p class="text-sm my-auto">Search</p> --}}
                        <x-text-input x-model="search" @input.debounce.500="fetchStudents()" class="py-1 text-sm" type="text" placeholder="Search" name="search" :value="old('search')" />
                        <div class="flex gap-2">
                            <p class="text-sm my-auto">Show</p>
                            <select x-model="show" @change="fetchStudents()" class="border-gray-300 text-sm py-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                {{-- <option value="0" selected disabled>Show</option> --}}
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                            <p class="text-sm my-auto hidden sm:block">Entries</p>
                        </div>
                    </div>
                    <div class="bg-white mt-2 overflow-hidden shadow-sm border sm:rounded-lg overflow-y-auto">
                        <table class="table-auto w-full shadow-sm overflow-y-auto">
                            <thead class="bg-gray-50">
                                <tr class="border-b">
                                    <th class="px-3 py-2 uppercase text-sm">Action</th>
                                    <th class="px-3 py-2 uppercase text-sm">LRN</th>
                                    <th class="px-3 py-2 uppercase text-sm">Name</th>
                                    <th class="px-3 py-2 uppercase text-sm">Gender</th>
                                    <th class="px-3 py-2 uppercase text-sm">Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="student in students" :key="student.id">
                                    <tr class="text-center border-b hover:bg-gray-50 text-sm">
                                        <td class="px-3 py-2 flex mx-auto whitespace-nowrap items-center justify-center gap-1">
                                            <div @click="viewStudent(student.id)" class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                <a class="flex my-auto items-center gap-1"> 
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <p>Profile</p>
                                                </a>
                                            </div>
                                        </td>
                                        <td x-text="student.lrn" class="px-3 py-2"></td>
                                        <td x-text="`${student.last_name}, ${student.first_name}`" class="px-3 py-2"></td>
                                        <td x-text="student.gender" class="px-3 py-2 capitalize"></td>
                                        <td x-text="student.student_type" class="px-3 py-2 capitalize"></td>
                                    </tr>
                                </template>
                                <tr x-show="students.length === 0" class="text-center border-b hover:bg-gray-50 text-sm">
                                    <td colspan="7" class="px-3 py-2">
                                        <p class="text-sm text-gray-500">No data found.</p>
                                    </td>
                                </tr>
                        </table>
                    </div>
                    <div class="flex justify-between w-full mt-2">
                        <div class="text-sm my-auto">
                            <p>
                                Show <span x-text="students.length"></span> of <span x-text="total"></span> entries
                            </p>
                        </div>
                        <div class="flex rounded border my-auto">
                            <p @click="doublePreviousPage()" class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                                </svg>
                            </p>
                            <p @click="previousPage()" class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </p>
                            <p class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <span x-text="page" class="p-3 font-medium text-sm"></span>
                            </p>
                            <p @click="nextPage()" class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </p>
                            <p @click="doubleNextPage()" class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                                </svg>
                            </p>                                                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    // alpinejs
    function dataTable(){
        return {
            search: '',
            show: 5,
            page: 1,
            students: [],
            message: null,
            total : 0,
            total_pages : 0,
            curent_page : 0,
            id: @json($section->id),

            nextPage(){
                if(this.page < this.total_pages){
                    this.page++
                }else{
                    this.page = this.total_pages
                }
                this.fetchStudents()
            },

            doubleNextPage(){
                if(this.page < this.total_pages){
                    this.page += 2
                    this.fetchStudents()
                }else{
                    this.page = this.total_pages
                }
            },

            doublePreviousPage(){
                if(this.page > 2){
                    this.page -= 2
                    this.fetchStudents()
                }else{
                    this.page = 1
                }
            },

            previousPage(){
                if(this.page > 1){
                    this.page--
                }else{
                    this.page = 1
                }
                this.fetchStudents()
            },

            editStudent(id){
                // redirect to edit page
                window.location.href = '/student/' + id;
            },
        
            deleteStudent(id){
                // confirm before deletion
                if(confirm('Are you sure you want to delete this section?')){
                    fetch(`/sections/delete/${id}`,{
                        method: 'DELETE',
                        headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => response.json())
                    .then(data => {
                        if(data.status == 'success'){
                            this.fetchStudents()
                            this.message = data.message
                            console.log(this.message)
                        }else{
                            console.log(data.message)
                        }
                    }).catch(error => {
                        console.log(error)
                    });
                }
            },
            viewStudent(id){
                // redirect to view page
                window.location.href = '/student/' + id;
            },

            fetchStudents(){
                fetch('/enrolled/students?search=' + this.search + '&show=' + this.show + '&page=' + this.page + '&id=' + this.id)
                .then(response => response.json())
                .then(data => {
                    this.students = data.students
                    this.total = data.total
                    this.total_pages = data.total_pages
                    this.current_page = data.current_page
                }).catch(error => {
                    console.log(error)
                });
            },
        }
    }


</script>