<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengunjung extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pengunjung_model');
	}

	public function index()
	{
		$date = date('Y-m-d');
		$view_data = $this->Pengunjung_model->get_pengunjung_by_date($date);

		if ($view_data) {
			// Jika data sudah ada, tambahkan count
			$this->Pengunjung_model->update_pengunjung($date);
		} else {
			// Jika belum ada data, buat data baru dengan count = 1
			$this->Pengunjung_model->insert_pengunjung($date);
		}

		$this->load->view('welcome_message');
	}

	public function monthly_recap($month, $year)
	{
		$monthly_pengunjung = $this->Pengunjung_model->get_monthly_recap($month, $year);
		$data['month'] = $month;
		$data['year'] = $year;
		$data['pengunjung'] = $monthly_pengunjung;

		$this->load->view('monthly_recap', $data);
	}
	public function generate_data()
	{
		$data = array();

		// Data untuk tahun 2023
		for ($month = 1; $month <= 12; $month++) {
			$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, 2023);
			for ($day = 1; $day <= $days_in_month; $day++) {
				$date = sprintf('2023-%02d-%02d', $month, $day);
				$data[] = array(
					'date' => $date,
					'month' => $month,
					'year' => 2023,
					'count' => 0
				);
			}
		}

		// Data untuk Januari hingga Juni 2024
		for ($month = 1; $month <= 6; $month++) {
			$days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, 2024);
			for ($day = 1; $day <= $days_in_month; $day++) {
				$date = sprintf('2024-%02d-%02d', $month, $day);
				$data[] = array(
					'date' => $date,
					'month' => $month,
					'year' => 2024,
					'count' => 0
				);
			}
		}

		// Masukkan data ke dalam database
		$this->Pengunjung_model->insert_batch_views($data);

		echo "Data generated and inserted successfully!";
	}

	public function total()
	{
		$totalnya = $this->Pengunjung_model->get_total_views();
		$data['total'] = $totalnya;
		echo "Total views = " . $totalnya;
	}
}
