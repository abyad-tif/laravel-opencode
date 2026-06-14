<section>
    <header>
        <h2 class="text-lg font-semibold text-gray-900">Update Password</h2>
        <p class="mt-1 text-sm text-gray-500">Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-1.5">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="input input-bordered w-full bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-1.5">New Password</label>
            <input id="update_password_password" name="password" type="password" class="input input-bordered w-full bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="input input-bordered w-full bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 border-none text-white shadow-lg shadow-sky-200/50">
                Save
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-500">
                    Saved.
                </p>
            @endif
        </div>
    </form>
</section>
