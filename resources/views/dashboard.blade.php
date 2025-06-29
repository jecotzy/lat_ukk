<x-layouts.app :title="__('Dashboard')">
    <div class="flex flex-col gap-6 p-6 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900/90 dark:to-gray-900">
        <header class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ __('Selamat Datang di Lapor Pak!') }}</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Platform Lapor Pkl Modern dan Mudah</p>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-400 rounded-lg blur opacity-20 animate-pulse"></div>
                <div class="relative px-4 py-2 bg-white/80 dark:bg-gray-800/90 rounded-lg border border-gray-200/50 dark:border-gray-700/50 backdrop-blur-sm">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ now()->format('l, d F Y') }}</span>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @php
                $cards = [
                    ['label' => 'Total Siswa', 'count' => $jumlahSiswa, 'color' => 'blue', 'note' => "$persenSiswaLapor% sudah lapor PKL"],
                    ['label' => 'Total Guru', 'count' => $jumlahGuru, 'color' => 'green'],
                    ['label' => 'Total Industri', 'count' => $jumlahIndustri, 'color' => 'yellow'],
                ];

                $icons = [
                    'blue' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                    'green' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                    'yellow' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                ];
            @endphp

            @foreach($cards as $card)
                <div class="group relative overflow-hidden rounded-xl border bg-white p-6 shadow-sm transition-all hover:shadow-md dark:bg-gray-800/90 dark:border-gray-700/50 dark:hover:border-{{ $card['color'] }}-500/30">
                    <div class="absolute -right-4 -top-4 h-20 w-20 rounded-full bg-{{ $card['color'] }}-100/50 opacity-20 dark:bg-{{ $card['color'] }}-500/10"></div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-3">
                            <!-- Highlight kotak warna dengan border dan background -->
                            <div
                                class="rounded-lg border-2 border-{{ $card['color'] }}-400 bg-{{ $card['color'] }}-100/50 p-2
                                    dark:border-{{ $card['color'] }}-500
                                    dark:bg-{{ $card['color'] }}-900/30
                                    transition-colors duration-300
                                    group-hover:border-{{ $card['color'] }}-600
                                    group-hover:bg-{{ $card['color'] }}-200/70
                                    dark:group-hover:border-{{ $card['color'] }}-400
                                    dark:group-hover:bg-{{ $card['color'] }}-800/40
                                    cursor-pointer
                                ">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400
                                        transition-colors duration-300
                                        group-hover:text-{{ $card['color'] }}-800
                                        dark:group-hover:text-{{ $card['color'] }}-200"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="{{ $icons[$card['color']] }}" />
                                </svg>
                            </div>

                            <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">{{ $card['label'] }}</h2>
                        </div>
                        <p class="mt-4 text-3xl font-bold text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400">{{ $card['count'] }}</p>

                        @if (!empty($card['note']))
                            <div class="absolute bottom-1 right-1">
                                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-900/50 text-green-300">
                                    {{ $card['note'] }}
                                </span>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>



        <div class="rounded-xl border bg-white p-6 shadow-sm dark:border-gray-700/50 dark:bg-gray-800/90">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Aktivitas 7 Hari Terakhir</h2>
                <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900/30 dark:text-blue-200">
                    <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-blue-500 dark:text-blue-400" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="3" /></svg>
                    Total: {{ array_sum($chartData['counts']) }} aktivitas
                </span>
            </div>
            <div class="h-80">
                <canvas id="activityLineChart"></canvas>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border bg-white shadow-sm dark:border-gray-700/50 dark:bg-gray-800/90">
            <div class="px-6 py-4 border-b dark:border-gray-700/50">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Aktivitas Terkini</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y dark:divide-gray-700/50">
                    <thead class="bg-gray-50/50 dark:bg-gray-700/30">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pengguna</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800/90">
                        @forelse($latestActivity as $log)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-blue-100/50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 mr-3">
                                            {{ $log->created_at->format('d') }}
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $log->created_at->format('M Y') }}</div>
                                            <div class="text-xs text-gray-400 dark:text-gray-500">{{ $log->created_at->format('H:i') }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-9 w-9 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm font-medium text-gray-600 dark:text-gray-300">
                                            {{ substr($log->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $log->user->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $log->user->email ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $log->description }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-400 dark:text-gray-500">
                                    Tidak ada aktivitas terbaru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Tunggu sampai seluruh konten halaman selesai dimuat
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil context 2D dari canvas dengan id 'activityLineChart'
            const ctx = document.getElementById('activityLineChart')?.getContext('2d');
            // Jika elemen canvas tidak ditemukan, hentikan eksekusi
            if (!ctx) return;

            // Buat gradient warna untuk background garis grafik, dari semi transparan ke sangat transparan
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.3)');  
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.05)');  

            // Membuat chart baru dengan tipe 'line' (grafik garis)
            new Chart(ctx, {
                type: 'line',
                data: {
                    // Label sumbu X diambil dari data PHP yang sudah di-encode ke JSON
                    labels: @json($chartData['labels']),
                    datasets: [{
                        label: 'Jumlah Aktivitas', // Label dataset (biasanya muncul di tooltip)
                        data: @json($chartData['counts']),  // Data jumlah aktivitas di sumbu Y
                        borderColor: '#3b82f6',               // Warna garis biru
                        backgroundColor: gradient,            // Warna isi area di bawah garis menggunakan gradient
                        borderWidth: 2,                       // Ketebalan garis
                        tension: 0.4,                        // Kelengkungan garis (0 = lurus, semakin tinggi semakin melengkung)
                        fill: true,                         // Isi area di bawah garis dengan warna backgroundColor
                        pointBackgroundColor: '#fff',       // Warna titik data di dalam
                        pointBorderColor: '#3b82f6',        // Warna garis tepi titik data
                        pointBorderWidth: 2,                // Ketebalan garis tepi titik
                        pointRadius: 4,                     // Ukuran titik data
                        pointHoverRadius: 6                 // Ukuran titik saat hover (cursor mouse di atas)
                    }]
                },
                options: {
                    responsive: true,             // Grafik responsif mengikuti ukuran container
                    maintainAspectRatio: false,  // Tidak mempertahankan rasio aspek default (biar bisa flexible tinggi container)
                    scales: {
                        y: {
                            beginAtZero: true,  // Sumbu Y mulai dari 0
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',  // Warna garis grid sumbu Y (sangat terang)
                                drawBorder: false              // Tidak menampilkan garis tepi pada sumbu Y
                            },
                            ticks: {
                                stepSize: 1                 // Langkah nilai pada sumbu Y naik 1 per satuan
                            }
                        },
                        x: {
                            grid: {
                                display: false,            // Tidak menampilkan grid garis di sumbu X
                                drawBorder: false          // Tidak menampilkan garis tepi pada sumbu X
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false   // Tidak menampilkan legenda di grafik (karena cuma 1 dataset)
                        },
                        tooltip: {
                            backgroundColor: 'rgba(17, 24, 39, 0.9)',  // Warna latar tooltip gelap transparan
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            },
                            padding: 12,            // Jarak dalam tooltip
                            usePointStyle: true,    // Menggunakan titik kecil sebagai ikon di tooltip
                            callbacks: {
                                // Format label tooltip, misal: "5 aktivitas"
                                label: function(context) {
                                    return `${context.parsed.y} aktivitas`;
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,  // Tooltip muncul saat kursor mendekati titik data, tidak harus tepat di titik
                        mode: 'index'      // Tooltip tampil berdasarkan posisi index X (menunjukkan semua dataset di posisi X)
                    }
                }
            });
        });
    </script>

</x-layouts.app>