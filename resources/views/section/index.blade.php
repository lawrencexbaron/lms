<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl flex flex-col mx-auto sm:px-6 lg:px-8">
            @if(session()->has('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ session()->get('status') }}</strong>
                </div>
            @endif
            <div class="my-1 justify-end flex">
                <x-primary-link class="" href="{{
                    route('section.create')
                }}">
                    {{ __('Create') }}
                </x-primary-link>
            </div>
            <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        Sections
                    </p>
                </div>
                <div class="px-5 py-5 overflow-y-auto">
                    <div class="flex gap-2 justify-between">
                        {{-- <p class="text-sm my-auto">Search</p> --}}
                        <x-text-input class="py-1 text-sm" type="text" placeholder="Search" name="search" :value="old('search')" autofocus />
                        <div class="flex gap-2">
                            <p class="text-sm my-auto">Show</p>
                            <select class="border-gray-300 text-sm py-1 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                                    <th class="px-3 py-2 uppercase text-sm">#</th>
                                    <th class="px-3 py-2 uppercase text-sm">Section Name</th>
                                    <th class="px-3 py-2 uppercase text-sm">Code</th>
                                    <th class="px-3 py-2 uppercase text-sm">Adviser</th>
                                    <th class="px-3 py-2 uppercase text-sm">Capacity</th>
                                    <th class="px-3 py-2 uppercase text-sm">Status</th>
                                    <th class="px-3 py-2 uppercase text-sm">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($sections) && count($sections) > 0)
                                    @foreach($sections as $section)
                                        <tr class="text-center border-b hover:bg-gray-50 text-sm">
                                            <td class="px-3 py-2">{{ $section->id }}</td>
                                            <td class="px-3 py-2">{{ $section->name }}</td>
                                            <td class="px-3 py-2">{{ $section->section_code }}</td>
                                            <td class="px-3 py-2">{{
                                                $section->adviser->last_name . ', ' . $section->adviser->first_name }}</td>
                                            <td class="px-3 py-2">{{ $section->capacity }}</td>
                                            <td class="px-3 py-2">
                                                @if($section->status == 'active')
                                                    <p class="px-2 text-sm py-1 rounded bg-green-600 w-20 mx-auto text-white">
                                                        Active
                                                    </p>
                                                @else
                                                    <p class="px-2 text-sm py-1 rounded bg-red-600 w-20 mx-auto text-white">
                                                        Inactive
                                                    </p>
                                                @endif
                                            </td>
                                            <td class="px-3 py-2 flex mx-auto whitespace-nowrap items-center justify-center gap-1">
                                                <div class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                    <a class="flex my-auto items-center gap-1" href="{{route('section.show', $section->id)}}"> 
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        <p>View</p>
                                                    </a>
                                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    <p>View</p> --}}
                                                </div>
                                                <div class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                    <a class="flex my-auto items-center gap-1" href="{{route('section.edit', $section->id)}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>                                              
                                                        <p>Edit</p>
                                                    </a>
                                                </div>
                                                <div class="px-2 py-1 bg-white border text-sm flex my-auto items-center gap-1 cursor-pointer hover:border-gray-400 transition">
                                                    <form onsubmit="return confirm('Are you sure you want to delete this section?')" action="{{ route('section.delete', $section->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="flex my-auto items-center gap-1" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                                            </svg>                                              
                                                            <p>Delete</p>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr class="text-center border-b hover:bg-gray-50 text-sm">
                                    <td colspan="7" class="px-3 py-2">
                                        <p class="text-sm text-gray-500">
                                            No data found.
                                        </p>
                                    </td>
                                </tr>
                                @endif
                        </table>
                    </div>
                    <div class="flex justify-between w-full mt-2">
                        <div class="text-sm my-auto">
                            <p>
                                Showing 1 to 1 of 1 entries
                            </p>
                        </div>
                        <div class="flex rounded border my-auto">
                            <p class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5" />
                                </svg>
                            </p>
                            <p class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                </svg>
                            </p>
                            <p class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </p>
                            <p class="px-1 py-1 border-l hover:cursor-pointer hover:bg-gray-50 text-gray-500">
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
