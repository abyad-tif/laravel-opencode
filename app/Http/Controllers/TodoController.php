<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(Request $request): View
    {
        $todos = Todo::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        $stats = [
            'total' => $todos->count(),
            'completed' => $todos->where('is_completed', true)->count(),
            'pending' => $todos->where('is_completed', false)->count(),
        ];

        return view('todos.index', compact('todos', 'stats'));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $todo = Todo::create([
            ...$data,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'todo' => $todo,
        ]);
    }

    public function update(Request $request, Todo $todo): JsonResponse|RedirectResponse
    {
        if ($todo->user_id !== $request->user()->id) {
            abort(403);
        }

        if ($request->has('is_completed')) {
            $todo->update([
                'is_completed' => $request->is_completed,
                'completed_at' => $request->is_completed ? now() : null,
            ]);

            return response()->json([
                'success' => true,
                'todo' => $todo->fresh(),
            ]);
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $todo->update($data);

        return response()->json([
            'success' => true,
            'todo' => $todo->fresh(),
        ]);
    }

    public function destroy(Request $request, Todo $todo): JsonResponse
    {
        if ($todo->user_id !== $request->user()->id) {
            abort(403);
        }

        $todo->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
