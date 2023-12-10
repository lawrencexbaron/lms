<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="dataTable()" x-init="fetchAdvisers()">
        <div class="max-w-7xl flex flex-col mx-auto sm:px-6 lg:px-8">
            @if(session()->has('status'))
                <div x-cloak class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ session()->get('status') }}</strong>
                </div>
            @endif
            <div x-cloak x-show="message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold" x-text="message"></strong>
            </div>
            <div class="my-1 justify-end flex">
                <x-primary-link class="" href="{{
                    route('advisers.add')
                }}">
                    {{ __('Create') }}
                </x-primary-link>
            </div>
            <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        Advisers
                    </p>
                </div>
                <div class="px-5 py-5 overflow-y-auto">
                    <div class="flex gap-2 justify-between">
                        {{-- <p class="text-sm my-auto">Search</p> --}}
                        <x-text-input x-model="search" @input.debounce.500="fetchAdvisers()" class="py-1 text-sm" type="text" placeholder="Search" name="search" :value="old('search')" />
                        <div class="flex gap-2">
                            <p class="text-sm my-auto">Show</p>
                            <select x-model="show" @change="fetchAdvisers()" class="border-gray-300 text-sm py-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                {{-- <option value="0" selected disabled>Show</option> --}}
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                            <p class="text-sm my-auto hidden sm:block">Entries</p>
                        </div>
                    </div>
                    <div class="bg-white mt-2 overflow-hidden shadow-sm border sm:rounded-lg overflow-x-auto">
                        <table class="table-auto w-full shadow-sm">
                            <thead class="bg-gray-50">
                                <tr class="border-b">
                                    <th class="px-3 py-2 uppercase text-sm">Adviser Name</th>
                                    <th class="px-3 py-2 uppercase text-sm">Email</th>
                                    <th class="px-3 py-2 uppercase text-sm">Phone</th>
                                    <th class="px-3 py-2 uppercase text-sm">Advisees</th>
                                    <th class="px-3 py-2 uppercase text-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="adviser in advisers" :key="adviser.id">
                                    <tr class="text-center border-b hover:bg-gray-50 text-sm">
                                        <td x-text="`${adviser.last_name}, ${adviser.first_name} ${adviser.middle_name}`" class="px-3 py-2"></td>
                                        <td x-text="adviser.email" class="px-3 py-2"></td>
                                        <td x-text="adviser.phone" class="px-3 py-2"></td>
                                        <td class="px-3 py-2">0</td>
                                        <td class="px-3 py-2 flex mx-auto whitespace-nowrap items-center justify-center gap-1">
                                            <div @click="editAdviser(adviser.id)" class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                <a class="flex my-auto items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>                                              
                                                    <p>Edit</p>
                                                </a>
                                            </div>
                                            <div @click="deleteAdviser(adviser.id)" class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                <a class="flex my-auto items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                    </svg>                                              
                                                    <p>Delete</p>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="advisers.length === 0" class="text-center border-b hover:bg-gray-50 text-sm">
                                    <td colspan="7" class="px-3 py-2">
                                        <p class="text-sm text-gray-500">No data found.</p>
                                    </td>
                                </tr>
                        </table>
                    </div>
                    <div class="flex justify-between w-full mt-2">
                        <div class="text-sm my-auto">
                            <p>
                                Show <span x-text="advisers.length"></span> of <span x-text="total"></span> entries
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
            advisers: [],
            message: null,
            total : 0,
            total_pages : 0,
            curent_page : 0,

            nextPage(){
                if(this.page < this.total_pages){
                    this.page++
                }else{
                    this.page = this.total_pages
                }
                this.fetchAdvisers()
            },

            doubleNextPage(){
                if(this.page < this.total_pages){
                    this.page += 2
                    this.fetchAdvisers()
                }else{
                    this.page = this.total_pages
                }
            },

            doublePreviousPage(){
                if(this.page > 2){
                    this.page -= 2
                    this.fetchAdvisers()
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
                this.fetchAdvisers()
            },

            editAdviser(id){
                // redirect to edit page
                window.location.href = '/advisers/edit/' + id;
            },
        
            deleteAdviser(id){
                // confirm before deletion
                if(confirm('Are you sure you want to delete this adviser?')){
                    fetch(`/advisers/delete/${id}`,{
                        method: 'DELETE',
                        headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => response.json())
                    .then(data => {
                        if(data.status == 'success'){
                            this.fetchAdvisers()
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
            viewSection(id){
                // redirect to view page
                window.location.href = '/sections/view/' + id;
            },

            fetchAdvisers(){
                fetch('/advisers/getadvisers?search=' + this.search + '&show=' + this.show + '&page=' + this.page)
                .then(response => response.json())
                .then(data => {
                    this.advisers = data.advisers
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