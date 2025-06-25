<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Artikel_model extends CI_Model
{

	public $table = 'artikel';
	public $id = 'id';
	public $order = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	// datatables
	function json()
	{
		$this->datatables->select('a.id, k.nama as kategori, a.judul, a.isi, a.sampul');
		$this->datatables->from('artikel as a');
		//add this line for join
		$this->datatables->join('kategori as k', 'k.id = a.kategori');
		$this->datatables->add_column('action', anchor(site_url('Artikel/update/$1'), '<div class="badge badge-warning">Update</div>') .  anchor(site_url('Artikel/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');

		return $this->datatables->generate();
	}

	// get all
	function get_all()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}
	// get 3 terbaru
	function get_new()
	{

		$this->db->order_by($this->id, $this->order);
		$this->db->limit(3, 0);
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
		$this->db->or_like('kategori', $q);
		$this->db->or_like('judul', $q);
		$this->db->or_like('isi', $q);
		$this->db->or_like('img_sampul', $q);
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	// get data with limit and search
	function get_limit_data($limit, $start = 0, $q = NULL)
	{
		$this->db->order_by($this->id, $this->order);
		$this->db->like('id', $q);
		$this->db->or_like('kategori', $q);
		$this->db->or_like('judul', $q);
		$this->db->or_like('isi', $q);
		$this->db->or_like('img_sampul', $q);
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

    /**
     * Generate keywords from article title and content.
     * Returns an array of keywords.
     */
    public function generate_keywords($artikel)
    {
        // Get text from title and content
        $text = $artikel->judul . ' ' . strip_tags($artikel->isi);
        
        // Convert to lowercase and normalize spaces
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/\s+/', ' ', $text);
        
        // Remove HTML entities
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        
        // Remove punctuation but keep letters and numbers
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
        
        // Split into words
        $words = explode(' ', $text);
        
        // Extended stopwords list
        $stopwords = array(
            // Indonesian stopwords
            'ada', 'adalah', 'akan', 'antara', 'apabila', 'bagaimana', 'bagi', 'banyak',
            'bisa', 'dalam', 'dan', 'dari', 'dengan', 'di', 'dia', 'dimana', 'hal',
            'hampir', 'hari', 'hingga', 'ini', 'itu', 'juga', 'karena', 'ke', 'kepada',
            'ketika', 'kita', 'lain', 'maka', 'masih', 'melalui', 'menurut', 'mereka',
            'oleh', 'pada', 'para', 'saat', 'sampai', 'saya', 'sebab', 'sebagai', 'sebelum',
            'sebuah', 'sedang', 'seorang', 'seperti', 'serta', 'siapa', 'telah', 'tentang',
            'tersebut', 'tetap', 'tidak', 'untuk', 'yakni', 'yang', 'yaitu',
            // English stopwords
            'the', 'of', 'and', 'to', 'in', 'you', 'it', 'have', 'was', 'for', 'on',
            'that', 'by', 'with'
        );
        
        $keywords = array();
        foreach ($words as $word) {
            // Only process words longer than 3 characters and not in stopwords
            if (mb_strlen($word, 'UTF-8') > 3 && !in_array($word, $stopwords)) {
                if (isset($keywords[$word])) {
                    $keywords[$word]++;
                } else {
                    $keywords[$word] = 1;
                }
            }
        }
        
        // Sort keywords by frequency descending
        arsort($keywords);
        
        // Get top keywords (at least 1, max 10)
        $top_keywords = array_slice(array_keys($keywords), 0, 10);
        
        // If no keywords found, extract words from title
        if (empty($top_keywords)) {
            $title_words = explode(' ', preg_replace('/[^\p{L}\p{N}\s]/u', '', mb_strtolower($artikel->judul, 'UTF-8')));
            foreach ($title_words as $word) {
                if (mb_strlen($word, 'UTF-8') > 3 && !in_array($word, $stopwords)) {
                    $top_keywords[] = $word;
                }
            }
        }
        
        return $top_keywords;
    }
}
