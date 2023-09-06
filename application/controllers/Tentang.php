<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tentang extends CI_Controller
{

	public function struktur_organisasi()
	{

		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/tentang/struktur');
		$this->load->view('frontend/_layouts/footer');
	}
}
