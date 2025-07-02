<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

use LZCompressor\LZString;

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// check_admin_1();
		// check_not_login();
		$this->load->model('User_model');
		$this->load->model('Artikel_model');
		$this->load->model('Home_model');
		$this->load->model('Review_model');
		$this->load->library('form_validation');
		$this->load->model('Pengunjung_model');
		$this->load->library('datatables');
		$this->load->library('bpjs');
		$this->load->model('Dokter_model', 'M_dokter');
		$this->load->model('Jadwal_dokter_model', 'M_jadwal');
		$this->load->helper('url');
	}


	public function index()
	{
		$artikel = $this->Artikel_model->get_new();

		// Prepare dynamic SEO meta tags
		$seo_title = "RSUD Genteng Banyuwangi - Pelayanan Kesehatan Terpadu dan Terbaik di Banyuwangi";
		$seo_description = "Rumah sakit umum daerah terbaik di Banyuwangi yang memberikan pelayanan kesehatan terpadu dengan dokter spesialis berpengalaman. Melayani 24 jam untuk keadaan darurat.";
		$seo_keywords = "RSUD Genteng Banyuwangi, rumah sakit Banyuwangi, rumah sakit umum daerah Banyuwangi, dokter spesialis Banyuwangi, IGD 24 jam, pelayanan kesehatan Genteng Banyuwangi, RSUD Genteng";
		$seo_image = base_url('assets/front/img/rs_malam.jpg');
		$seo_url = current_url();

		$data  = array(
			'dokters' => $this->Home_model->get_dokter(),
			'artikel' => $artikel,
			'galeri' => $this->Home_model->get_galeri(),
			'profil' => $this->Home_model->get_profil(),
			'layanan' => $this->Home_model->get_layanan(),
			// SEO meta tags
			'seo_title' => $seo_title,
			'seo_description' => $seo_description,
			'seo_keywords' => $seo_keywords,
			'seo_image' => $seo_image,
			'seo_url' => $seo_url,
			// Conditional resource flags
			'page_needs_gallery' => true, // For Swiper and GLightbox
			'page_needs_instagram' => true, // For Instagram embeds
			'page_needs_fontawesome' => true // For FontAwesome icons
		);
		$this->load->view('frontend/_layouts/header', $data);
		$this->load->view('frontend/index', $data);
		$this->load->view('frontend/_layouts/footer');
	}
	public function reg()
	{
		$data = array(
			'page_needs_fontawesome' => true
		);
		$this->load->view('frontend/_layouts/header', $data);

		$this->load->view('frontend/regonline');
		$this->load->view('frontend/_layouts/footer');
	}



	public function tempat_tidur()
	{
		$json_data = $this->aw();
		$bed_data = json_decode($json_data, true);
		$data['bed_data'] = $bed_data;
		$this->load->view('frontend/tt', $data);
	}
	public function pengaduan()
	{
		$this->load->view('frontend/_layouts/header');

		$this->load->view('frontend/pengaduan');
		$this->load->view('frontend/_layouts/footer');
	}
	public function jadwal_dokter()
	{
		$spesialisasi_filter = $this->input->get('spesialisasi');

		if ($spesialisasi_filter) {
			$dokter_list = $this->M_dokter->get_by_spesialisasi($spesialisasi_filter);
		} else {
			$dokter_list = $this->M_dokter->get_all();
		}

		$dokter_with_schedules = [];
		foreach ($dokter_list as $dokter) {
			$this->db->select('hari, jam_mulai, jam_selesai');
			$this->db->where('dokter_id', $dokter->id);
			$this->db->order_by('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")');
			$schedules = $this->db->get('jadwal_dokter')->result();

			$poli = $this->M_dokter->get_poli_by_dokter($dokter->id);

			// Group hari berdasarkan jam yang sama
			$grouped = []; // key: "jam_mulai|jam_selesai" => [hari]
			foreach ($schedules as $s) {
				$key = $s->jam_mulai . '|' . $s->jam_selesai;
				if (!isset($grouped[$key])) {
					$grouped[$key] = [];
				}
				$grouped[$key][] = $s->hari;
			}

			// Bentuk array akhir
			$grouped_schedules = [];
			foreach ($grouped as $jam_key => $hari_list) {
				list($jam_mulai, $jam_selesai) = explode('|', $jam_key);
				$grouped_schedules[] = [
					'hari_list' => $hari_list,
					'jam_mulai' => $jam_mulai,
					'jam_selesai' => $jam_selesai
				];
			}

			$dokter->poli = $poli ? $poli->nama_poli : '-';
			$dokter->jadwal = $grouped_schedules;
			$dokter_with_schedules[] = $dokter;
		}

		$data = [
			'title' => 'Jadwal Dokter Spesialis RSUD Genteng Banyuwangi | Informasi Lengkap dan Terbaru',
			'description' => 'Lihat jadwal praktik dokter spesialis RSUD Genteng Banyuwangi. Informasi lengkap tentang nama dokter, hari dan jam praktik, serta spesialisasi di RSUD Genteng.',
			'keywords' => 'jadwal dokter RSUD Genteng, jadwal dokter Banyuwangi, dokter spesialis Banyuwangi, jadwal praktik dokter Genteng, dokter RSUD Genteng terbaru, jadwal dokter umum Banyuwangi, rumah sakit genteng jadwal dokter, informasi dokter RSUD Genteng Banyuwangi, dokter spesialis anak genteng, dokter penyakit dalam Banyuwangi, jadwal praktek dokter RSUD Genteng Banyuwangi',
			'dokter' => $dokter_with_schedules,
			'spesialisasi' => $this->M_dokter->get_all_spesialisasi(),
			'selected_spesialis' => $spesialisasi_filter,
		];


		$this->load->view('frontend/_layouts/header', $data);
		$this->load->view('frontend/dokter/index', $data);
		$this->load->view('frontend/_layouts/footer');
	}

	public function maklumat()
	{
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/maklumat');
		$this->load->view('frontend/_layouts/footer');
	}
	public function wbs()
	{
		$this->load->view('frontend/wbs');
	}
	public function form_wbs()
	{
		$this->load->view('frontend/form_wbs');
	}
	public function aw()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://rsudgenteng.id:8888/service/medifirst2000/kiosk/get-view-bed-tea',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'X-Auth-Token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiIyNTAzNjAifQ.Lx3QCGK7BiZmz6jN5avphtXFn9upKcnYKBDdQHWddG1k_67FoaGs88f_PdmfoNfFkTMUg5HW-TDDr2rXjw4EnA',
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);


		return $response;
	}
	public function inovasi()
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
		$totalnya = $this->Pengunjung_model->get_total_views();
		$data = array(
			'totalnya' => $totalnya,
			'inovasi' => 'benefit',
			'page_needs_fontawesome' => true
		);

		$this->load->view('frontend/_layouts/header', $data);
		$this->load->view('frontend/inovasi/index', $data);
		$this->load->view('frontend/_layouts/footer');
	}
	public function kartini()
	{
		$data = array(
			'inovasi' => "kartini",
		);
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/inovasi/kartini', $data);
		$this->load->view('frontend/_layouts/footer');
	}
	public function speed()
	{
		$data = array(
			'inovasi' => "speed",
		);
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/inovasi/speed', $data);
		$this->load->view('frontend/_layouts/footer');
	}
	public function hostren()
	{
		$data = array(
			'inovasi' => "hostren",
		);
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/inovasi/hostren', $data);
		$this->load->view('frontend/_layouts/footer');
	}
	public function panah()
	{
		$data = array(
			'inovasi' => "panah",
		);
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/inovasi/panah', $data);
		$this->load->view('frontend/_layouts/footer');
	}
	public function hd()
	{
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/inovasi/hd');
		$this->load->view('frontend/_layouts/footer');
	}

	public function kelas_butik()
	{
		$data['redirect_url'] = 'https://linktr.ee/KelasButik'; // URL tujuan
		$this->load->view('frontend/redirect', $data);
	}

	public function tambah_review()
	{
		header('Content-Type: application/json');
		$tulisan = $this->input->post('tulisan');
		$bintang = $this->input->post('bintang');
		$inovasi = $this->input->post('inovasi');
		$tanggal = $this->input->post('tanggal');

		// Cek apakah semua parameter sudah diisi
		if (empty($tulisan) || empty($bintang) || empty($inovasi) || empty($tanggal)) {
			echo json_encode(['message' => 'Incomplete parameters']);
			return;
		}

		$this->Review_model->add_review($tulisan, $bintang, $inovasi, $tanggal);

		echo json_encode(['message' => 'Review added successfully']);
	}


	public function ambil_review()
	{
		header('Content-Type: application/json');
		$inovasi = $this->input->get('inovasi');

		$reviews = $this->Review_model->get_reviews($inovasi);
		echo json_encode($reviews);
	}
}
