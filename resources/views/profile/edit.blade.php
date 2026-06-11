<x-app-layout>
    <x-slot name="header">
        <div class="bg-blue-900 text-white py-5 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-xl font-bold tracking-wider">
                    PROFILE
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 p-6 border-l-4 border-l-blue-900 transition-all duration-200">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 p-6 border-l-4 border-l-amber-500 transition-all duration-200">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-100 p-6 border-l-4 border-l-red-600 transition-all duration-200">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>