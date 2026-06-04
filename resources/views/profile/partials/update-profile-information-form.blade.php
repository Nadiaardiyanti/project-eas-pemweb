<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update your account's profile information and email address.
        </p>
    </header>

    <div class="mt-6 flex gap-10 items-start">

        <div class="flex flex-col items-center bg-gray-50 border rounded p-6 w-[280px] shrink-0">
            <div class="w-32 h-32 rounded-full bg-blue-900 flex items-center justify-center text-white text-4xl font-bold overflow-hidden">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <button type="button"
                class="mt-4 bg-blue-900 text-white px-6 py-2 rounded whitespace-nowrap">
                Ubah Foto Profile
            </button>

            <p class="text-xs text-gray-500 mt-3 text-center leading-relaxed">
                Fitur upload foto dapat ditambahkan kemudian.
            </p>
        </div>

        <form method="post"
              action="{{ route('profile.update') }}"
              class="flex-1 space-y-6">

            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name"
                              name="name"
                              type="text"
                              class="mt-1 block w-full"
                              :value="old('name', $user->name)"
                              required
                              autofocus
                              autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email"
                              name="email"
                              type="email"
                              class="mt-1 block w-full"
                              :value="old('email', $user->email)"
                              required
                              autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    {{ __('Save') }}
                </x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >
                        {{ __('Saved.') }}
                    </p>
                @endif
            </div>
        </form>

    </div>
</section>