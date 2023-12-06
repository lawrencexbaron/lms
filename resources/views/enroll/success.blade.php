<x-header-layout>
    <div class="py-12 w-full">
        <div class="mx-auto sm:max-w-5xl">
            <div class="bg-white sm:h-auto px-10 text-center justify-center flex flex-col space-y-2 py-8 w-full overflow-hidden shadow border">
                <p class="text-xl sm:text-3xl font-bold">
                    Your enrollment is being processed.
                </p>
                <p class="text-lg sm:text-xl">
                    Welcome to Navotas National High School!
                </p>
                <div class="w-full">
                    <img src="{{ asset('storage/uploads/logo.png') }}" alt="logo" class="w-28 bg-transparent mx-auto" />
                </div>
                <div>
                    <p class="text-xl sm:text-2xl font-bold">
                        {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                    </p>
                    <p class="text-md sm:text-lg">
                        {{ $student->lrn ?? $student->student_number }}
                    </p>
                    <p class="text-md sm:text-lg border-b pb-6">
                        {{ $student->grade->name }}
                    </p>
                    <p class="text-sm sm:text-md font-semibold">
                        Click here to <a href="{{ route('login') }}" class="text-blue-800 hover:underline">Enrollment Menu</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-header-layout>
