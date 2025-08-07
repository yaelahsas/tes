<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dayun_usage_model extends CI_Model
{
    private $table = 'dayun_usage';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get usage data by specific date
     */
    public function get_usage_by_date($date)
    {
        $this->db->where('date', $date);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Insert new usage record for a date
     */
    public function insert_usage($date, $type = 'page_visit')
    {
        $data = array(
            'date' => $date,
            'page_visits' => ($type == 'page_visit') ? 1 : 0,
            'message_count' => ($type == 'message') ? 1 : 0,
            'month' => date('m', strtotime($date)),
            'year' => date('Y', strtotime($date))
        );
        return $this->db->insert($this->table, $data);
    }

    /**
     * Update existing usage record
     */
    public function update_usage($date, $type = 'page_visit')
    {
        if ($type == 'page_visit') {
            $this->db->set('page_visits', 'page_visits+1', FALSE);
        } elseif ($type == 'message') {
            $this->db->set('message_count', 'message_count+1', FALSE);
        }
        
        $this->db->where('date', $date);
        return $this->db->update($this->table);
    }

    /**
     * Track page visit - main method to call
     */
    public function track_page_visit($date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        $existing = $this->get_usage_by_date($date);
        
        if ($existing) {
            return $this->update_usage($date, 'page_visit');
        } else {
            return $this->insert_usage($date, 'page_visit');
        }
    }

    /**
     * Track message sent
     */
    public function track_message($date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        $existing = $this->get_usage_by_date($date);
        
        if ($existing) {
            return $this->update_usage($date, 'message');
        } else {
            return $this->insert_usage($date, 'message');
        }
    }

    /**
     * Get total page visits
     */
    public function get_total_page_visits()
    {
        $this->db->select_sum('page_visits');
        $query = $this->db->get($this->table);
        $result = $query->row();
        return $result->page_visits ? $result->page_visits : 0;
    }

    /**
     * Get total messages sent
     */
    public function get_total_messages()
    {
        $this->db->select_sum('message_count');
        $query = $this->db->get($this->table);
        $result = $query->row();
        return $result->message_count ? $result->message_count : 0;
    }

    /**
     * Get monthly recap for page visits
     */
    public function get_monthly_page_visits($month, $year)
    {
        $this->db->select_sum('page_visits');
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get($this->table);
        $result = $query->row();
        return $result->page_visits ? $result->page_visits : 0;
    }

    /**
     * Get monthly recap for messages
     */
    public function get_monthly_messages($month, $year)
    {
        $this->db->select_sum('message_count');
        $this->db->where('month', $month);
        $this->db->where('year', $year);
        $query = $this->db->get($this->table);
        $result = $query->row();
        return $result->message_count ? $result->message_count : 0;
    }

    /**
     * Get usage statistics for a date range
     */
    public function get_usage_range($start_date, $end_date)
    {
        $this->db->select('date, page_visits, message_count');
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get recent usage data (last 30 days)
     */
    public function get_recent_usage($days = 30)
    {
        $start_date = date('Y-m-d', strtotime("-$days days"));
        $end_date = date('Y-m-d');
        return $this->get_usage_range($start_date, $end_date);
    }

    /**
     * Get today's usage statistics
     */
    public function get_today_stats()
    {
        $today = date('Y-m-d');
        $usage = $this->get_usage_by_date($today);
        
        if ($usage) {
            return array(
                'page_visits' => $usage->page_visits,
                'message_count' => $usage->message_count,
                'date' => $usage->date
            );
        } else {
            return array(
                'page_visits' => 0,
                'message_count' => 0,
                'date' => $today
            );
        }
    }

    /**
     * Get all usage data with pagination support
     */
    public function get_all_usage($limit = null, $offset = null)
    {
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $this->db->order_by('date', 'DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get total records count
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }
}
