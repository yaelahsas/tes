<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Berita extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Artikel_model');
		$this->load->model('Kategori_model');
		$this->load->library('form_validation');
		$this->load->library('datatables');
	}

	public function index()
	{
		$search = $this->input->get('search');
		$this->load->model('Kategori_model');

		if ($search) {
			$this->db->like('artikel.judul', $search);
			$this->db->or_like('artikel.isi', $search);
			$this->db->or_like('kategori.nama', $search);
		}

		$this->db->select('artikel.*, kategori.nama as kategori');
		$this->db->from('artikel');
		$this->db->join('kategori', 'kategori.id = artikel.kategori', 'left');
		$this->db->order_by('artikel.id', 'DESC');
		$articles = $this->db->get()->result();

		$data = array(
			'articles' => $articles,
			'categories' => $this->Kategori_model->get_all(),
			'search' => $search
		);
		
		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/artikel/lihat_semua', $data);
		$this->load->view('frontend/_layouts/footer');
	}

	public function kategori($id)
	{
		$this->load->model('Kategori_model');

		$this->db->select('artikel.*, kategori.nama as kategori');
		$this->db->from('artikel');
		$this->db->join('kategori', 'kategori.id = artikel.kategori', 'left');
		$this->db->where('kategori.id', $id);
		$this->db->order_by('artikel.id', 'DESC');
		$articles = $this->db->get()->result();

		$category = $this->Kategori_model->get_by_id($id);

		$data = array(
			'articles' => $articles,
			'categories' => $this->Kategori_model->get_all(),
			'current_category' => $category,
		);

		$this->load->view('frontend/_layouts/header');
		$this->load->view('frontend/artikel/lihat_semua', $data);
		$this->load->view('frontend/_layouts/footer');
	}

	public function read()
	{
		$id = $this->uri->segment(3);
		$row = $this->Artikel_model->get_by_id($id);
		if ($row) {
			// Get related articles from same category
			$this->db->select('artikel.*, kategori.nama as kategori');
			$this->db->from('artikel');
			$this->db->join('kategori', 'kategori.id = artikel.kategori', 'left');
			$this->db->where('artikel.kategori', $row->kategori);
			$this->db->where('artikel.id !=', $id); // Exclude current article
			$this->db->order_by('artikel.id', 'DESC');
			$this->db->limit(5); // Get 5 related articles
			$related_articles = $this->db->get()->result();

			$data = array(
				'id' => $row->id,
				'nama' => $row->nama,
				'judul' => $row->judul,
				'isi' => $row->isi,
				'sampul' => $row->sampul,
				'tanggal' => $this->formatDate($row->created_at),
				'related_articles' => $related_articles
			);
			$this->load->view('frontend/_layouts/header');
			$this->load->view('frontend/artikel/detail', $data);
			$this->load->view('frontend/_layouts/footer');
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('home'));
		}
	}
	function formatDate($date)
	{
		$timestamp = strtotime($date);

		// Ubah format ke "dd mm yyyy"
		$formatted_date = date('d m Y', $timestamp);

		$months = array(
			'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);

		$dateParts = explode(' ', $formatted_date);
		$formattedDate = $dateParts[0] . ' ' . $months[(int)$dateParts[1] - 1] . ' ' . $dateParts[2];

		return $formattedDate;
	}
}
