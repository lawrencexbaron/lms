<x-header-layout>
    <div class="py-12 w-full">
        <div class="mx-auto sm:max-w-5xl">
            <div class="bg-white sm:h-96 px-10 text-center justify-center flex flex-col space-y-4 py-8 w-full overflow-hidden shadow border">
                <p class="text-2xl sm:text-4xl font-bold">
                    Your enrollment is being processed.
                </p>
                <p class="text-lg sm:text-xl">
                    Welcome to Navotas National High School!
                </p>
                <p class="text-xl sm:text-2xl font-bold">
                    {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}
                </p>
                <p class="text-md sm:text-lg">
                    {{ $student->lrn ?? $student->student_number }}
                </p>
                <p class="text-md sm:text-lg border-b pb-6">
                    {{-- Grade 7 - STEM --}}
                    {{ $student->grade->name }}
                </p>
                <p class="text-sm sm:text-md font-semibold">
                    Click here to <a href="{{ route('login') }}" class="text-blue-800 hover:underline">Enrollment Menu</a>
                </p>
            </div>
        </div>
    </div>
</x-header-layout>
