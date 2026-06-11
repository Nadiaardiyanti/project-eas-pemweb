<section class="space-y-6">

    <header class="border-b border-gray-100 pb-4">
        <h2 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
            <span class="w-1.5 h-5 bg-amber-500 rounded-full inline-block"></span>
            Account Security
        </h2>

        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
            Update your password to keep your account secure.
        </p>
    </header>

    @if (session('status') === 'password-updated')
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
            Password updated successfully.
        </div>
    @endif

    <form method="post"
          action="{{ route('password.update') }}"
          class="space-y-5 bg-white border border-gray-100 p-6 rounded-2xl shadow-sm w-full">

        @csrf
        @method('put')

        <div>
            <x-input-label
                for="update_password_current_password"
                value="Current Password"
                class="text-xs text-gray-600 font-semibold uppercase tracking-wider" />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-1.5 block w-full rounded-xl bg-gray-50/50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all duration-200 text-sm"
                autocomplete="current-password" />

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2" />
        </div>

        <div>
            <x-input-label
                for="update_password_password"
                value="New Password"
                class="text-xs text-gray-600 font-semibold uppercase tracking-wider" />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-1.5 block w-full rounded-xl bg-gray-50/50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all duration-200 text-sm"
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2" />
        </div>

        <div>
            <x-input-label
                for="update_password_password_confirmation"
                value="Confirm New Password"
                class="text-xs text-gray-600 font-semibold uppercase tracking-wider" />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1.5 block w-full rounded-xl bg-gray-50/50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all duration-200 text-sm"
                autocomplete="new-password" />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2" />
        </div>

        <div class="pt-2 flex justify-end">
            <button
                type="submit"
                class="w-full sm:w-auto bg-amber-500 hover:bg-amber-600 text-white font-medium text-sm px-6 py-2.5 rounded-xl shadow-sm hover:shadow transition-all duration-200 active:scale-98">
                Update Password
            </button>
        </div>

    </form>

</section>