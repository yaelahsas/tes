<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Artikel extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('Artikel_model');
		$this->load->model('Kategori_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
		// Load HTTP client for API calls
		// $this->load->library('curl');
	}

	// New method to generate article via AI
	public function generate_ai_article()
	{
		header('Content-Type: application/json');
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.akbxr.com/v1/chat/completions',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
				"model": "auto",
				"messages": [
					{
						"role": "user",
						"content": "Buatkan saya artikel tentang kesehatan / kesehatan remaja / kesehatan orangtua / kesehatan anak / kesehatan organ tubuh / olahraga  yang uniq dengan panjang min 200 kata , dengan gaya bahasa informal untuk dibaca pasien. gunakan seo dan keyword terindexs google, buatkan dengan format html tanpa head dan body tanpa \\n"
					}
				],
				"stream": false
			}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer UNLIMITED-BETA'
			),
		));

		$response = curl_exec($curl);

		// Check for cURL errors
		if (curl_errno($curl)) {
			$error_msg = curl_error($curl);
			curl_close($curl);
			echo json_encode(array('error' => 'Curl error: ' . $error_msg));
			return;
		}

		curl_close($curl);

		// Decode response
		$result = json_decode($response, true);

		// Parse the generated text from response
		if ($result && isset($result['choices'][0]['message']['content'])) {
			$generated_content = $result['choices'][0]['message']['content'];
			
			// Replace \n with actual line breaks
			$generated_content = str_replace('\\n', "\n", $generated_content);
			
			// Extract title from h2 tag
			preg_match('/<h2>(.*?)<\/h2>/', $generated_content, $title_matches);
			$judul = isset($title_matches[1]) ? strip_tags($title_matches[1]) : "Artikel Kesehatan";
			
			// Use the full content as isi
			$isi = $generated_content;

			// Return JSON response for AJAX
			echo json_encode(array(
				'judul' => $judul,
				'isi' => $isi
			));
		} else {
			echo json_encode(array('error' => 'Gagal generate artikel AI'));
		}
	}

	// Method untuk generate batch artikel
	public function generate_batch_article()
	{
		header('Content-Type: application/json');
		
		$kategori = $this->input->post('kategori');
		
		if (!$kategori) {
			echo json_encode(array('error' => 'Kategori tidak boleh kosong'));
			return;
		}
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.akbxr.com/v1/chat/completions',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => '{
				"model": "auto",
				"messages": [
					{
						"role": "user",
						"content": "Buatkan saya artikel tentang kesehatan / kesehatan remaja / kesehatan orangtua / kesehatan anak / kesehatan organ tubuh / olahraga  yang uniq dengan panjang min 200 kata , dengan gaya bahasa informal untuk dibaca pasien. gunakan seo dan keyword terindexs google, buatkan dengan format html tanpa head dan body tanpa \\n"
					}
				],
				"stream": false
			}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Authorization: Bearer UNLIMITED-BETA'
			),
		));

		$response = curl_exec($curl);

		// Check for cURL errors
		if (curl_errno($curl)) {
			$error_msg = curl_error($curl);
			curl_close($curl);
			echo json_encode(array('error' => 'Curl error: ' . $error_msg));
			return;
		}

		curl_close($curl);

		// Decode response
		$result = json_decode($response, true);

		// Parse the generated text from response
		if ($result && isset($result['choices'][0]['message']['content'])) {
			$generated_content = $result['choices'][0]['message']['content'];
			
			// Replace \n with actual line breaks
			$generated_content = str_replace('\\n', "\n", $generated_content);
			
			// Extract title from h2 tag
			preg_match('/<h2>(.*?)<\/h2>/', $generated_content, $title_matches);
			$judul = isset($title_matches[1]) ? strip_tags($title_matches[1]) : "Artikel Kesehatan " . date('Y-m-d H:i:s');
			
			// Use the full content as isi
			$isi = $generated_content;

			// Save to database with selected category and draft status
			$data = array(
				'kategori' => $kategori,
				'judul' => $judul,
				'isi' => $isi,
				'status' => 'draft'
			);
			
			$this->Artikel_model->insert($data);
			
			if ($this->db->affected_rows() > 0) {
				echo json_encode(array(
					'success' => true,
					'judul' => $judul,
					'message' => 'Artikel berhasil dibuat'
				));
			} else {
				echo json_encode(array('error' => 'Gagal menyimpan artikel ke database'));
			}
		} else {
			echo json_encode(array('error' => 'Gagal generate artikel AI'));
		}
	}

	public function index()
	{
		$data = array(
			'title' => "Data Artikel"
		);
		$this->load->view('artikel/artikel_data', $data);
	}


	public function json()
	{
		header('Content-Type: application/json');
		echo $this->Artikel_model->json();
	}


	// Buat fungsi ini dalam file helper (misal: application/helpers/MY_date_helper.php)

	public function create()
	{
		$data = array(
			'button' => 'Create',
			'title' => 'Artikel',
			'page' => 'Artikel',
			'action' => site_url('Artikel/create_action'),
			'id' => set_value('id'),
			'kate_all' => $this->Kategori_model->get_all(),
			'judul' => set_value('judul'),
			'isi' => set_value('isi'),
			'img_sampul' => set_value('img_sampul'),
			'status' => set_value('status', isset($row->status) ? $row->status : 'draft'),
		);
		$this->load->view('artikel/artikel_form', $data);
	}

	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {

			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']      = '2048';
			$config['upload_path']   = './gambar/artikel/';
			$config['file_name']   = 'artikel -' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
			$this->load->library('upload', $config);

			if (@$_FILES['sampul']['name'] != null) {

				if ($this->upload->do_upload('sampul')) {
					$data = array(
						'kategori' => $this->input->post('kategori', TRUE),
						'judul' => $this->input->post('judul', TRUE),
						'isi' => $this->input->post('isi', TRUE),
						'sampul' => $this->upload->data('file_name'),
						'status' => $this->input->post('status', TRUE)
					);
					$this->Artikel_model->insert($data);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
					}
					redirect('Artikel');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan</div>');
					redirect('Artikel/create');
				}
			} else {

				$data = array(
					'kategori' => $this->input->post('kategori', TRUE),
					'judul' => $this->input->post('judul', TRUE),
					'isi' => $this->input->post('isi', TRUE),
					'status' => $this->input->post('status', TRUE)
				);
				$this->Artikel_model->insert($data);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
				}
				redirect('Artikel');
			}
		}
	}

	public function update($id)
	{
		$row = $this->Artikel_model->get_by_id($id);
		$kate_all = $this->Kategori_model->get_all();

		if ($row) {
			$data = array(
				'button' => 'Update',
				'title' => 'Update',
				'page' => 'Artikel',
				'action' => site_url('Artikel/update_action'),
				'id' => set_value('id', $row->id),
				'kategori' => set_value('kategori', $row->kategori),
				'kate_all' => $kate_all,
				'judul' => set_value('judul', $row->judul),
				'isi' => set_value('isi', $row->isi),
				'sampul' => set_value('sampul', $row->sampul),
				'status' => set_value('status', isset($row->status) ? $row->status : 'draft'),
			);
			$this->load->view('artikel/artikel_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('Artikel'));
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
			$config['upload_path']   = './gambar/artikel/';
			$config['file_name']   = 'artikel-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
			$this->load->library('upload', $config);

			if (@$_FILES['sampul']['name'] != null) {
				if ($this->upload->do_upload('sampul')) {

					//replace image
					$cari = $this->Artikel_model->get_by_id($this->input->post('id', TRUE));
					// var_dump($cari)
					if ($cari->sampul != null) {
						$target_file = './gambar/artikel/' . $cari->sampul;
						unlink($target_file);
					}

					$data = array(
						'kategori' => $this->input->post('kategori', TRUE),
						'judul' => $this->input->post('judul', TRUE),
						'isi' => $this->input->post('isi', TRUE),
						'sampul' => $this->upload->data('file_name'),
						'status' => $this->input->post('status', TRUE)
					);
					$this->Artikel_model->update($this->input->post('id', TRUE), $data);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
					}
					redirect('Artikel');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan!</div>');
					redirect('Artikel/update/' . $this->input->post('id', TRUE));
				}
			} else {
				$data = array(
					'kategori' => $this->input->post('kategori', TRUE),
					'judul' => $this->input->post('judul', TRUE),
					'isi' => $this->input->post('isi', TRUE),
					'status' => $this->input->post('status', TRUE)
				);
				$this->Artikel_model->update($this->input->post('id', TRUE), $data);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
				}
				redirect('Artikel');
			}
		}
	}

	public function delete($id)
	{
		$row = $this->Artikel_model->get_by_id($id);

		if ($row) {
			$this->Artikel_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('Artikel'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('Artikel'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('isi', 'isi', 'trim');
		$this->form_validation->set_rules('img_sampul', 'img_sampul', 'trim');
		$this->form_validation->set_rules('status', 'status', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
}
