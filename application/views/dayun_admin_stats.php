<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Penggunaan Dayun - RSUD Genteng</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-chart-bar text-blue-600 mr-3"></i>
                        Statistik Penggunaan Dayun
                    </h1>
                    <p class="text-gray-600 mt-2">Dashboard analitik penggunaan aplikasi chat Dayun RSUD Genteng</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Terakhir diperbarui</p>
                    <p class="text-lg font-semibold text-gray-800"><?= $current_date ?></p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Today's Page Visits -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Kunjungan Hari Ini</p>
                        <p class="text-3xl font-bold text-blue-600"><?= number_format($today_stats['page_visits']) ?></p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-eye text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Today's Messages -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pesan Hari Ini</p>
                        <p class="text-3xl font-bold text-green-600"><?= number_format($today_stats['message_count']) ?></p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-comments text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Page Visits -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Kunjungan</p>
                        <p class="text-3xl font-bold text-purple-600"><?= number_format($total_page_visits) ?></p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-users text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Messages -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pesan</p>
                        <p class="text-3xl font-bold text-orange-600"><?= number_format($total_messages) ?></p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="fas fa-envelope text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Statistics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Current Month Stats -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                    Statistik Bulan <?= $current_month ?>
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-4 bg-blue-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-eye text-blue-600 mr-3"></i>
                            <span class="font-medium text-gray-700">Kunjungan Halaman</span>
                        </div>
                        <span class="text-2xl font-bold text-blue-600"><?= number_format($current_month_visits) ?></span>
                    </div>
                    <div class="flex justify-between items-center p-4 bg-green-50 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-comments text-green-600 mr-3"></i>
                            <span class="font-medium text-gray-700">Pesan Dikirim</span>
                        </div>
                        <span class="text-2xl font-bold text-green-600"><?= number_format($current_month_messages) ?></span>
                    </div>
                </div>
            </div>

            <!-- Usage Ratio -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">
                    <i class="fas fa-chart-pie text-purple-600 mr-2"></i>
                    Rasio Penggunaan
                </h3>
                <div class="space-y-4">
                    <?php 
                    $engagement_rate = $total_page_visits > 0 ? ($total_messages / $total_page_visits) * 100 : 0;
                    $avg_messages_per_visit = $total_page_visits > 0 ? $total_messages / $total_page_visits : 0;
                    ?>
                    <div class="p-4 bg-purple-50 rounded-lg">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-medium text-gray-700">Tingkat Engagement</span>
                            <span class="text-lg font-bold text-purple-600"><?= number_format($engagement_rate, 1) ?>%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: <?= min($engagement_rate, 100) ?>%"></div>
                        </div>
                    </div>
                    <div class="p-4 bg-orange-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="font-medium text-gray-700">Rata-rata Pesan per Kunjungan</span>
                            <span class="text-lg font-bold text-orange-600"><?= number_format($avg_messages_per_visit, 1) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Usage Chart -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-chart-line text-green-600 mr-2"></i>
                Tren Penggunaan 30 Hari Terakhir
            </h3>
            <div class="h-96">
                <canvas id="usageChart"></canvas>
            </div>
        </div>

        <!-- Recent Usage Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-table text-gray-600 mr-2"></i>
                Data Penggunaan Terbaru
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kunjungan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rasio</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($recent_usage)): ?>
                            <?php foreach (array_slice($recent_usage, 0, 10) as $usage): ?>
                                <?php $ratio = $usage->page_visits > 0 ? ($usage->message_count / $usage->page_visits) : 0; ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= date('d M Y', strtotime($usage->date)) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= number_format($usage->page_visits) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <?= number_format($usage->message_count) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= number_format($ratio, 2) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data penggunaan
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="<?= base_url('dayun') ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Dayun Chat
            </a>
        </div>
    </div>

    <script>
        // Prepare data for chart
        const chartData = {
            labels: [
                <?php if (!empty($recent_usage)): ?>
                    <?php foreach ($recent_usage as $usage): ?>
                        '<?= date('d/m', strtotime($usage->date)) ?>',
                    <?php endforeach; ?>
                <?php endif; ?>
            ],
            datasets: [
                {
                    label: 'Kunjungan Halaman',
                    data: [
                        <?php if (!empty($recent_usage)): ?>
                            <?php foreach ($recent_usage as $usage): ?>
                                <?= $usage->page_visits ?>,
                            <?php endforeach; ?>
                        <?php endif; ?>
                    ],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Pesan Dikirim',
                    data: [
                        <?php if (!empty($recent_usage)): ?>
                            <?php foreach ($recent_usage as $usage): ?>
                                <?= $usage->message_count ?>,
                            <?php endforeach; ?>
                        <?php endif; ?>
                    ],
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4
                }
            ]
        };

        // Create chart
        const ctx = document.getElementById('usageChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Tren Penggunaan Dayun'
                    },
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
