<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-gray-900">Delete Account</h2>
        <p class="mt-1 text-sm text-gray-500">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="btn btn-error text-white border-none shadow-lg">
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">Are you sure you want to delete your account?</h2>

            <p class="mt-1 text-sm text-gray-500">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.</p>

            <div class="mt-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5 sr-only">Password</label>
                <input id="password" name="password" type="password" class="input input-bordered w-3/4 bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200" placeholder="Password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button x-on:click="$dispatch('close')" class="btn btn-ghost text-gray-600 hover:text-gray-800">
                    Cancel
                </button>
                <button type="submit" class="btn btn-error text-white border-none">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>
