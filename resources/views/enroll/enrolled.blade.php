<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Enrolled') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="dataTable()" x-init="fetchStudents()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        All {{ $grade->name }} Students
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
                                    <th class="px-3 py-2 uppercase text-sm">Section</th>
                                    <th class="px-3 py-2 uppercase text-sm">Date Enrolled</th>
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
                                                    <p>View</p>
                                                </a>
                                            </div>
                                            <div @click="editStudent(student.id)" class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                <a class="flex my-auto items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>                                              
                                                    <p>Edit</p>
                                                </a>
                                            </div>
                                            <div @click="deleteStudent(student.id)" class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                <a class="flex my-auto items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                    </svg>                                              
                                                    <p>Delete</p>
                                                </a>
                                            </div>
                                        </td>
                                        <td x-text="student.lrn" class="px-3 py-2"></td>
                                        <td x-text="`${student.last_name}, ${student.first_name}`" class="px-3 py-2"></td>
                                        <td x-text="student.gender" class="px-3 py-2 capitalize"></td>
                                        <td x-text="student.student_type" class="px-3 py-2 capitalize"></td>
                                        <td x-text="student.section && student.section.name ? student.section.name : 'N/A'" class="px-3 py-2"></td>
                                        <td x-text="new Date(student.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })" class="px-3 py-2"></td>
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
            id: @json($grade->id),

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