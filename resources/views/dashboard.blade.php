<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6 bg-gray-50 dark:bg-gray-900">
        
        {{-- Header --}}
        <header class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('Dashboard') }}</h1>
        </header>

        {{-- Stat Cards --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Jumlah Siswa</h2>
                <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $jumlahSiswa }}</p>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Jumlah Guru</h2>
                <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ $jumlahGuru }}</p>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Jumlah Industri</h2>
                <p class="mt-2 text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $jumlahIndustri }}</p>
            </div>
        </div>

        {{-- Line Chart: Aktivitas per Hari --}}
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Aktivitas 7 Hari Terakhir</h2>
            <canvas id="activityLineChart" height="100"></canvas>
        </div>

        {{-- Latest Activity --}}
        <div class="overflow-auto rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengguna</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktivitas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($latestActivity as $log)
                        <tr>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900 dark:text-white">
                                {{ $log->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $log->user->name ?? 'Unknown' }}
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                {{ $log->description }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                Tidak ada aktivitas terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('activityLineChart')?.getContext('2d');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    label: 'Jumlah Aktivitas',
                    data: @json($chartData['counts']),
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#3b82f6'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
</x-layouts.app>
