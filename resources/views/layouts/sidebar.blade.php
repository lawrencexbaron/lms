<div class="flex flex-col min-h-full bg-white shadow">
    <div class="bg-blue-200 flex items-center justify-center h-40 w-full overflow-hidden">
        Add Picture
    </div>
    <div class="bg-gray-200 h-8 flex items-center justify-center">
        <p class="text-sm">Main Navigation</p>
    </div>
        <x-side-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Enrollees Today') }}
        </x-side-nav-link>
        <x-side-nav-link :href="route('sections.index')" :active="request()->routeIs('sections.index')">
            {{ __('Sections') }}
        </x-side-nav-link>
        <li class="py-3 px-4 cursor-pointer hover:bg-gray-50 transition hover:text-blue-900">Enrolled Students</li>
        <li class="py-3 px-4 cursor-pointer hover:bg-gray-50 transition hover:text-blue-900">Statistics</li>
        <li class="py-3 px-4 cursor-pointer hover:bg-gray-50 transition hover:text-blue-900">Settings</li>
</div>