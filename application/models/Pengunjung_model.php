<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengunjung_model extends CI_Model
{

	public function get_pengunjung_by_date($date)
	{
		$this->db->where('date', $date);
		$query = $this->db->get('pengunjung');
		return $query->row();
	}

	public function insert_pengunjung($date)
	{
		$data = array(
			'date' => $date,
			'month' => date('m', strtotime($date)),
			'year' => date('Y', strtotime($date)),
			'count' => 1
		);
		return $this->db->insert('pengunjung', $data);
	}

	public function update_pengunjung($date)
	{
		$this->db->set('count', 'count+1', FALSE);
		$this->db->where('date', $date);
		return $this->db->update('pengunjung');
	}

	public function get_monthly_recap($month, $year)
	{
		$this->db->select_sum('count');
		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$query = $this->db->get('pengunjung');
		return $query->row()->count;
	}
	public function insert_batch_views($data)
	{
		return $this->db->insert_batch('pengunjung', $data);
	}

	public function get_total_views()
	{
		$this->db->select_sum('count');
		$query = $this->db->get('pengunjung');
		return $query->row()->count;
	}
}
