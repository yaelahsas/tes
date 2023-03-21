<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galeri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Galeri_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "Data Galeri"
        );
        $this->load->view('galeri/galeri_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Galeri_model->json();
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'title' => 'Galeri',
            'page' => 'Galeri',
            'action' => site_url('Galeri/create_action'),
            'id' => set_value('id'),
            'img_galeri' => set_value('img_galeri'),
            'is_active' => set_value('is_active'),
        );
        $this->load->view('galeri/galeri_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path']   = './gambar/galeri/';
            $config['file_name']   = 'Galeri-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['img_galeri']['name'] != null) {

                if ($this->upload->do_upload('img_galeri')) {
                    $data = array(
                        'img_galeri' => $this->upload->data('file_name'),
                        'is_active' => $this->input->post('is_active')
                    );
                    $this->Galeri_model->insert($data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Galeri');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan</div>');
                    redirect('Galeri/create');
                }
            } else {
                $data = array(
                    'is_active' => $this->input->post('is_active')
                );

                $this->Galeri_model->insert($data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Galeri');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Galeri_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'Galeri',
                'page' => 'Update Galeri',
                'button' => 'Update',
                'action' => site_url('Galeri/update_action'),
                'id' => set_value('id', $row->id),
                'is_active' => set_value('is_active', $row->is_active),
                'img_galeri' => set_value('img_galeri', $row->img_galeri),
            );
            // $this->load->view('satuan/tb_satuan_form', $data);
            $this->load->view('galeri/galeri_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Galeri'));
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
            $config['upload_path']   = './gambar/galeri/';
            $config['file_name']   = 'galeri-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['img_galeri']['name'] != null) {
                if ($this->upload->do_upload('img_galeri')) {

                    //replace image
                    $cari = $this->Galeri_model->get_by_id($this->input->post('id', TRUE));
                    // var_dump($cari)
                    if ($cari->img_Galeri != null) {
                        $target_file = './gambar/galeri/' . $cari->img_Galeri;
                        unlink($target_file);
                    }

                    $data = array(
                        'img_galeri' => $this->upload->data('file_name'),
                        'is_active' => $this->input->post('is_active', TRUE),
                    );
                    $this->Galeri_model->update($this->input->post('id', TRUE), $data);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Galeri');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan!</div>');
                    redirect('Galeri/update/' . $this->input->post('id', TRUE));
                }
            } else {
                $data = array(
                    'is_active' => $this->input->post('is_active', TRUE),
                );
                $this->Galeri_model->update($this->input->post('id', TRUE), $data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Galeri');
            }
        }
    }

    public function delete($id)
    {
        $row = $this->Galeri_model->get_by_id($id);

        if ($row) {
            $this->Galeri_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
            redirect(site_url('Galeri'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak ditemukan</div>');
            redirect(site_url('Galeri'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('is_active', 'is_active', 'trim|required');
        $this->form_validation->set_rules('img_galeri', 'img_galeri', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
