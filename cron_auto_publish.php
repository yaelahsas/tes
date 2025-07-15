<?php
/**
 * Cron Job untuk Auto-Publish Artikel Terjadwal
 * 
 * Jalankan file ini setiap hari pada jam yang diinginkan
 * Contoh crontab: 0 8 * * * /usr/bin/php /path/to/your/project/cron_auto_publish.php
 * (Akan dijalankan setiap hari jam 8 pagi)
 */

// Method 1: Via URL (Recommended)
$base_url = "http://localhost/rsud"; // Sesuaikan dengan URL website Anda
$secret_key = "rsud_cron_2024"; // Secret key untuk keamanan

$url = $base_url . "/cron/auto_publish?key=" . $secret_key;
$result = file_get_contents($url);
echo $result;

// Method 2: Via cURL (Alternative)
/*
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $base_url . "/cron/auto_publish?key=" . $secret_key,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);

if ($http_code == 200) {
    echo $response;
} else {
    echo "Error: HTTP $http_code\n";
}
*/

// Method 3: Test tanpa mengubah data
// $test_url = $base_url . "/cron/test?key=" . $secret_key;
// echo file_get_contents($test_url);
