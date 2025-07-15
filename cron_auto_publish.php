<?php
/**
 * Cron Job untuk Auto-Publish Artikel Terjadwal
 * 
 * Jalankan file ini setiap hari pada jam yang diinginkan
 * Contoh crontab: 0 8 * * * /usr/bin/php /path/to/your/project/cron_auto_publish.php
 * (Akan dijalankan setiap hari jam 8 pagi)
 */

// Set path ke CodeIgniter
define('BASEPATH', TRUE);
$system_path = 'system';
$application_folder = 'application';

// Path ke index.php
$_SERVER['REQUEST_URI'] = '/artikel/auto_publish';
$_SERVER['HTTP_HOST'] = 'localhost';

// Include CodeIgniter
require_once 'index.php';

// Atau alternatif, panggil langsung via URL
// $url = "http://localhost/rsud/artikel/auto_publish";
// $result = file_get_contents($url);
// echo $result;
