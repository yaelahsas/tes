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
		$data['isi'] = $this->aw();
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
		$data = array(
			'page_needs_fontawesome' => true
		);
		$this->load->view('frontend/_layouts/header', $data);
		$this->load->view('frontend/jadwal_dokter');
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
			CURLOPT_URL => 'https://yankes.kemkes.go.id/app/siranap/tempat_tidur?kode_rs=3510043&jenis=2&propinsi=35prop&kabkota=3510',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
				'Cookie: TS01311a88=0172bf5c62d835e85e667de81afe4b870c94fb39bb7c303f8100a487b727d939c5cb22e231f6d28daf632541825ee6512dae3b9553; TS01311a88028=015463a1a801994557d80964660bad585e94f77ccd651e70812e458717aa5de41b59babd1c9bad9af3e9e0d70748ed4e1c24e69fbb'
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
		$this->load->view('frontend/redirect',$data);

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
