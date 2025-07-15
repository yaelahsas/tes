<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cron extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// Tidak ada check_not_login() agar bisa diakses tanpa login
		$this->load->model('Artikel_model');
		
		// Security: hanya bisa diakses dari localhost atau server internal
		$allowed_ips = array('127.0.0.1', '::1', 'localhost');
		if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips) && !$this->input->get('key')) {
			// Jika bukan dari localhost, cek secret key
			$secret_key = 'rsud_cron_2024'; // Ganti dengan key yang aman
			if ($this->input->get('key') !== $secret_key) {
				show_404();
				return;
			}
		}
	}

	// Method untuk auto-publish artikel (dipanggil via cron job)
	public function auto_publish()
	{
		$published_count = $this->Artikel_model->auto_publish_scheduled_articles();
		
		$message = date('Y-m-d H:i:s') . " - ";
		if ($published_count > 0) {
			$message .= "Published $published_count articles successfully.";
		} else {
			$message .= "No articles to publish today.";
		}
		
		// Log ke file untuk tracking
		$this->log_cron_activity($message);
		
		// Output untuk cron job
		echo $message . "\n";
	}

	// Method untuk cek artikel yang akan dipublish hari ini
	public function check_scheduled()
	{
		$today = date('Y-m-d');
		
		$this->db->where('status', 'scheduled');
		$this->db->where('tanggal_publish', $today);
		$articles = $this->db->get('artikel')->result();
		
		$message = date('Y-m-d H:i:s') . " - Found " . count($articles) . " articles scheduled for today ($today)";
		
		foreach ($articles as $article) {
			$message .= "\n- " . $article->judul . " (ID: " . $article->id . ")";
		}
		
		$this->log_cron_activity($message);
		echo $message . "\n";
	}

	// Method untuk log aktivitas cron
	private function log_cron_activity($message)
	{
		$log_file = APPPATH . 'logs/cron_auto_publish.log';
		
		// Buat direktori logs jika belum ada
		if (!is_dir(APPPATH . 'logs')) {
			mkdir(APPPATH . 'logs', 0755, true);
		}
		
		// Tulis log
		file_put_contents($log_file, $message . "\n", FILE_APPEND | LOCK_EX);
	}

	// Method untuk test cron (tanpa mengubah data)
	public function test()
	{
		$today = date('Y-m-d');
		
		$this->db->where('status', 'scheduled');
		$this->db->where('tanggal_publish <=', $today);
		$articles = $this->db->get('artikel')->result();
		
		$message = "CRON TEST - " . date('Y-m-d H:i:s') . "\n";
		$message .= "Found " . count($articles) . " articles ready to publish:\n";
		
		foreach ($articles as $article) {
			$message .= "- " . $article->judul . " (scheduled: " . $article->tanggal_publish . ")\n";
		}
		
		echo $message;
	}
}
