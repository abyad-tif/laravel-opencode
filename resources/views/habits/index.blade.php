<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Habit Tracker</h2>
            <p class="text-sm text-gray-500">{{ $totalHabits }} habits · {{ $bestStreak }} best streak</p>
        </div>
    </x-slot>

    <div class="py-12" x-data="habitApp()" x-init="init()">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-5 text-center">
                    <div class="w-9 h-9 mx-auto bg-sky-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-sky-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalHabits }}</p>
                    <p class="text-xs text-gray-500">Active Habits</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-5 text-center">
                    <div class="w-9 h-9 mx-auto bg-emerald-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-emerald-500" x-text="completedToday"></p>
                    <p class="text-xs text-gray-500">Done Today</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-5 text-center">
                    <div class="w-9 h-9 mx-auto bg-amber-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-amber-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0 1 12 21 8.25 8.25 0 0 1 6.038 7.047 8.287 8.287 0 0 0 9 9.601a8.983 8.983 0 0 1 3.361-6.867 8.21 8.21 0 0 0 3 2.48Z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-amber-500" x-text="currentStreak"></p>
                    <p class="text-xs text-gray-500">Best Streak</p>
                </div>

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-5 text-center">
                    <div class="w-9 h-9 mx-auto bg-purple-100 rounded-xl flex items-center justify-center mb-2">
                        <svg class="w-5 h-5 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                    </div>
                    <p class="text-2xl font-bold text-purple-500" x-text="totalLogs"></p>
                    <p class="text-xs text-gray-500">Total Logs</p>
                </div>
            </div>

            {{-- Input Bar --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 p-5">
                <form class="flex items-center gap-3" @@submit.prevent="addHabit">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <input type="text" x-model="newHabitName" placeholder="New habit name..." required
                            class="input input-bordered w-full pl-11 bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200" />
                    </div>
                    <input type="text" x-model="newHabitDesc" placeholder="Description (optional)"
                        class="input input-bordered w-48 lg:w-64 bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200 hidden sm:block" />
                    <div class="hidden sm:flex items-center">
                        <label class="w-8 h-10 rounded-lg border border-gray-200 overflow-hidden cursor-pointer" :style="{ backgroundColor: newHabitColor }">
                            <input type="color" x-model="newHabitColor" class="w-10 h-10 -ml-1 -mt-1 cursor-pointer opacity-0" />
                        </label>
                    </div>
                    <button type="submit" class="btn bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 border-none text-white shadow-lg shadow-sky-200/50">
                        <svg class="w-5 h-5 sm:mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span class="hidden sm:inline">Add Habit</span>
                    </button>
                </form>
            </div>

            {{-- Habits Grid --}}
            <div class="space-y-4">
                <template x-if="habits.length === 0">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 py-16 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        <p class="text-gray-400 font-medium">No habits yet</p>
                        <p class="text-gray-300 text-sm mt-1">Start building your first habit above</p>
                    </div>
                </template>

                <template x-for="(habit, index) in habits" :key="habit.id">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg shadow-sky-200/30 border border-white/50 p-5 transition-all duration-300 hover:shadow-xl"
                        x-data="{ openMenu: false }">

                        {{-- Habit Header --}}
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                <div class="w-4 h-4 rounded-full flex-shrink-0" :style="{ backgroundColor: habit.color }"></div>
                                <div class="min-w-0">
                                    <template x-if="editingId === habit.id">
                                        <input type="text" x-model="editName"
                                            class="input input-bordered input-sm w-full bg-gray-50 border-gray-200"
                                            @@keydown.enter="saveEdit(habit)"
                                            @@keydown.escape="cancelEdit"
                                            @@click.outside="saveEdit(habit)"
                                            x-ref="editInput" />
                                    </template>
                                    <template x-if="editingId !== habit.id">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate"
                                            x-text="habit.name"
                                            @@dblclick="startEdit(habit)"></h3>
                                    </template>
                                    <p x-show="habit.description" class="text-xs text-gray-400 truncate" x-text="habit.description"></p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="text-right hidden sm:block">
                                    <span class="text-lg font-bold text-gray-900" x-text="habit.streak"></span>
                                    <span class="text-xs text-gray-400 ml-0.5">day streak</span>
                                </div>
                                <div class="relative" @@click.outside="openMenu = false">
                                    <button @@click="openMenu = !openMenu" class="btn btn-ghost btn-xs btn-square text-gray-400 hover:text-gray-600">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                        </svg>
                                    </button>
                                    <div x-show="openMenu" x-cloak
                                        class="absolute right-0 mt-1 w-36 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-10">
                                        <button @@click="openMenu = false; startEdit(habit)"
                                            class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 w-full transition-colors">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                            Rename
                                        </button>
                                        <button @@click="openMenu = false; deleteHabit(habit, index)"
                                            class="flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 w-full transition-colors">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Week Grid --}}
                        <div class="flex items-center gap-1.5 mb-3">
                            <template x-for="(day, di) in habit.week" :key="di">
                                <button @@click="toggleDate(habit, day.date)"
                                    class="flex-1 flex flex-col items-center gap-1 py-2 rounded-xl transition-all duration-200"
                                    :class="day.completed
                                        ? 'text-white shadow-sm'
                                        : 'text-gray-400 hover:bg-gray-50'"
                                    :style="day.completed ? { backgroundColor: habit.color } : {}">
                                    <span class="text-[10px] font-medium uppercase" x-text="day.day"></span>
                                    <template x-if="day.completed">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </template>
                                    <template x-if="!day.completed">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <circle cx="12" cy="12" r="9" />
                                        </svg>
                                    </template>
                                </button>
                            </template>
                        </div>

                        {{-- 60-day mini grid --}}
                        <div class="flex items-center gap-0.5" :title="`${habit.name} - Last 60 days`">
                            <template x-for="(cell, ci) in habit.grid" :key="ci">
                                <div class="w-2.5 h-2.5 rounded-sm transition-all duration-200"
                                    :class="cell ? 'opacity-100' : 'opacity-30'"
                                    :style="{ backgroundColor: cell ? habit.color : '#e5e7eb' }">
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            <p class="text-center text-xs text-gray-400">Click a day to toggle completion · Double-click name to rename</p>
        </div>

        <script>
            function habitApp() {
                return {
                    habits: [],
                    newHabitName: '',
                    newHabitDesc: '',
                    newHabitColor: '#0ea5e9',
                    editingId: null,
                    editName: '',
                    completedToday: {{ $completedToday }},
                    currentStreak: {{ $bestStreak }},
                    totalLogs: 0,

                    init() {
                        this.habits = @json($habitsData);
                        this.totalLogs = this.habits.reduce((sum, h) => sum + h.total_logs, 0);
                    },

                    async addHabit() {
                        if (!this.newHabitName.trim()) return;

                        const res = await fetch('{{ route('habits.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                name: this.newHabitName,
                                description: this.newHabitDesc,
                                color: this.newHabitColor,
                            }),
                        });

                        const data = await res.json();
                        if (data.success) {
                            const h = data.habit;
                            const emptyWeek = [];
                            const today = new Date();
                            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                            for (let i = 6; i >= 0; i--) {
                                const d = new Date(today);
                                d.setDate(d.getDate() - i);
                                emptyWeek.push({
                                    date: d.toISOString().split('T')[0],
                                    day: days[d.getDay()],
                                    completed: false,
                                });
                            }
                            this.habits.unshift({
                                id: h.id,
                                name: h.name,
                                description: h.description,
                                color: h.color,
                                icon: h.icon,
                                streak: 0,
                                week: emptyWeek,
                                grid: Array(60).fill(false),
                                today_completed: false,
                                total_logs: 0,
                            });
                            this.newHabitName = '';
                            this.newHabitDesc = '';
                            this.newHabitColor = '#0ea5e9';
                        }
                    },

                    async toggleDate(habit, dateStr) {
                        const res = await fetch(`/habits/${habit.id}/toggle`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ date: dateStr }),
                        });

                        const data = await res.json();
                        if (data.success) {
                            habit.week.forEach(d => {
                                if (d.date === data.date) d.completed = data.completed;
                            });
                            habit.streak = data.streak;
                            habit.today_completed = data.completed;

                            // Update grid
                            const today = new Date();
                            const dateObj = new Date(dateStr);
                            const diff = Math.round((today - dateObj) / (1000 * 60 * 60 * 24));
                            if (diff >= 0 && diff < 60) {
                                habit.grid[59 - diff] = data.completed;
                            }

                            // Recalc stats
                            this.updateStats();
                        }
                    },

                    startEdit(habit) {
                        this.editingId = habit.id;
                        this.editName = habit.name;
                        this.$nextTick(() => {
                            if (this.$refs.editInput) this.$refs.editInput.focus();
                        });
                    },

                    cancelEdit() {
                        this.editingId = null;
                        this.editName = '';
                    },

                    async saveEdit(habit) {
                        if (!this.editName.trim() || this.editingId !== habit.id) {
                            this.cancelEdit();
                            return;
                        }

                        const res = await fetch(`/habits/${habit.id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({ name: this.editName }),
                        });

                        const data = await res.json();
                        if (data.success) {
                            habit.name = data.habit.name;
                        }
                        this.cancelEdit();
                    },

                    async deleteHabit(habit, index) {
                        if (!confirm(`Delete "${habit.name}"? All logs will be lost.`)) return;

                        const res = await fetch(`/habits/${habit.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                        });

                        const data = await res.json();
                        if (data.success) {
                            this.habits.splice(index, 1);
                            this.updateStats();
                        }
                    },

                    updateStats() {
                        this.totalLogs = this.habits.reduce((sum, h) => sum + h.total_logs, 0);
                        this.completedToday = this.habits.filter(h => h.today_completed).length;
                        this.currentStreak = Math.max(...this.habits.map(h => h.streak), 0);
                    },
                };
            }
        </script>
    </div>
</x-app-layout>
