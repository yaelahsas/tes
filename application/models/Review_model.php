<?php
class Review_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_reviews()
	{
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('review');
		return $query->result_array();
	}

	public function add_review($tulisan, $bintang, $inovasi, $tanggal)
	{
		$data = [
			'tulisan' => $tulisan,
			'bintang' => $bintang,
			'inovasi' => $inovasi,
			'tanggal' => $tanggal
		];
		return $this->db->insert('review', $data);
	}
	public function get_latest_reviews()
	{
		$this->db->order_by('tanggal', 'DESC');
		$this->db->limit(3);
		$query = $this->db->get('review');
		return $query->result_array();
	}
}
