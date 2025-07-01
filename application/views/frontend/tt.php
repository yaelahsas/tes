<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Informasi Ketersediaan Tempat Tidur - RSUD Genteng Banyuwangi</title>
    <meta name="description" content="Lihat informasi ketersediaan tempat tidur di RSUD Genteng Banyuwangi secara real-time. Data lengkap dan akurat untuk pasien." />
    <meta name="keywords" content="tempat tidur, ketersediaan tempat tidur, RSUD Genteng, rumah sakit Banyuwangi, bed availability" />
    <meta name="author" content="RSUD Genteng Banyuwangi" />
    <meta name="robots" content="index, follow" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans p-6">
    <main class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-10 text-blue-700">Informasi Ketersediaan Tempat Tidur</h1>

        <?php if (!empty($bed_data) && isset($bed_data['totalKamar'])) : ?>
            <section aria-label="Ringkasan Ketersediaan Tempat Tidur" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-blue-600 text-white rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-blue-700 transition">
                    <h2 class="text-5xl font-extrabold mb-2"><?php echo htmlspecialchars($bed_data['totalKamar']); ?></h2>
                    <p class="text-lg font-semibold">Total Kamar</p>
                </div>
                <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-blue-600 transition">
                    <h2 class="text-5xl font-extrabold mb-2"><?php echo htmlspecialchars($bed_data['totalBed']); ?></h2>
                    <p class="text-lg font-semibold">Total Tempat Tidur</p>
                </div>
                <div class="bg-red-600 text-white rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-red-700 transition">
                    <h2 class="text-5xl font-extrabold mb-2"><?php echo htmlspecialchars($bed_data['totalIsi']); ?></h2>
                    <p class="text-lg font-semibold">Tempat Tidur Terisi</p>
                </div>
                <div class="bg-green-600 text-white rounded-lg shadow-lg p-6 flex flex-col items-center hover:bg-green-700 transition">
                    <h2 class="text-5xl font-extrabold mb-2"><?php echo htmlspecialchars($bed_data['totalKosong']); ?></h2>
                    <p class="text-lg font-semibold">Tempat Tidur Kosong</p>
                </div>
            </section>

            <section aria-label="Detail Ketersediaan Tempat Tidur per Ruangan" class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th scope="col" class="text-left py-3 px-6">Nama Ruangan</th>
                            <th scope="col" class="text-center py-3 px-6">Total Tempat Tidur</th>
                            <th scope="col" class="text-center py-3 px-6">Tempat Tidur Terisi</th>
                            <th scope="col" class="text-center py-3 px-6">Tempat Tidur Kosong</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bed_data['tt'] as $room) : ?>
                            <tr class="border-b hover:bg-gray-100">
                                <td class="text-left py-4 px-6 font-medium text-gray-900"><?php echo htmlspecialchars($room['namaruangan']); ?></td>
                                <td class="text-center py-4 px-6"><?php echo htmlspecialchars($room['bed']); ?></td>
                                <td class="text-center py-4 px-6 text-red-600 font-semibold"><?php echo htmlspecialchars($room['isi']); ?></td>
                                <td class="text-center py-4 px-6 text-green-600 font-semibold"><?php echo htmlspecialchars($room['kosong']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php else : ?>
            <p class="text-center text-red-600 font-semibold">Data ketersediaan tempat tidur tidak tersedia saat ini.</p>
        <?php endif; ?>
    </main>
</body>

</html>
