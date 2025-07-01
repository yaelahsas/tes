<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dokter_model', 'M_dokter');
        $this->load->model('Jadwal_dokter_model', 'M_jadwal');
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
        'title' => 'Tim Dokter Spesialis | RSUD Genteng Banyuwangi',
        'description' => 'Daftar lengkap dokter spesialis RSUD Genteng Banyuwangi dengan jadwal praktik dan spesialisasi.',
        'keywords' => 'dokter spesialis Genteng, dokter RSUD Genteng, spesialis Banyuwangi',
        'dokter' => $dokter_with_schedules,
        'spesialisasi' => $this->M_dokter->get_all_spesialisasi(),
        'selected_spesialis' => $spesialisasi_filter,
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
