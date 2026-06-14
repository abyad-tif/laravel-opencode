<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->format('l, F j, Y') }}</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Stats Overview --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Tasks</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalTodos }}</p>
                        </div>
                        <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                        </div>
                    </div>
                    @if($totalTodos > 0)
                        <div class="mt-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-500">{{ $completedTodos }} completed</span>
                                <span class="font-medium text-gray-700">{{ $completionRate }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-sky-400 to-blue-500 h-2 rounded-full transition-all duration-500" style="width: {{ $completionRate }}%"></div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pending Tasks</p>
                            <p class="text-3xl font-bold text-amber-500 mt-1">{{ $pendingTodos }}</p>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-gray-500">{{ $pendingTodos > 0 ? 'Focus on completing your remaining tasks.' : 'All tasks completed! 🎉' }}</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Habits</p>
                            <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalHabits }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                    </div>
                    @if($totalHabits > 0)
                        <p class="mt-4 text-sm text-gray-500">
                            <span class="font-semibold text-emerald-600">{{ $completedToday }}</span> completed today out of {{ $totalHabits }}
                        </p>
                    @else
                        <p class="mt-4 text-sm text-gray-500">Start building new habits today.</p>
                    @endif
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Completed Today</p>
                            <p class="text-3xl font-bold text-emerald-500 mt-1">{{ $completedToday }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-gray-500">Keep up the good momentum!</p>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Recent Todos --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Recent Tasks</h3>
                        <a href="#" class="text-sm font-medium text-sky-600 hover:text-sky-500 transition-colors">View all</a>
                    </div>

                    @if($recentTodos->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                            <p class="text-gray-400">No tasks yet</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($recentTodos as $todo)
                                <div class="flex items-center gap-3 p-3 rounded-xl transition-colors {{ $todo->is_completed ? 'bg-gray-50' : 'hover:bg-gray-50' }}">
                                    <div class="flex-shrink-0">
                                        <div class="w-5 h-5 rounded-full border-2 {{ $todo->is_completed ? 'bg-emerald-400 border-emerald-400' : 'border-gray-300' }} flex items-center justify-center">
                                            @if($todo->is_completed)
                                                <svg class="w-3 h-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium {{ $todo->is_completed ? 'text-gray-400 line-through' : 'text-gray-900' }}">
                                            {{ $todo->title }}
                                        </p>
                                        @if($todo->description)
                                            <p class="text-xs text-gray-500 truncate">{{ $todo->description }}</p>
                                        @endif
                                    </div>
                                    <span class="text-xs text-gray-400">{{ $todo->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Weekly Habit Progress --}}
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Weekly Progress</h3>
                        <a href="#" class="text-sm font-medium text-sky-600 hover:text-sky-500 transition-colors">View all</a>
                    </div>

                    @if($habits->isEmpty())
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                            <p class="text-gray-400">No habits tracked yet</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            {{-- Weekly bar chart --}}
                            <div class="flex items-end justify-between gap-2 h-32 pt-2 pb-1">
                                @foreach($weeklyData as $day)
                                    <div class="flex-1 flex flex-col items-center gap-1">
                                        <span class="text-xs font-medium {{ $day['count'] > 0 ? 'text-emerald-600' : 'text-gray-400' }}">
                                            {{ $day['count'] }}
                                        </span>
                                        <div class="w-full rounded-lg transition-all duration-300" style="height: {{ max($day['count'] * 20, 4) }}px; background-color: {{ $day['count'] > 0 ? '#10b981' : '#e5e7eb' }};"></div>
                                        <span class="text-xs text-gray-500 mt-1">{{ $day['day'] }}</span>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Habits list --}}
                            <div class="space-y-2 pt-4 border-t border-gray-100">
                                @foreach($habits as $habit)
                                    <div class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-3 h-3 rounded-full" style="background-color: {{ $habit->color }}"></div>
                                            <span class="text-sm font-medium text-gray-900">{{ $habit->name }}</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            @php
                                                $weekLogs = $habit->logs()->whereBetween('date', [\Carbon\Carbon::today()->subDays(6), \Carbon\Carbon::today()])->get();
                                            @endphp
                                            @for($i = 6; $i >= 0; $i--)
                                                @php
                                                    $date = \Carbon\Carbon::today()->subDays($i)->format('Y-m-d');
                                                    $logged = $weekLogs->firstWhere('date', $date);
                                                @endphp
                                                <div class="w-4 h-4 rounded-sm {{ $logged ? 'bg-emerald-400' : 'bg-gray-200' }}"></div>
                                            @endfor
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
