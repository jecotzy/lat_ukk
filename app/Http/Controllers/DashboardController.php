<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
 public function index()
{
    $jumlahSiswa = Siswa::count();
    $jumlahGuru = Guru::count();
    $jumlahIndustri = Industri::count();

    $latestActivity = ActivityLog::with('user')
        ->latest()
        ->take(3)
        ->get();

    $logsPerDay = ActivityLog::whereBetween('created_at', [
        now()->subDays(6)->startOfDay(),
        now()->endOfDay()
    ])
    ->get()
    ->groupBy(fn($log) => Carbon::parse($log->created_at)->format('Y-m-d'))
    ->map(fn($logs) => $logs->count());

    $dates = collect(range(0, 6))
        ->map(fn($i) => Carbon::now()->subDays($i)->format('Y-m-d'))
        ->reverse()
        ->values()
        ->all();

    $counts = collect($dates)
        ->map(fn($date) => $logsPerDay[$date] ?? 0)
        ->values()
        ->all();

    $chartData = [
        'labels' => $dates,
        'counts' => $counts,
    ];

    return view('dashboard', compact(
        'jumlahSiswa',
        'jumlahGuru',
        'jumlahIndustri',
        'latestActivity',
        'chartData'
    ));
}

}
