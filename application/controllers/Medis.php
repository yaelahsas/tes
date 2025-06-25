<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dokter_model', 'M_dokter');
        $this->load->helper('url');
        // $this->load->library('input');
    }

    public function index()
    {
        $spesialisasi_filter = $this->input->get('spesialisasi');

        if ($spesialisasi_filter) {
            $dokter_list = $this->M_dokter->get_by_spesialisasi($spesialisasi_filter);
        } else {
            $dokter_list = $this->M_dokter->get_all();
        }

        $data = [
            'title' => 'Tim Dokter Spesialis | RSUD Genteng Banyuwangi',
            'description' => 'Daftar lengkap dokter spesialis RSUD Genteng Banyuwangi dengan jadwal praktik dan spesialisasi. Temukan dokter spesialis terbaik untuk kebutuhan kesehatan Anda.',
            'keywords' => 'dokter spesialis Genteng, dokter RSUD Genteng, spesialis Banyuwangi, jadwal dokter RSUD',
            'dokter' => $dokter_list,
            'spesialisasi' => $this->M_dokter->get_all_spesialisasi(),
            'selected_spesialis' => $spesialisasi_filter
        ];

        $this->load->view('frontend/_layouts/header', $data);
        $this->load->view('frontend/dokter/index', $data);
        $this->load->view('frontend/_layouts/footer');
    }

    public function detail($id)
    {
        // Redirect to coming soon page instead of showing detail
              $this->load->view('coming_soon');

    }

    public function coming_soon()
    {
        // Load the standalone coming soon view
        $this->load->view('coming_soon');
    }
}
