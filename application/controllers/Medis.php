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

        $service_hours = $this->M_jadwal->get_service_hours();
   
        // Get schedules for each doctor
        $dokter_with_schedules = [];
        foreach ($dokter_list as $dokter) {
            $this->db->select('hari, jam_mulai, jam_selesai');
            $this->db->where('dokter_id', $dokter->id);
            $this->db->order_by('FIELD(hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")');
            $schedules = $this->db->get('jadwal_dokter')->result();
            $poli = $this->M_dokter->get_poli_by_dokter($dokter->id);
            // Group schedules by time if days are consecutive
            $grouped_schedules = [];
            $current_group = null;
            
            foreach ($schedules as $schedule) {
                if ($current_group && 
                    $current_group['jam_mulai'] == $schedule->jam_mulai && 
                    $current_group['jam_selesai'] == $schedule->jam_selesai) {
                    // Add to current group
                    $current_group['hari_akhir'] = $schedule->hari;
                } else {
                    // Start new group
                    if ($current_group) {
                        $grouped_schedules[] = $current_group;
                    }
                    $current_group = [
                        'hari_awal' => $schedule->hari,
                        'hari_akhir' => $schedule->hari,
                        'jam_mulai' => $schedule->jam_mulai,
                        'jam_selesai' => $schedule->jam_selesai
                    ];
                }
            }
            
            // Add last group
            if ($current_group) {
                $grouped_schedules[] = $current_group;
            }
			
			$dokter->poli = $poli ? $poli->nama_poli : '-';
            $dokter->jadwal = $grouped_schedules;
            $dokter_with_schedules[] = $dokter;
        }

        $data = [
            'title' => 'Tim Dokter Spesialis | RSUD Genteng Banyuwangi',
            'description' => 'Daftar lengkap dokter spesialis RSUD Genteng Banyuwangi dengan jadwal praktik dan spesialisasi. Temukan dokter spesialis terbaik untuk kebutuhan kesehatan Anda. Jadwal dokter RSUD Genteng Banyuwangi. ',
            'keywords' => 'dokter spesialis Genteng, dokter RSUD Genteng, spesialis Banyuwangi, jadwal dokter RSUD Genteng, jadwal dokter genteng, dokter umum Genteng, dokter spesialis umum, dokter spesialis anak, dokter spesialis kandungan, dokter spesialis bedah, dokter spesialis penyakit dalam',
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
