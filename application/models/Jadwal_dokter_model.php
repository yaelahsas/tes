<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal_dokter_model extends CI_Model
{
    public $table = 'jadwal_dokter';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('jadwal_dokter.id, dokter.nama as dokter, jadwal_dokter.hari, jadwal_dokter.jam_mulai, jadwal_dokter.jam_selesai');
        $this->datatables->from('jadwal_dokter');
        $this->datatables->join('dokter', 'jadwal_dokter.dokter_id = dokter.id');
        $this->datatables->add_column('action', 
            anchor(site_url('Jadwal_dokter/update/$1'), '<div class="badge badge-warning">Update</div>') .  
            anchor(site_url('Jadwal_dokter/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 
            'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select('jadwal_dokter.*, dokter.nama as dokter');
        $this->db->join('dokter', 'jadwal_dokter.dokter_id = dokter.id');
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->select('jadwal_dokter.*, dokter.nama as dokter');
        $this->db->join('dokter', 'jadwal_dokter.dokter_id = dokter.id');
        return $this->db->get($this->table)->row();
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
}
