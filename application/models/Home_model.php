<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class home_model extends CI_Model
{


	function get_dokter()
	{
		$this->db->order_by('RAND()');
		$this->db->limit(3);
		return $this->db->get('dokter')->result();
	}
	function get_galeri()
	{
		$this->db->order_by('id', 'ASC');
		$this->db->where('is_active', 1);
		return $this->db->get('galeri')->result();
	}
	function get_profil()
	{
		$this->db->order_by('id', 'ASC');
		$this->db->where('is_active', 1);
		return $this->db->get('profil')->result();
	}
	function get_layanan()
	{
		$this->db->select('*');
		$this->db->order_by('id', 'ASC');
		return $this->db->get('layanan')->result();
	}
}
