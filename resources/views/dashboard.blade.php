    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12" x-data="dataTable()" x-init="fetchStudents()">
            <div class="max-w-7xl px-2 py-2 mx-auto sm:px-6 lg:px-8">
                <h1 class="text-md font-medium">Dashboard</h1>
                <div class="sm:flex w-full space-y-1 sm:space-y-0 sm:gap-2">
                    <div class="bg-white border shadow-sm rounded px-6 py-5 w-full flex justify-between">
                        <div class="">
                            <p class="text-gray-500 font-semibold">Enrollees Today</p>
                            <p class="text-xl font-bold">
                                {{ isset($enrollees_today) ? $enrollees_today : 0 }}
                            </p>
                        </div>
                        <div class="h-full flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>                          
                        </div>
                    </div>
                    <div class="bg-white border shadow-sm rounded px-6 py-5 w-full flex justify-between">
                        <div class="">
                            <p class="text-gray-500 font-semibold">Enrolled Students</p>
                            <p class="text-xl font-bold">
                                {{ isset($enrolled) ? $enrolled : 0 }}
                            </p>
                        </div>
                        <div class="h-full flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>  
                        </div>
                    </div>
                    <div class="bg-white border shadow-sm rounded px-6 py-5 w-full flex justify-between">
                        <div class="">
                            <p class="text-gray-500 font-semibold">Archived Students</p>
                            <p class="text-xl font-bold">{{ isset($archived) ? $archived : 0 }} </p>
                        </div>
                        <div class="h-full flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>                          
                        </div>
                    </div>
                    <div class="bg-white border shadow-sm rounded px-6 py-5 w-full flex justify-between">
                        <div class="">
                            <p class="text-gray-500 font-semibold">Sections</p>
                            <p class="text-xl font-bold">
                                {{ isset($sections) ? $sections : 0 }}
                            </p>
                        </div>
                        <div class="h-full flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 012.25-2.25h7.5A2.25 2.25 0 0118 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 004.5 9v.878m13.5-3A2.25 2.25 0 0119.5 9v.878m0 0a2.246 2.246 0 00-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0121 12v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6c0-.98.626-1.813 1.5-2.122" />
                            </svg>                                                   
                        </div>
                    </div>
                </div>
                <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                    <div class="border-b px-3 py-2">
                        <p class="text-md font-medium">
                            Enrollees Today
                        </p>
                    </div>
                    <div class="px-5 py-5 overflow-y-auto">
                        <div class="flex gap-2 justify-between">
                            {{-- <p class="text-sm my-auto">Search</p> --}}
                            <x-text-input x-model="search" @input.debounce.500="fetchStudents()" class="py-1 text-sm" type="text" placeholder="Search" name="search" :value="old('search')" autofocus />
                            <div class="flex gap-2">
                                <p class="text-sm my-auto">Show</p>
                                <select x-model="show" @change="fetchStudents()" class="border-gray-300 text-sm py-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                                <p class="text-sm my-auto hidden sm:block">Entries</p>
                            </div>
                        </div>
                        <div class="bg-white mt-2 overflow-hidden shadow-sm border sm:rounded-lg overflow-x-auto">
                            <table class="table-auto w-full shadow-sm overflow-x-auto">
                                <thead class="bg-gray-50 text-sm uppercase">
                                    <tr class="border-b">
                                        <th class="px-3 py-2">LRN</th>
                                        <th class="px-3 py-2">Level</th>
                                        <th class="px-3 py-2">Name</th>
                                        <th class="px-3 py-2">Gender</th>
                                        <th class="px-3 py-2">Type</th>
                                        <th class="px-3 py-2">Date Enrolled</th>
                                        <th class="px-3 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="student in students" :key="student.id">
                                        <tr class="text-center border-b hover:bg-gray-50 text-sm">
                                            <td class="px-3 py-2" x-text="student.lrn"></td>
                                            <td class="px-3 py-2" x-text="student.grade.name">Grade 7</td>
                                            <td x-text="`${student.last_name}, ${student.first_name}`" class="px-3 py-2"></td>
                                            <td x-text="student.gender" class="px-3 py-2 capitalize"></td>
                                            <td x-text="student.student_type" class="px-3 py-2 capitalize"></td>
                                            <td x-text="new Date(student.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })" class="px-3 py-2"></td>
                                            <td class="px-3 py-2 flex mx-auto whitespace-nowrap items-center justify-center gap-1">
                                                <div @click="viewStudent(student.id)" class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <p>Profile</p>
                                                </div>
                                                <div class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                    </svg>                                              
                                                    <p>Archive</p>
                                                </div>
                                            </td>
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
                id: @json(""),
    
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
                    window.location.href = '/sections/edit/' + id;
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