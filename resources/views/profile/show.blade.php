<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Profile</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Profile Header --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 overflow-hidden">
                <div class="h-32 bg-gradient-to-r from-sky-400 via-sky-500 to-blue-600"></div>
                <div class="px-6 pb-6">
                    <div class="flex flex-col sm:flex-row items-center sm:items-end gap-4 -mt-12">
                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-br from-sky-400 to-blue-500 shadow-lg border-4 border-white flex items-center justify-center">
                            <span class="text-3xl font-bold text-white">{{ substr($user->name, 0, 2) }}</span>
                        </div>
                        <div class="text-center sm:text-left sm:pb-1">
                            <h3 class="text-xl font-bold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                        <div class="sm:ml-auto sm:pb-1">
                            <a href="{{ route('profile.edit') }}" class="btn btn-sm bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 border-none text-white shadow-lg shadow-sky-200/50">
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Account Details --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Details</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                        <p class="text-gray-900 font-medium">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                        <p class="text-gray-900 font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Member Since</label>
                        <p class="text-gray-900 font-medium">{{ $user->created_at->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Email Verified</label>
                        @if($user->email_verified_at)
                            <p class="text-emerald-600 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                                Verified on {{ $user->email_verified_at->format('M j, Y') }}
                            </p>
                        @else
                            <p class="text-amber-600 font-medium">Not verified</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 p-6 text-center">
                    <div class="w-10 h-10 mx-auto bg-sky-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Todo::where('user_id', $user->id)->count() }}</p>
                    <p class="text-sm text-gray-500">Total Tasks</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 p-6 text-center">
                    <div class="w-10 h-10 mx-auto bg-emerald-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Todo::where('user_id', $user->id)->where('is_completed', true)->count() }}</p>
                    <p class="text-sm text-gray-500">Completed Tasks</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 p-6 text-center">
                    <div class="w-10 h-10 mx-auto bg-purple-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Habit::where('user_id', $user->id)->count() }}</p>
                    <p class="text-sm text-gray-500">Active Habits</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
