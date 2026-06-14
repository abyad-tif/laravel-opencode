<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">To-Do List</h2>
            <p class="text-sm text-gray-500">{{ $stats['total'] }} tasks · {{ $stats['completed'] }} done</p>
        </div>
    </x-slot>

    <div class="py-12" x-data="todoApp()" x-init="init()">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stats --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg shadow-sky-200/30 border border-white/50 p-4 text-center">
                    <p class="text-2xl font-bold text-gray-900" x-text="todos.length"></p>
                    <p class="text-xs text-gray-500">Total</p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg shadow-sky-200/30 border border-white/50 p-4 text-center">
                    <p class="text-2xl font-bold text-emerald-500" x-text="completedCount"></p>
                    <p class="text-xs text-gray-500">Completed</p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg shadow-sky-200/30 border border-white/50 p-4 text-center">
                    <p class="text-2xl font-bold text-amber-500" x-text="pendingCount"></p>
                    <p class="text-xs text-gray-500">Pending</p>
                </div>
            </div>

            {{-- Input Bar --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 p-4">
                <form class="flex items-center gap-3" @@submit.prevent="addTodo">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <input type="text" x-model="newTodoTitle" placeholder="Add a new task..." required
                            class="input input-bordered w-full pl-11 pr-4 bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200" />
                    </div>
                    <input type="text" x-model="newTodoDescription" placeholder="Description (optional)"
                        class="input input-bordered w-64 bg-gray-50/50 border-gray-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 transition-all duration-200 hidden sm:block" />
                    <button type="submit" class="btn bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 border-none text-white shadow-lg shadow-sky-200/50">
                        <svg class="w-5 h-5 sm:mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        <span class="hidden sm:inline">Add Task</span>
                    </button>
                </form>
            </div>

            {{-- Todo Table --}}
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl shadow-sky-200/30 border border-white/50 overflow-hidden">
                <template x-if="todos.length === 0">
                    <div class="text-center py-16">
                        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15a2.25 2.25 0 0 1 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                        <p class="text-gray-400 font-medium">No tasks yet</p>
                        <p class="text-gray-300 text-sm mt-1">Add your first task above</p>
                    </div>
                </template>

                <template x-if="todos.length > 0">
                    <div>
                        {{-- Table Header --}}
                        <div class="hidden sm:grid grid-cols-[auto_1fr_auto_auto] gap-4 px-6 py-3 bg-gray-50/50 border-b border-gray-100 text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <span class="w-5"></span>
                            <span>Task</span>
                            <span>Status</span>
                            <span class="w-20 text-right">Action</span>
                        </div>

                        {{-- Table Rows --}}
                        <div class="divide-y divide-gray-100">
                            <template x-for="(todo, index) in todos" :key="todo.id">
                                <div class="grid grid-cols-[auto_1fr_auto_auto] gap-4 px-4 sm:px-6 py-4 items-center transition-all duration-200"
                                    :class="todo.is_completed ? 'bg-gray-50/50' : 'hover:bg-gray-50'">

                                    {{-- Checkbox --}}
                                    <div class="flex items-center">
                                        <button @@click="toggleTodo(todo)"
                                            class="w-5 h-5 rounded-full border-2 flex items-center justify-center transition-all duration-200"
                                            :class="todo.is_completed ? 'bg-emerald-400 border-emerald-400' : 'border-gray-300 hover:border-sky-400'">
                                            <svg x-show="todo.is_completed" class="w-3 h-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Title & Description --}}
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <template x-if="editingId === todo.id">
                                                <input type="text" x-model="editTitle"
                                                    class="input input-bordered input-sm w-full bg-gray-50 border-gray-200 focus:border-sky-500"
                                                    @@keydown.enter="saveEdit(todo)"
                                                    @@keydown.escape="cancelEdit"
                                                    @@click.outside="saveEdit(todo)"
                                                    x-ref="editInput" />
                                            </template>
                                            <template x-if="editingId !== todo.id">
                                                <span class="text-sm font-medium"
                                                    :class="todo.is_completed ? 'text-gray-400 line-through' : 'text-gray-900'"
                                                    x-text="todo.title"
                                                    @@dblclick="startEdit(todo)"></span>
                                            </template>
                                        </div>
                                        <p x-show="todo.description" class="text-xs text-gray-400 mt-0.5 truncate" x-text="todo.description"></p>
                                    </div>

                                    {{-- Status Badge --}}
                                    <div class="flex items-center">
                                        <span class="text-xs font-medium px-2.5 py-1 rounded-full"
                                            :class="todo.is_completed ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'"
                                            x-text="todo.is_completed ? 'Done' : 'Active'"></span>
                                    </div>

                                    {{-- Actions --}}
                                    <div class="flex items-center gap-1 justify-end">
                                        <button @@click="startEdit(todo)" class="btn btn-ghost btn-xs text-gray-400 hover:text-sky-600">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                        <button @@click="deleteTodo(todo, index)" class="btn btn-ghost btn-xs text-gray-400 hover:text-red-500">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>

            {{-- Clear hint --}}
            <p class="text-center text-xs text-gray-400">Double-click a task title to edit · Click the checkbox to toggle</p>
        </div>

        <script>
            function todoApp() {
                return {
                    todos: [],
                    newTodoTitle: '',
                    newTodoDescription: '',
                    editingId: null,
                    editTitle: '',

                    get completedCount() {
                        return this.todos.filter(t => t.is_completed).length;
                    },

                    get pendingCount() {
                        return this.todos.filter(t => !t.is_completed).length;
                    },

                    init() {
                        this.todos = @json($todos);
                    },

                    async addTodo() {
                        if (!this.newTodoTitle.trim()) return;

                        const res = await fetch('{{ route('todos.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                title: this.newTodoTitle,
                                description: this.newTodoDescription,
                            }),
                        });

                        const data = await res.json();
                        if (data.success) {
                            this.todos.unshift(data.todo);
                            this.newTodoTitle = '';
                            this.newTodoDescription = '';
                        }
                    },

                    async toggleTodo(todo) {
                        const res = await fetch(`/todos/${todo.id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                is_completed: !todo.is_completed,
                            }),
                        });

                        const data = await res.json();
                        if (data.success) {
                            todo.is_completed = data.todo.is_completed;
                            todo.completed_at = data.todo.completed_at;
                        }
                    },

                    startEdit(todo) {
                        this.editingId = todo.id;
                        this.editTitle = todo.title;
                        this.$nextTick(() => {
                            if (this.$refs.editInput) this.$refs.editInput.focus();
                        });
                    },

                    cancelEdit() {
                        this.editingId = null;
                        this.editTitle = '';
                    },

                    async saveEdit(todo) {
                        if (!this.editTitle.trim() || this.editingId !== todo.id) {
                            this.cancelEdit();
                            return;
                        }

                        const res = await fetch(`/todos/${todo.id}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                title: this.editTitle,
                            }),
                        });

                        const data = await res.json();
                        if (data.success) {
                            todo.title = data.todo.title;
                        }
                        this.cancelEdit();
                    },

                    async deleteTodo(todo, index) {
                        if (!confirm('Delete this task?')) return;

                        const res = await fetch(`/todos/${todo.id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                        });

                        const data = await res.json();
                        if (data.success) {
                            this.todos.splice(index, 1);
                        }
                    },
                };
            }
        </script>
    </div>
</x-app-layout>
