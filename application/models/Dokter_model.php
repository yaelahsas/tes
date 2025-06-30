<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dokter_model extends CI_Model
{

	public $table = 'dokter';
	public $id = 'id';
	public $order = 'ASC';

	function __construct()
	{
		parent::__construct();
	}

	// datatables
	function json()
	{
		$this->datatables->select('dokter.id,dokter.nama,dokter.spesialis,dokter.img,dokter.id_poli,poli.nama_poli');
		$this->datatables->from('dokter');
		$this->datatables->join('poli', 'dokter.id_poli = poli.id', 'left');
		$this->datatables->add_column('action', anchor(site_url('Dokter/update/$1'), '<div class="badge badge-warning">Update</div>') .  anchor(site_url('Dokter/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javascript: return confirm(\'Are You Sure ?\')"'), 'id');
		return $this->datatables->generate();
	}

	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}

	// get data by id
	function get_by_id($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	// get total rows
	function total_rows($q = NULL)
	{
		$this->db->like('id', $q);
		$this->db->or_like('nama', $q);
		$this->db->or_like('img', $q);
		$this->db->or_like('id_poli', $q);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	// get data with limit and search
	function get_limit_data($limit, $start = 0, $q = NULL)
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id', $q);
		$this->db->or_like('nama', $q);
		$this->db->or_like('img', $q);
		$this->db->or_like('id_poli', $q);
		$this->db->limit($limit, $start);
		return $this->db->get($this->table)->result();
	}

	// insert data
	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	// update data
	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
	}

	// delete data
	function delete($id)
	{
		$this->db->where($this->id, $id);
		$this->db->delete($this->table);
	}

	// get all spesialisasi
	function get_all_spesialisasi()
	{
		$this->db->select('DISTINCT(spesialis) as spesialis');
		$this->db->from($this->table);
		$this->db->where('spesialis IS NOT NULL');
		$this->db->order_by('spesialis', 'ASC');
		return $this->db->get()->result();
	}

	// get dokter by spesialisasi
	function get_by_spesialisasi($spesialis)
	{
		$this->db->where('spesialis', $spesialis);
		$this->db->order_by('nama', 'ASC');
		return $this->db->get($this->table)->result();
	}

	function get_poli_by_dokter($dokter_id)
	{
		$this->db->select('poli.*');
		$this->db->from('dokter');
		$this->db->join('poli', 'dokter.id_poli = poli.id');
		$this->db->where('dokter.id', $dokter_id);
		return $this->db->get()->row();
	}
}
