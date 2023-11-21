<x-app-layout>

    <div class="py-12">
        <div class="w-1/2 px-2 py-2 mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded border">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        Edit Room
                    </p>
                </div>
                <form action="{{ route('room.update', $room->id) }}" class="px-4 py-5" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <x-input-label for="name" class="font-bold text-gray-800">Name</x-input-label>
                        <x-text-input value="{{ $room->name }}" id="name" class="w-full" name="name" type="text" placeholder="Enter name" />
                        <x-input-error :messages="$errors->get('name')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="code" class="font-bold text-gray-800">Room Code</x-input-label>
                        <x-text-input value="{{ $room->code }}" id="code" class="w-full" name="code" type="text" placeholder="Enter code" />
                        <x-input-error :messages="$errors->get('code')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="grade_level_id" class="font-bold text-gray-800">Grade Level</x-input-label>
                        <select name="grade_level_id" id="grade_level_id" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0" selected disabled>Select Grade Level</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}" {{ $grade->id == $room->grade_level_id ? 'selected' : '' }}>{{ $grade->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('grade_level_id')" class="" />
                    </div>
                    <div class="mb-2">
                        <x-input-label for="status" class="font-bold text-gray-800">Status</x-input-label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded mt-1 focus:border-indigo-600 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="0" selected disabled>Select Status</option>
                            <option value="active" {{ $room->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $room->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="" />
                    </div>
                    <div class=" flex justify-end">
                        <a href="{{ route('graderoom.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-300 mr-2">Back</a>
                        <x-primary-button class="">Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>