<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        $today = Carbon::today();

        $totalTodos = Todo::where('user_id', $user->id)->count();
        $completedTodos = Todo::where('user_id', $user->id)->where('is_completed', true)->count();
        $pendingTodos = $totalTodos - $completedTodos;
        $completionRate = $totalTodos > 0 ? round(($completedTodos / $totalTodos) * 100) : 0;

        $recentTodos = Todo::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $habits = Habit::with(['logs' => function ($q) {
            $q->where('date', Carbon::today());
        }])->where('user_id', $user->id)->get();

        $totalHabits = $habits->count();
        $completedToday = $habits->filter(fn ($h) => $h->logs->isNotEmpty())->count();

        $todayLogs = DB::table('habit_logs')
            ->join('habits', 'habit_logs.habit_id', '=', 'habits.id')
            ->where('habits.user_id', $user->id)
            ->where('habit_logs.date', $today)
            ->where('habit_logs.is_completed', true)
            ->count();

        $thisWeekDates = [];
        for ($i = 0; $i < 7; $i++) {
            $thisWeekDates[] = $today->copy()->subDays($i);
        }

        $weeklyLogs = DB::table('habit_logs')
            ->join('habits', 'habit_logs.habit_id', '=', 'habits.id')
            ->where('habits.user_id', $user->id)
            ->whereBetween('habit_logs.date', [$thisWeekDates[6], $thisWeekDates[0]])
            ->where('habit_logs.is_completed', true)
            ->selectRaw('habit_logs.date, count(*) as count')
            ->groupBy('habit_logs.date')
            ->pluck('count', 'date');

        $weeklyData = [];
        foreach (array_reverse($thisWeekDates) as $date) {
            $key = $date->format('Y-m-d');
            $weeklyData[] = [
                'day' => $date->format('D'),
                'date' => $key,
                'count' => $weeklyLogs->get($key, 0),
            ];
        }

        return view('dashboard', compact(
            'totalTodos',
            'completedTodos',
            'pendingTodos',
            'completionRate',
            'recentTodos',
            'habits',
            'totalHabits',
            'completedToday',
            'weeklyData',
        ));
    }
}
