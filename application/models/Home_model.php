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

	public function get_dokter_with_jadwal()
	{
		$this->db->select('
        dokter.id,
        dokter.nama,
        dokter.spesialis,
        dokter.img,
        jadwal_dokter.hari,
        jadwal_dokter.jam_mulai,
        jadwal_dokter.jam_selesai
    ');
		$this->db->from('dokter');
		$this->db->join('jadwal_dokter', 'jadwal_dokter.dokter_id = dokter.id');
		$this->db->order_by('dokter.nama, FIELD(jadwal_dokter.hari, "Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu")');
		$query = $this->db->get()->result();

		// Struktur data dokter + jadwal
		$result = [];
		foreach ($query as $row) {
			if (!isset($result[$row->id])) {
				$result[$row->id] = [
					'id' => $row->id,
					'nama' => $row->nama,
					'spesialis' => $row->spesialis,
					'img' => $row->img,
					'jadwal' => []
				];
			}

			$result[$row->id]['jadwal'][] = [
				'hari' => $row->hari,
				'jam_mulai' => $row->jam_mulai,
				'jam_selesai' => $row->jam_selesai
			];
		}

		// Optional: kamu bisa kelompokkan jadwal jika harinya dan jam-nya berurutan
		foreach ($result as &$dok) {
			$dok['jadwal'] = $this->_group_jadwal($dok['jadwal']);
		}

		return array_values($result); // kembalikan array numerik
	}

	// Tambahkan private function ini di model juga
	private function _group_jadwal($jadwal)
	{
		$order_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
		usort($jadwal, function ($a, $b) use ($order_hari) {
			return array_search($a['hari'], $order_hari) - array_search($b['hari'], $order_hari);
		});

		$grouped = [];
		$current = null;

		foreach ($jadwal as $item) {
			if ($current === null) {
				$current = [
					'hari_awal' => $item['hari'],
					'hari_akhir' => $item['hari'],
					'jam_mulai' => $item['jam_mulai'],
					'jam_selesai' => $item['jam_selesai']
				];
			} else {
				if (
					$item['jam_mulai'] === $current['jam_mulai'] &&
					$item['jam_selesai'] === $current['jam_selesai'] &&
					array_search($item['hari'], $order_hari) === array_search($current['hari_akhir'], $order_hari) + 1
				) {
					$current['hari_akhir'] = $item['hari'];
				} else {
					$grouped[] = $current;
					$current = [
						'hari_awal' => $item['hari'],
						'hari_akhir' => $item['hari'],
						'jam_mulai' => $item['jam_mulai'],
						'jam_selesai' => $item['jam_selesai']
					];
				}
			}
		}
		if ($current !== null) {
			$grouped[] = $current;
		}

		return $grouped;
	}
	public function get_spesialisasi()
{
    $this->db->select('DISTINCT(spesialis)');
    $this->db->from('dokter');
    $this->db->order_by('spesialis', 'ASC');
    return $this->db->get()->result();
}

}
