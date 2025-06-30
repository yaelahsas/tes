<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dokter extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('Dokter_model');
		$this->load->model('Poli_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$data = array(
			'title' => "Data Dokter"
		);
		$this->load->view('dokter/dokter_data', $data);
	}

	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Dokter_model->json();
	}

	public function create()
	{
		$poli_list = $this->Poli_model->get_all();
		$data = array(
			'button' => 'Create',
			'title' => 'Dokter',
			'page' => 'Dokter',
			'action' => site_url('Dokter/create_action'),
			'id' => set_value('id'),
			'nama' => set_value('nama'),
			'spesialis' => set_value('spesialis'),
			'img' => set_value('img'),
			'id_poli' => set_value('id_poli'),
			'poli_list' => $poli_list,
		);
		$this->load->view('dokter/dokter_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = '2048';
			$config['upload_path']   = './gambar/dokter/';
			$config['file_name']   = 'dokter -' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
			$this->load->library('upload', $config);

			$id_poli = $this->input->post('id_poli', TRUE);

			if (@$_FILES['img']['name'] != null) {

				if ($this->upload->do_upload('img')) {
					$data = array(
						'nama' => $this->input->post('nama', TRUE),
						'spesialis' => $this->input->post('spesialis', TRUE),
						'id_poli' => $id_poli,
						'img' => $this->upload->data('file_name')
					);
					$this->Dokter_model->insert($data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
					}
					redirect('Dokter');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan</div>');
					redirect('Dokter/create');
				}
			} else {

				$data = array(
					'nama' => $this->input->post('nama', TRUE),
					'spesialis' => $this->input->post('spesialis', TRUE),
					'id_poli' => $id_poli,
				);
				$this->Dokter_model->insert($data);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
				}
				redirect('Dokter');
			}
		}
	}

	public function update($id)
	{
		$row = $this->Dokter_model->get_by_id($id);

		if ($row) {
			$poli_list = $this->Poli_model->get_all();
			$data = array(
				'title' => 'Dokter',
				'page' => 'Update Dokter',
				'button' => 'Update',
				'action' => site_url('Dokter/update_action'),
				'id' => set_value('id', $row->id),
				'nama' => set_value('nama', $row->nama),
				'spesialis' => set_value('spesialis', $row->spesialis),
				'img' => set_value('img', $row->img),
				'id_poli' => set_value('id_poli', $row->id_poli),
				'poli_list' => $poli_list,
			);
			// $this->load->view('satuan/tb_satuan_form', $data);
			$this->load->view('dokter/dokter_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('Dokter'));
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
			$config['upload_path']   = './gambar/dokter/';
			$config['file_name']   = 'dokter-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
			$this->load->library('upload', $config);

			$id_poli = $this->input->post('id_poli', TRUE);

			if (@$_FILES['img']['name'] != null) {
				if ($this->upload->do_upload('img')) {

					//replace image
					$cari = $this->Dokter_model->get_by_id($this->input->post('id', TRUE));
					// var_dump($cari)
					if ($cari->img != null) {
						$target_file = './gambar/dokter/' . $cari->img;
						unlink($target_file);
					}

					$data = array(
						'nama' => $this->input->post('nama', TRUE),
						'spesialis' => $this->input->post('spesialis', TRUE),
						'id_poli' => $id_poli,
						'img' => $this->upload->data('file_name')
					);
					$this->Dokter_model->update($this->input->post('id', TRUE), $data);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
					}
					redirect('Dokter');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan!</div>');
					redirect('Dokter/update/' . $this->input->post('id', TRUE));
				}
			} else {
				$data = array(
					'nama' => $this->input->post('nama', TRUE),
					'spesialis' => $this->input->post('spesialis', TRUE),
					'id_poli' => $id_poli,
				);
				$this->Dokter_model->update($this->input->post('id', TRUE), $data);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
				}
				redirect('Dokter');
			}
		}
	}

	public function delete($id)
	{
		$row = $this->Dokter_model->get_by_id($id);

		if ($row) {
			$this->Dokter_model->delete($id);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect(site_url('Dokter'));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak ditemukan</div>');
			redirect(site_url('Dokter'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('spesialis', 'spesialis', 'trim|required');
		$this->form_validation->set_rules('id_poli', 'poli', 'trim|required');
		$this->form_validation->set_rules('img', 'img', 'trim');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
