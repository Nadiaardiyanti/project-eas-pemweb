<section class="space-y-6">

    <header class="border-b border-gray-100 pb-4">
        <h2 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
            <span class="w-1.5 h-5 bg-blue-900 rounded-full inline-block"></span>
            Profile Information
        </h2>
        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
            Manage your account information and email address.
        </p>
    </header>

    @if (session('status') === 'profile-updated')
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            x-init="setTimeout(() => show = false, 3000)"
            class="rounded-xl border border-green-100 bg-green-50/70 px-4 py-3 text-sm font-medium text-green-700 shadow-sm flex items-center gap-2"
        >
            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path></svg>
            Profile updated successfully.
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-6">

        <div class="w-full lg:w-72 bg-gradient-to-b from-white to-gray-50/50 border border-gray-200/70 rounded-2xl p-6 flex flex-col items-center justify-center shadow-sm">
            <div class="w-28 h-28 rounded-full bg-blue-900 flex items-center justify-center text-white text-3xl font-bold shadow-md border-4 border-white ring-4 ring-blue-900/5">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <h3 class="mt-4 text-base font-bold text-gray-800 text-center truncate w-full">
                {{ auth()->user()->name }}
            </h3>

            <p class="text-xs text-gray-500 text-center truncate w-full mt-0.5">
                {{ auth()->user()->email }}
            </p>

            <div class="mt-4 w-full border-t border-gray-100 pt-3 text-center">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 text-[10px] font-bold uppercase tracking-wider">
                    Active Account
                </span>
            </div>
        </div>

        <form method="post"
              action="{{ route('profile.update') }}"
              class="flex-1 space-y-5 bg-white border border-gray-100 p-6 rounded-2xl shadow-sm">

            @csrf
            @method('patch')

            <div>
                <x-input-label
                    for="name"
                    value="Full Name"
                    class="text-xs text-gray-600 font-semibold uppercase tracking-wider" />

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    class="mt-1.5 block w-full rounded-xl bg-gray-50/50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 transition-all duration-200 text-sm"
                    :value="old('name', $user->name)"
                    required />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label
                    for="email"
                    value="Email"
                    class="text-xs text-gray-600 font-semibold uppercase tracking-wider" />

                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    class="mt-1.5 block w-full rounded-xl bg-gray-50/50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-blue-900/10 focus:border-blue-900 transition-all duration-200 text-sm"
                    :value="old('email', $user->email)"
                    required />

                <x-input-error
                    class="mt-2"
                    :messages="$errors->get('email')" />
            </div>

            <div class="pt-2 flex justify-end">
                <button
                    type="submit"
                    class="w-full sm:w-auto bg-blue-900 hover:bg-blue-800 text-white font-medium text-sm px-6 py-2.5 rounded-xl shadow-sm hover:shadow transition-all duration-200 active:scale-98">
                    Save Changes
                </button>
            </div>

        </form>

    </div>

</section>