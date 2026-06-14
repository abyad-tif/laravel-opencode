<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-sm border-b border-white/50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-sky-500 to-blue-600 rounded-lg shadow flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-800">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <div class="hidden sm:flex sm:items-center sm:ms-6 sm:gap-1">
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                        {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('todos.index') }}"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                        {{ request()->routeIs('todos.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }}">
                        To-Do
                    </a>
                    <a href="{{ route('habits.index') }}"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                        {{ request()->routeIs('habits.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }}">
                        Habits
                    </a>
                    <a href="{{ route('profile.show') }}"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                        {{ request()->routeIs('profile.show') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:text-gray-800 hover:bg-gray-100' }}">
                        Profile
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-sm gap-2 normal-case">
                        <div class="w-6 h-6 rounded-full bg-gradient-to-br from-sky-400 to-blue-500 flex items-center justify-center text-white text-xs font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow-xl bg-white/90 backdrop-blur-sm rounded-xl border border-white/50 w-52">
                        <li>
                            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-3 py-2 text-sm text-gray-700 hover:bg-sky-50 hover:text-sky-700 rounded-lg transition-colors">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Profile
                            </a>
                        </li>
                        <li class="mt-1 border-t border-gray-100 pt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-3 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors w-full">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                    </svg>
                                    Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="btn btn-ghost btn-sm">
                    <svg x-show="!open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg x-show="open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 text-sm font-medium rounded-lg transition-all
                {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Dashboard
            </a>
            <a href="{{ route('todos.index') }}"
                class="block px-3 py-2 text-sm font-medium rounded-lg transition-all
                {{ request()->routeIs('todos.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:bg-gray-100' }}">
                To-Do
            </a>
            <a href="{{ route('habits.index') }}"
                class="block px-3 py-2 text-sm font-medium rounded-lg transition-all
                {{ request()->routeIs('habits.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Habits
            </a>
            <a href="{{ route('profile.show') }}"
                class="block px-3 py-2 text-sm font-medium rounded-lg transition-all
                {{ request()->routeIs('profile.show') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:bg-gray-100' }}">
                Profile
            </a>
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200 px-4">
            <div class="flex items-center gap-3 px-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-sky-400 to-blue-500 flex items-center justify-center text-white text-sm font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.show') }}"
                    class="flex items-center gap-3 px-3 py-2 text-sm text-gray-700 hover:bg-sky-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-3 px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors w-full">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                        </svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
