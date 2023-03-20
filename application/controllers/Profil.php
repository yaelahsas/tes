<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Profil_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "Data Profil"
        );
        $this->load->view('profil/profil_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Profil_model->json();
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'title' => 'Profil',
            'page' => 'Profil',
            'action' => site_url('Profil/create_action'),
            'id' => set_value('id'),
            'img_profil' => set_value('img_profil'),
            'is_active' => set_value('is_active'),
        );
        $this->load->view('profil/profil_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path']   = './gambar/profil/';
            $config['file_name']   = 'Profil -' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['img_profil']['name'] != null) {

                if ($this->upload->do_upload('img_profil')) {
                    $data = array(
                        'img_profil' => $this->upload->data('file_name'),
                        'is_active' => $this->input->post('is_active')
                    );
                    $this->Profil_model->insert($data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Profil');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan</div>');
                    redirect('Profil/create');
                }
            } else {
                $data = array(
                    'is_active' => $this->input->post('is_active')
                );

                $this->Profil_model->insert($data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Profil');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'Profil',
                'page' => 'Update Profil',
                'button' => 'Update',
                'action' => site_url('Profil/update_action'),
                'id' => set_value('id', $row->id),
                'is_active' => set_value('is_active', $row->is_active),
                'img_profil' => set_value('img_profil', $row->img_profil),
            );
            // $this->load->view('satuan/tb_satuan_form', $data);
            $this->load->view('Profil/Profil_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Profil'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path']   = './gambar/profil/';
            $config['file_name']   = 'Profil-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['img_profil']['name'] != null) {
                if ($this->upload->do_upload('img_profil')) {

                    //replace image
                    $cari = $this->Profil_model->get_by_id($this->input->post('id', TRUE));
                    // var_dump($cari)
                    if ($cari->img_profil != null) {
                        $target_file = './gambar/profil/' . $cari->img_profil;
                        unlink($target_file);
                    }

                    $data = array(
                        'img_profil' => $this->upload->data('file_name'),
                        'is_active' => $this->input->post('is_active', TRUE),
                    );
                    $this->Profil_model->update($this->input->post('id', TRUE), $data);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Profil');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan!</div>');
                    redirect('Profil/update/' . $this->input->post('id', TRUE));
                }
            } else {
                $data = array(
                    'is_active' => $this->input->post('is_active', TRUE),
                );
                $this->Profil_model->update($this->input->post('id', TRUE), $data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Profil');
            }
        }
    }

    public function delete($id)
    {
        $row = $this->Profil_model->get_by_id($id);

        if ($row) {
            $this->Profil_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
            redirect(site_url('Profil'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak ditemukan</div>');
            redirect(site_url('Profil'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
        $this->form_validation->set_rules('img_active', 'img_active', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
