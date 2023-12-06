<x-app-layout>

<div class="py-12">
    <div class="max-w-4xl flex flex-col mx-auto sm:px-4 lg:px-8">
        @if(session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ session()->get('success') }}</strong>
            </div>
        @endif
        <div class="bg-white flex flex-col border rounded shadow-sm mt-2 overflow-y-auto">
            <div class="border-b px-3 py-2">
                <p class="text-md font-medium">
                    {{ __('Settings') }}
                </p>
            </div>
            <div class="p-5 overflow-y-auto flex flex-col gap-1" x-data="Setting()">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="system_name" :value="__('System Name')" />
                        <div class="flex flex-col w-full">
                            <x-text-input id="system_name" class="block mt-1 w-full sm:w-3/4" type="text" name="system_name" value="{{ $setting->system_name }}" />
                            <x-input-error :messages="$errors->get('system_name')" class="mt-1" />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="name" :value="__('School Name')" />
                        <div class="flex flex-col w-full">
                            <x-text-input id="name" class="block mt-1 w-full sm:w-3/4" type="text" name="system_title" value="{{ $setting->system_title }}" />
                            <x-input-error :messages="$errors->get('system_title')" class="mt-1" />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="email" :value="__('School Email')" />
                        <div class="flex flex-col w-full">
                            <x-text-input id="email" class="block mt-1 w-full sm:w-3/4" type="text" name="system_email" value="{{ $setting->system_email }}" />
                            <x-input-error :messages="$errors->get('system_email')" class="mt-1" />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="school_year" :value="__('School Year')" />
                        <div class="flex flex-col w-full">
                            @if(!$school_years->isEmpty())
                            <select name="school_year" id="school_year" class="block mt-1 w-full sm:w-3/4 border border-gray-300 rounded-md">
                                @foreach($school_years as $school_year)
                                    <option value="{{ $school_year->id }}" {{ $school_year->id == $setting->school_year_id ? 'selected' : '' }}>{{ $school_year->name }}</option>
                                @endforeach
                            </select>
                            @endif
                            <x-input-error :messages="$errors->get('school_year')" class="mt-1" />
                        </div>
                    </div>
                    <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="logo" :value="__('Logo')" />
                        <x-text-input @change="onLogoChange()" id="logo" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="logo" value="{{ $setting->logo }}" />
                        <div class="flex">
                            <img id="logo_logo" @click="onLogoClick()" src="{{ asset('storage/'.$setting->logo) }}" alt="logo" class="w-20 h-20 rounded-full object-cover hover:cursor-pointer hover:opacity-90 transition-all" />
                            
                        </div>
                        <x-input-error :messages="$errors->get('logo')" class="mt-1 w-1/4" />
                    </div>
                    <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="favicon" :value="__('Favicon')" />
                        <x-text-input @change="onFaviconChange()" id="favicon" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="favicon" value="{{ $setting->favicon }}" />
                        <div class="flex">
                            <img id="favicon_logo" @click="onFaviconClick()" src="{{ asset('storage/'.$setting->favicon) }}" alt="favicon" class="w-20 h-20 rounded-full object-cover hover:cursor-pointer hover:opacity-90 transition-all" />
                            
                        </div>
                        <x-input-error :messages="$errors->get('favicon')" class="mt-1 w-1/4" />
                    </div>
                    <div class="flex justify-between sm:justify-normal sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="background" :value="__('Background Logo')" />
                        <x-text-input @change="onBackgroundLogoChange()" id="background" class=" mt-1 w-full sm:w-3/4 hidden" type="file" name="background" value="{{ $setting->background_logo }}" />
                        <div class="flex">
                            <img id="background_logo" @click="onBackgroundLogoClick()" src="{{ asset('storage/'.$setting->background_logo) }}" alt="background_logo" class="w-20 h-20 rounded-full object-cover hover:cursor-pointer hover:opacity-90 transition-all" />
                        </div>
                        <x-input-error :messages="$errors->get('background_logo')" class="mt-1 w-1/4" />
                    </div>
                    <div class="flex flex-col sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto" for="address" :value="__('Address')" />
                        <div class="flex flex-col w-full justify-between">
                            <x-text-input id="address" class="block mt-1 w-full sm:w-3/4" type="text" name="address" value="{{ $setting->address }}" />
                            <x-input-error :messages="$errors->get('address')" class="mt-1" />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row border-b py-2 my-auto">
                        <x-input-label class="sm:w-1/4 my-auto font-semibold" for="phone" :value="__('Phone')" />
                        <div class="flex flex-col w-full">
                            <x-text-input id="phone" class="block mt-1 w-full sm:w-3/4" type="text" name="phone" value="{{ $setting->phone }}" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                        </div>
                    </div>
                    <div class="flex justify-end w-full mt-1">
                        <x-primary-button type="submit" class="ml-3">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</x-app-layout>


<script>
    function Setting(){
        return {
            logo: null,
            favicon: null,
            background_logo: null,
            init(){
                this.logo = document.getElementById('logo').files[0];
                this.favicon = document.getElementById('favicon').files[0];
            },
            onLogoChange(){
                this.logo = document.getElementById('logo').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('logo_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.logo);

            },

            onBackgroundLogoChange(){
                this.background_logo = document.getElementById('background').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('background_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.background_logo);

            },

            onFaviconChange(){
                this.favicon = document.getElementById('favicon').files[0];
                // override the src of the image
                let reader = new FileReader();
                reader.onload = (e) => {
                    document.getElementById('favicon_logo').src = e.target.result;
                }
                reader.readAsDataURL(this.favicon);

            },
            onLogoClick(){
                document.getElementById('logo').click();
            },
            onBackgroundLogoClick(){
                document.getElementById('background').click();
            },
            onFaviconClick(){
                document.getElementById('favicon').click();
            }
        }
    }

</script>