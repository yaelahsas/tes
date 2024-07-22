<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// check_admin_1();
		// check_not_login();

		$this->load->model('Home_model');
		$this->load->library('datatables');
	}
	public function dokter()
	{
		$data  = array(
			'dokters' => $this->Home_model->get_dokter(),
		);
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/dokter/index', $data);
		$this->load->view('frontend/_layouts/footer');
	}
}
