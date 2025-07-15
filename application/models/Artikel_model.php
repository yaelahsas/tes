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

	// Create URL friendly slug
	function create_slug($title)
	{
		$slug = url_title($title, 'dash', TRUE);
		$slug = strtolower($slug);
		
		// Check if slug exists
		$i = 0;
		$original_slug = $slug;
		while(true) {
			$this->db->where('slug', $slug);
			$num = $this->db->get($this->table)->num_rows();
			if($num == 0) break;
			$i++;
			$slug = $original_slug . '-' . $i;
		}
		
		return $slug;
	}

	// Generate slugs for existing articles
	function generate_missing_slugs()
	{
		// Get all articles without slugs
		$this->db->where('slug IS NULL OR slug = ""');
		$articles = $this->db->get($this->table)->result();

		$count = 0;
		foreach ($articles as $article) {
			$slug = $this->create_slug($article->judul);
			$this->db->where('id', $article->id);
			$this->db->update($this->table, array('slug' => $slug));
			$count++;
		}
		return $count;
	}

	// Get article by slug
	function get_by_slug($slug)
	{
		$this->db->where('slug', $slug);
		return $this->db->get($this->table)->row();
	}

	// datatables
	function json()
	{
		// Check if status column exists, if not use default value
		$this->db->query("SHOW COLUMNS FROM artikel LIKE 'status'");
		$status_exists = $this->db->affected_rows() > 0;
		
		if ($status_exists) {
			$this->datatables->select('a.id, k.nama as kategori, a.judul, a.isi, a.sampul, COALESCE(a.status, "draft") as status');
		} else {
			$this->datatables->select('a.id, k.nama as kategori, a.judul, a.isi, a.sampul, "draft" as status');
		}
		
		$this->datatables->from('artikel as a');
		//add this line for join
		$this->datatables->join('kategori as k', 'k.id = a.kategori');
		$this->datatables->add_column('action', anchor(site_url('Artikel/update/$1'), '<div class="badge badge-warning">Update</div>') .  anchor(site_url('Artikel/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');

		return $this->datatables->generate();
	}

	// get all dengan status tampil
	function get_all()
	{
		// Check if status column exists
		$this->db->query("SHOW COLUMNS FROM artikel LIKE 'status'");
		$status_exists = $this->db->affected_rows() > 0;
		
		if ($status_exists) {
			$this->db->where('status', 'tampil');
		}
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}

	// get all articles (untuk admin)
	function get_all_admin()
	{
		$this->db->order_by($this->id, $this->order);
		return $this->db->get($this->table)->result();
	}
	// get 3 terbaru dengan status tampil
	function get_new()
	{
		// Check if status column exists
		$this->db->query("SHOW COLUMNS FROM artikel LIKE 'status'");
		$status_exists = $this->db->affected_rows() > 0;
		
		if ($status_exists) {
			$this->db->where('status', 'tampil');
		}
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
		if(!isset($data['slug']) && isset($data['judul'])) {
			$data['slug'] = $this->create_slug($data['judul']);
		}
		$this->db->insert($this->table, $data);
		return $this->db->insert_id(); // Return ID artikel yang baru dibuat
	}

	// Method untuk set jadwal publish artikel batch
	function set_batch_publish_schedule($artikel_ids, $start_date = null)
	{
		if (empty($artikel_ids)) return false;
		
		// Jika tidak ada start_date, mulai dari besok
		if (!$start_date) {
			$start_date = date('Y-m-d', strtotime('+1 day'));
		}
		
		foreach ($artikel_ids as $index => $artikel_id) {
			// Hitung tanggal publish (setiap hari bertambah 1)
			$publish_date = date('Y-m-d', strtotime($start_date . ' +' . $index . ' days'));
			
			// Update artikel dengan tanggal publish
			$this->db->where('id', $artikel_id);
			$this->db->update($this->table, array(
				'tanggal_publish' => $publish_date,
				'status' => 'scheduled' // Status baru untuk artikel terjadwal
			));
		}
		
		return true;
	}

	// Method untuk auto-publish artikel yang sudah waktunya
	function auto_publish_scheduled_articles()
	{
		$today = date('Y-m-d');
		
		// Cari artikel dengan status 'scheduled' dan tanggal_publish = hari ini
		$this->db->where('status', 'scheduled');
		$this->db->where('tanggal_publish <=', $today);
		$this->db->update($this->table, array('status' => 'tampil'));
		
		return $this->db->affected_rows();
	}

	// Method untuk get artikel scheduled
	function get_scheduled_articles()
	{
		$this->db->where('status', 'scheduled');
		$this->db->order_by('tanggal_publish', 'ASC');
		return $this->db->get($this->table)->result();
	}

	// update data
	function update($id, $data)
	{
		if(!isset($data['slug']) && isset($data['judul'])) {
			$data['slug'] = $this->create_slug($data['judul']);
		}
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
