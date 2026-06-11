<section class="space-y-6">

    <header class="border-b border-gray-100 pb-4">
        <h2 class="text-xl font-bold text-gray-900 tracking-tight flex items-center gap-2">
            <span class="w-1.5 h-5 bg-red-600 rounded-full inline-block"></span>
            Delete Account
        </h2>
        <p class="text-sm text-gray-500 mt-1 leading-relaxed">
            Once your account is deleted, all of its resources and data will be permanently deleted.
        </p>
    </header>

    <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm space-y-5">
        
        <div class="bg-red-50/60 border border-red-100 rounded-xl p-4 flex items-start gap-3.5">
            <div class="p-1.5 bg-red-100 text-red-700 rounded-lg shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h4 class="text-sm font-bold text-red-800">Warning</h4>
                <p class="text-xs text-red-600 mt-0.5 leading-relaxed">
                    Once an account is deleted, all data associated with it will be permanently deleted and cannot be recovered.
                </p>
            </div>
        </div>

        <div class="flex justify-end">
            <button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-medium text-sm px-6 py-2.5 rounded-xl shadow-sm hover:shadow transition-all duration-200 transform active:scale-95">
                Delete Account
            </button>
        </div>

    </div>

    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable>

        <form method="post"
              action="{{ route('profile.destroy') }}"
              class="p-6 bg-white rounded-2xl">

            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900 tracking-tight">
                Confirm Account Deletion
            </h2>

            <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                Enter your password to confirm account deletion. This action cannot be undone.
            </p>

            <div class="mt-5">
                <x-input-label
                    for="password"
                    value="Password"
                    class="text-xs text-gray-600 font-semibold uppercase tracking-wider" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1.5 block w-full rounded-xl bg-gray-50 border-gray-200 focus:bg-white focus:ring-4 focus:ring-red-500/10 focus:border-red-500 transition-all duration-200 text-sm"
                    placeholder="Enter Password" />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2" />
            </div>

            <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3 border-t pt-4 border-gray-100">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="w-full sm:w-auto bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm px-5 py-2.5 rounded-xl transition-all duration-200">
                    Cancelled
                </button>

                <button
                    type="submit"
                    class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white font-medium text-sm px-5 py-2.5 rounded-xl shadow-sm hover:shadow transition-all duration-200">
                    Yes, Delete Account
                </button>
            </div>

        </form>
    </x-modal>

</section>