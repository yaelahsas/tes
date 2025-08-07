<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Chat Dayun - RSUD Genteng</title>
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
                        <i class="fas fa-comments text-blue-600 mr-3"></i>
                        Riwayat Chat Dayun
                    </h1>
                    <p class="text-gray-600 mt-2">Kelola dan pantau percakapan chat Dayun RSUD Genteng</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Terakhir diperbarui</p>
                    <p class="text-lg font-semibold text-gray-800"><?= $current_date ?></p>
                </div>
            </div>
        </div>

        <!-- Chat Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Messages -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pesan (30 hari)</p>
                        <p class="text-3xl font-bold text-blue-600"><?= number_format($chat_stats['total_messages']) ?></p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-envelope text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Sessions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Sesi Chat</p>
                        <p class="text-3xl font-bold text-green-600"><?= number_format($chat_stats['total_sessions']) ?></p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- User Messages -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pesan User</p>
                        <?php 
                        $user_messages = 0;
                        foreach($chat_stats['messages_by_type'] as $type) {
                            if($type->message_type == 'user') $user_messages = $type->count;
                        }
                        ?>
                        <p class="text-3xl font-bold text-purple-600"><?= number_format($user_messages) ?></p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-user text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- AI Responses -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Respon AI</p>
                        <?php 
                        $ai_messages = 0;
                        foreach($chat_stats['messages_by_type'] as $type) {
                            if($type->message_type == 'ai') $ai_messages = $type->count;
                        }
                        ?>
                        <p class="text-3xl font-bold text-orange-600"><?= number_format($ai_messages) ?></p>
                    </div>
                    <div class="bg-orange-100 p-3 rounded-full">
                        <i class="fas fa-robot text-orange-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <!-- Search Box -->
                <div class="flex-1 lg:mr-4">
                    <div class="relative">
                        <input 
                            type="text" 
                            id="searchInput" 
                            placeholder="Cari pesan..." 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Session Filter -->
                <div class="lg:ml-4">
                    <select id="sessionFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Sesi</option>
                        <?php if (!empty($recent_sessions)): ?>
                            <?php foreach ($recent_sessions as $session): ?>
                                <option value="<?= $session->session_id ?>" <?= ($selected_session == $session->session_id) ? 'selected' : '' ?>>
                                    <?= substr($session->session_id, 0, 20) ?>... (<?= $session->message_count ?> pesan)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Recent Sessions -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-clock text-green-600 mr-2"></i>
                Sesi Chat Terbaru
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pesan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (!empty($recent_sessions)): ?>
                            <?php foreach ($recent_sessions as $session): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded">
                                            <?= substr($session->session_id, 0, 25) ?>...
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= number_format($session->message_count) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('d M Y H:i', strtotime($session->first_message)) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= date('d M Y H:i', strtotime($session->last_message)) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="?session_id=<?= $session->session_id ?>" 
                                           class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada sesi chat
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Chat History -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">
                    <i class="fas fa-history text-gray-600 mr-2"></i>
                    Riwayat Percakapan
                    <?php if ($selected_session): ?>
                        <span class="text-sm font-normal text-gray-500">
                            - Session: <?= substr($selected_session, 0, 20) ?>...
                        </span>
                    <?php endif; ?>
                </h3>
                <div class="text-sm text-gray-500">
                    Total: <?= number_format($total_messages) ?> pesan
                </div>
            </div>
            
            <div id="chatHistoryContainer" class="space-y-4 max-h-96 overflow-y-auto border rounded-lg p-4 bg-gray-50">
                <?php if (!empty($chat_history)): ?>
                    <?php foreach ($chat_history as $message): ?>
                        <div class="flex <?= $message->message_type == 'user' ? 'justify-end' : 'justify-start' ?>">
                            <div class="max-w-xs lg:max-w-md">
                                <?php if ($message->message_type == 'user'): ?>
                                    <div class="bg-blue-600 text-white rounded-lg shadow-sm p-3">
                                        <p class="text-sm"><?= htmlspecialchars($message->message_content) ?></p>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="text-xs text-blue-100">User</span>
                                            <span class="text-xs text-blue-200">
                                                <?= date('H:i', strtotime($message->created_at)) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="bg-white rounded-lg shadow-sm p-3 border">
                                        <div class="text-gray-800 text-sm">
                                            <?= nl2br(htmlspecialchars($message->ai_response ?: $message->message_content)) ?>
                                        </div>
                                        <div class="flex items-center justify-between mt-2">
                                            <span class="text-xs text-gray-500">
                                                <?= $message->is_successful ? 'AI Assistant' : 'System Error' ?>
                                            </span>
                                            <span class="text-xs text-gray-400">
                                                <?= date('H:i', strtotime($message->created_at)) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center text-gray-500 py-8">
                        <i class="fas fa-comments text-4xl mb-4"></i>
                        <p>Belum ada riwayat chat</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_messages > $limit): ?>
                <div class="flex items-center justify-between mt-6">
                    <div class="text-sm text-gray-500">
                        Menampilkan <?= $current_offset + 1 ?> - <?= min($current_offset + $limit, $total_messages) ?> dari <?= number_format($total_messages) ?> pesan
                    </div>
                    <div class="flex space-x-2">
                        <?php if ($current_offset > 0): ?>
                            <a href="?offset=<?= max(0, $current_offset - $limit) ?><?= $selected_session ? '&session_id=' . $selected_session : '' ?>" 
                               class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                <i class="fas fa-chevron-left"></i> Sebelumnya
                            </a>
                        <?php endif; ?>
                        
                        <?php if ($current_offset + $limit < $total_messages): ?>
                            <a href="?offset=<?= $current_offset + $limit ?><?= $selected_session ? '&session_id=' . $selected_session : '' ?>" 
                               class="px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Selanjutnya <i class="fas fa-chevron-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Daily Chat Activity Chart -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">
                <i class="fas fa-chart-line text-green-600 mr-2"></i>
                Aktivitas Chat Harian (30 Hari Terakhir)
            </h3>
            <div class="h-64">
                <canvas id="chatActivityChart"></canvas>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between items-center">
            <a href="<?= base_url('dayun') ?>" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Chat
            </a>
            
            <a href="<?= base_url('dayun/admin_stats') ?>" 
               class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                <i class="fas fa-chart-bar mr-2"></i>
                Lihat Statistik
            </a>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const messages = document.querySelectorAll('#chatHistoryContainer > div');
            
            messages.forEach(message => {
                const text = message.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    message.style.display = 'flex';
                } else {
                    message.style.display = 'none';
                }
            });
        });

        // Session filter
        document.getElementById('sessionFilter').addEventListener('change', function(e) {
            const sessionId = e.target.value;
            if (sessionId) {
                window.location.href = '?session_id=' + sessionId;
            } else {
                window.location.href = '<?= base_url('dayun/admin_chat_history') ?>';
            }
        });

        // Prepare chart data
        const chartData = {
            labels: [
                <?php if (!empty($chat_stats['daily_counts'])): ?>
                    <?php foreach ($chat_stats['daily_counts'] as $day): ?>
                        '<?= date('d/m', strtotime($day->date)) ?>',
                    <?php endforeach; ?>
                <?php endif; ?>
            ],
            datasets: [{
                label: 'Jumlah Pesan',
                data: [
                    <?php if (!empty($chat_stats['daily_counts'])): ?>
                        <?php foreach ($chat_stats['daily_counts'] as $day): ?>
                            <?= $day->count ?>,
                        <?php endforeach; ?>
                    <?php endif; ?>
                ],
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        };

        // Create chart
        const ctx = document.getElementById('chatActivityChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Aktivitas Chat Harian'
                    },
                    legend: {
                        display: false
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

        // Auto-scroll to bottom of chat history
        const chatContainer = document.getElementById('chatHistoryContainer');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    </script>
</body>
</html>
