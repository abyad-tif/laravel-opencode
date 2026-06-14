<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\HabitLog;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HabitController extends Controller
{
    public function index(Request $request): View
    {
        $habits = Habit::where('user_id', $request->user()->id)
            ->with(['logs' => function ($q) {
                $q->whereBetween('date', [Carbon::today()->subDays(60), Carbon::today()]);
            }])
            ->latest()
            ->get();

        $today = Carbon::today();
        $completedToday = 0;

        $habitsData = $habits->map(function ($habit) use ($today, &$completedToday) {
            $weekDates = [];
            $logsByDate = $habit->logs->keyBy(fn ($l) => $l->date->format('Y-m-d'));
            $streak = 0;

            for ($i = 6; $i >= 0; $i--) {
                $date = $today->copy()->subDays($i);
                $key = $date->format('Y-m-d');
                $logged = $logsByDate->get($key);
                $weekDates[] = [
                    'date' => $key,
                    'day' => $date->format('D'),
                    'completed' => $logged && $logged->is_completed,
                ];
            }

            $checkDate = $today->copy();
            while ($checkDate->greaterThanOrEqualTo($today->copy()->subDays(365))) {
                $key = $checkDate->format('Y-m-d');
                $logged = $logsByDate->get($key);
                if ($logged && $logged->is_completed) {
                    $streak++;
                    $checkDate->subDay();
                } else {
                    break;
                }
            }

            $todayLog = $logsByDate->get($today->format('Y-m-d'));
            if ($todayLog && $todayLog->is_completed) {
                $completedToday++;
            }

            // Last 60 days grid
            $grid = [];
            for ($i = 59; $i >= 0; $i--) {
                $date = $today->copy()->subDays($i);
                $key = $date->format('Y-m-d');
                $logged = $logsByDate->get($key);
                $grid[] = $logged && $logged->is_completed;
            }

            return [
                'id' => $habit->id,
                'name' => $habit->name,
                'description' => $habit->description,
                'color' => $habit->color,
                'icon' => $habit->icon,
                'streak' => $streak,
                'week' => $weekDates,
                'grid' => $grid,
                'today_completed' => $todayLog && $todayLog->is_completed,
                'total_logs' => $habit->logs->count(),
            ];
        });

        $totalHabits = $habits->count();
        $bestStreak = $habitsData->max('streak') ?? 0;

        return view('habits.index', compact(
            'habitsData',
            'totalHabits',
            'completedToday',
            'bestStreak',
        ));
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'color' => 'nullable|string|max:7',
        ]);

        $habit = Habit::create([
            ...$data,
            'color' => $data['color'] ?? '#0ea5e9',
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'habit' => $habit,
        ]);
    }

    public function update(Request $request, Habit $habit): JsonResponse
    {
        if ($habit->user_id !== $request->user()->id) abort(403);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'color' => 'nullable|string|max:7',
        ]);

        $habit->update($data);

        return response()->json(['success' => true, 'habit' => $habit->fresh()]);
    }

    public function destroy(Request $request, Habit $habit): JsonResponse
    {
        if ($habit->user_id !== $request->user()->id) abort(403);
        $habit->logs()->delete();
        $habit->delete();
        return response()->json(['success' => true]);
    }

    public function toggleLog(Request $request, Habit $habit): JsonResponse
    {
        if ($habit->user_id !== $request->user()->id) abort(403);

        $date = $request->input('date')
            ? Carbon::parse($request->input('date'))
            : Carbon::today();

        $log = HabitLog::where('habit_id', $habit->id)
            ->where('date', $date->format('Y-m-d'))
            ->first();

        if ($log) {
            $log->update(['is_completed' => !$log->is_completed]);
            $completed = $log->fresh()->is_completed;
        } else {
            HabitLog::create([
                'habit_id' => $habit->id,
                'date' => $date->format('Y-m-d'),
                'is_completed' => true,
            ]);
            $completed = true;
        }

        // Recalculate streak
        $logs = HabitLog::where('habit_id', $habit->id)
            ->where('is_completed', true)
            ->orderBy('date', 'desc')
            ->get()
            ->keyBy(fn ($l) => $l->date->format('Y-m-d'));

        $streak = 0;
        $checkDate = Carbon::today();
        while (true) {
            $key = $checkDate->format('Y-m-d');
            if ($logs->has($key)) {
                $streak++;
                $checkDate->subDay();
            } else {
                break;
            }
        }

        return response()->json([
            'success' => true,
            'completed' => $completed,
            'streak' => $streak,
            'date' => $date->format('Y-m-d'),
        ]);
    }
}
