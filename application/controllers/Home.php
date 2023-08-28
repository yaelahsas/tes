<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

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
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}


	public function index()
	{
		$artikel = $this->Artikel_model->get_new();

		// $data['artikel'] = $artikel;
		$data  = array(
			'dokters' => $this->Home_model->get_dokter(),
			'artikel' => $artikel,
			'galeri' => $this->Home_model->get_galeri(),
			'profil' => $this->Home_model->get_profil(),
			'layanan' => $this->Home_model->get_layanan()
		);
		// var_dump($data['layanan']);
		// die;
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/index', $data);
		$this->load->view('frontend/_layouts/footer');
	}
	public function reg()
	{
		$this->load->view('frontend/_layouts/header');

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
		$this->load->view('frontend/pengaduan');
	}
	public function jadwal_dokter()
	{
		$this->load->view('frontend/jadwal_dokter');
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
}
