<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_dokter extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Jadwal_dokter_model');
        $this->load->model('Dokter_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "Data Jadwal Dokter"
        );
        $this->load->view('jadwal_dokter/jadwal_dokter_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Jadwal_dokter_model->json();
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'title' => 'Jadwal Dokter',
            'page' => 'Tambah Jadwal Dokter',
            'action' => site_url('Jadwal_dokter/create_action'),
            'id' => set_value('id'),
            'dokter_id' => set_value('dokter_id'),
            'hari' => set_value('hari'),
            'jam_mulai' => set_value('jam_mulai'),
            'jam_selesai' => set_value('jam_selesai'),
            'dokter_data' => $this->Dokter_model->get_all(),
            'hari_data' => array(
                'Senin' => 'Senin',
                'Selasa' => 'Selasa',
                'Rabu' => 'Rabu',
                'Kamis' => 'Kamis',
                'Jumat' => 'Jumat',
                'Sabtu' => 'Sabtu',
                'Minggu' => 'Minggu'
            )
        );
        $this->load->view('jadwal_dokter/jadwal_dokter_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $dokter_id = $this->input->post('dokter_id', TRUE);
            $hari_array = $this->input->post('hari', TRUE);
            $jam_mulai = $this->input->post('jam_mulai', TRUE);
            $jam_selesai = $this->input->post('jam_selesai', TRUE);

            // Insert one record for each selected day
            if (is_array($hari_array)) {
                foreach ($hari_array as $hari) {
                    $data = array(
                        'dokter_id' => $dokter_id,
                        'hari' => $hari,
                        'jam_mulai' => $jam_mulai,
                        'jam_selesai' => $jam_selesai,
                    );
                    $this->Jadwal_dokter_model->insert($data);
                }
            }

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            }
            redirect('Jadwal_dokter');
        }
    }

    public function update($id)
    {
        $row = $this->Jadwal_dokter_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'title' => 'Jadwal Dokter',
                'page' => 'Update Jadwal Dokter',
                'action' => site_url('Jadwal_dokter/update_action'),
                'id' => set_value('id', $row->id),
                'dokter_id' => set_value('dokter_id', $row->dokter_id),
                'hari' => set_value('hari', $row->hari),
                'jam_mulai' => set_value('jam_mulai', $row->jam_mulai),
                'jam_selesai' => set_value('jam_selesai', $row->jam_selesai),
                'dokter_data' => $this->Dokter_model->get_all(),
                'hari_data' => array(
                    'Senin' => 'Senin',
                    'Selasa' => 'Selasa',
                    'Rabu' => 'Rabu',
                    'Kamis' => 'Kamis',
                    'Jumat' => 'Jumat',
                    'Sabtu' => 'Sabtu',
                    'Minggu' => 'Minggu'
                )
            );
            $this->load->view('jadwal_dokter/jadwal_dokter_form', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Record Not Found</div>');
            redirect(site_url('Jadwal_dokter'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $id = $this->input->post('id', TRUE);
            $dokter_id = $this->input->post('dokter_id', TRUE);
            $hari = $this->input->post('hari', TRUE);
            $jam_mulai = $this->input->post('jam_mulai', TRUE);
            $jam_selesai = $this->input->post('jam_selesai', TRUE);

            // Update only the specific schedule record
            $data = array(
                'dokter_id' => $dokter_id,
                'hari' => $hari[0], // Take first selected day since we're updating a single record
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
            );

            $this->Jadwal_dokter_model->update($id, $data);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
            }
            redirect(site_url('Jadwal_dokter'));
        }
    }

    public function delete($id)
    {
        $row = $this->Jadwal_dokter_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_dokter_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
            redirect(site_url('Jadwal_dokter'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak ditemukan</div>');
            redirect(site_url('Jadwal_dokter'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('dokter_id', 'dokter', 'trim|required');
        $this->form_validation->set_rules('hari[]', 'hari', 'trim|required');
        $this->form_validation->set_rules('jam_mulai', 'jam mulai', 'trim|required');
        $this->form_validation->set_rules('jam_selesai', 'jam selesai', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
