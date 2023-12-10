<x-app-layout>
    <div class="py-12" x-data="Statistics()" x-init="getStatistics()">
        <div class="max-w-7xl flex flex-col mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
                <div class="border-b px-3 py-2">
                    <p class="text-md font-medium">
                        Sections
                    </p>
                </div>
                <div class="p-5 items-center justify-center flex flex-col gap-5">
                    <div class="flex gap-1">
                        <x-text-input x-model="from" id="from" class="block mt-1 w-full" type="date" name="from" :value="old('from')" required autofocus />
                        <x-text-input x-model="to" id="to" class="block mt-1 w-full" type="date" name="to" :value="old('to')" required autofocus />
                        <x-primary-button @click="getStatistics()" class="px-2 py-1">
                            {{ __('Show') }}
                        </x-primary-button>
                    </div>
                    <div class="text-center">
                        <p class="text-xl uppercase text-blue-800 font-bold">
                            {{ ucfirst($setting->system_title) . ' ' . $setting->school_year->name }}
                        </p>
                        <p class="text-lg uppercase font-semibold">
                            Enrollment Statistics
                        </p>
                    </div>
                    <div class="sm:max-w-3xl w-full">
                        <table class="table w-full overflow-y-auto text-center table-auto sm:table-fixed">
                            <thead>
                                <tr>
                                    <th class="border px-3 py-2">Level</th>
                                    <th class="border px-3 py-2">Male</th>
                                    <th class="border px-3 py-2">Female</th>
                                    <th class="border px-3 py-2">Transferee</th>
                                    <th class="border px-3 py-2">Old</th>
                                    <th class="border px-3 py-2">Balik-Aral</th>
                                    <th class="border px-3 py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-if="datas.length > 0">
                                    <template x-for="data in datas" :key="data.grade_name">
                                        <tr>
                                            <td class="border px-3 py-2" x-text="data.grade_name"></td>
                                            <td class="border px-3 py-2" x-text="data.grade_students_male_count"></td>
                                            <td class="border px-3 py-2" x-text="data.grade_students_female_count"></td>
                                            <td class="border px-3 py-2" x-text="data.transferred_students_count"></td>
                                            <td class="border px-3 py-2" x-text="data.old_students_count"></td>
                                            <td class="border px-3 py-2" x-text="data.balik_aral_students_count"></td>
                                            <td class="border px-3 py-2" x-text="data.grade_students_count"></td>
                                        </tr>
                                    </template>
                                </template>
                                <template x-if="datas.length === 0">
                                    <tr>
                                        <td colspan="7" class="border px-3 py-2 text-center">No data found.</td>
                                    </tr>
                                </template>
                        </table>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</x-app-layout>


<script>
    function Statistics(){
        return {
            from : '',
            to : '',
            datas : [],
            getStatistics(){
                fetch('/getstatistics?from=' + this.from + '&to=' + this.to)
                .then(response => response.json())
                .then(data => {
                    this.datas = data.datas;
                    console.log(this.datas);
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }
    }
</script>