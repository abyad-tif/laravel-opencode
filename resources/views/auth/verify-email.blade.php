<x-guest-layout>
    <div class="text-center mb-6">
        <div class="w-12 h-12 mx-auto bg-sky-100 rounded-full flex items-center justify-center mb-3">
            <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900">Verify Your Email</h3>
        <p class="mt-1 text-sm text-gray-500">Thanks for signing up! Please verify your email address to get started.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 rounded-xl text-sm text-green-700">
            A new verification link has been sent to your email address.
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary w-full bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 border-none text-white text-base font-semibold py-3 h-auto shadow-lg shadow-sky-200/50">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-ghost w-full text-gray-500 hover:text-gray-700 text-sm">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
