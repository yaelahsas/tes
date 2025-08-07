<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dayun_chat_model extends CI_Model
{
    private $table = 'dayun_chat_history';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Save a chat message to history
     */
    public function save_message($session_id, $message_content, $message_type = 'user', $additional_data = array())
    {
        $data = array(
            'session_id' => $session_id,
            'user_ip' => $this->input->ip_address(),
            'user_agent' => $this->input->user_agent(),
            'message_type' => $message_type,
            'message_content' => $message_content,
            'is_successful' => 1
        );

        // Add additional data if provided
        if (isset($additional_data['ai_response'])) {
            $data['ai_response'] = $additional_data['ai_response'];
        }
        if (isset($additional_data['webhook_response'])) {
            $data['webhook_response'] = $additional_data['webhook_response'];
        }
        if (isset($additional_data['response_time_ms'])) {
            $data['response_time_ms'] = $additional_data['response_time_ms'];
        }
        if (isset($additional_data['is_successful'])) {
            $data['is_successful'] = $additional_data['is_successful'];
        }

        return $this->db->insert($this->table, $data);
    }

    /**
     * Get chat history for a specific session
     */
    public function get_session_history($session_id, $limit = 50, $offset = 0)
    {
        $this->db->select('id, message_type, message_content, ai_response, created_at, is_successful');
        $this->db->where('session_id', $session_id);
        $this->db->order_by('created_at', 'ASC');
        
        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }
        
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get recent chat sessions
     */
    public function get_recent_sessions($limit = 20)
    {
        $this->db->select('session_id, COUNT(*) as message_count, MIN(created_at) as first_message, MAX(created_at) as last_message');
        $this->db->group_by('session_id');
        $this->db->order_by('MAX(created_at)', 'DESC');
        $this->db->limit($limit);
        
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get chat statistics
     */
    public function get_chat_statistics($days = 30)
    {
        $start_date = date('Y-m-d', strtotime("-$days days"));
        
        // Total messages
        $this->db->where('created_at >=', $start_date);
        $total_messages = $this->db->count_all_results($this->table);
        
        // Total sessions
        $this->db->select('DISTINCT session_id');
        $this->db->where('created_at >=', $start_date);
        $total_sessions = $this->db->count_all_results($this->table);
        
        // Messages by type
        $this->db->select('message_type, COUNT(*) as count');
        $this->db->where('created_at >=', $start_date);
        $this->db->group_by('message_type');
        $query = $this->db->get($this->table);
        $messages_by_type = $query->result();
        
        // Daily message counts
        $this->db->select('DATE(created_at) as date, COUNT(*) as count');
        $this->db->where('created_at >=', $start_date);
        $this->db->group_by('DATE(created_at)');
        $this->db->order_by('date', 'ASC');
        $query = $this->db->get($this->table);
        $daily_counts = $query->result();
        
        return array(
            'total_messages' => $total_messages,
            'total_sessions' => $total_sessions,
            'messages_by_type' => $messages_by_type,
            'daily_counts' => $daily_counts,
            'period_days' => $days
        );
    }

    /**
     * Search chat messages
     */
    public function search_messages($search_term, $limit = 100, $offset = 0)
    {
        $this->db->select('session_id, message_type, message_content, ai_response, created_at');
        $this->db->like('message_content', $search_term);
        $this->db->or_like('ai_response', $search_term);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get session info
     */
    public function get_session_info($session_id)
    {
        $this->db->select('session_id, user_ip, COUNT(*) as message_count, MIN(created_at) as first_message, MAX(created_at) as last_message');
        $this->db->where('session_id', $session_id);
        $this->db->group_by('session_id, user_ip');
        
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Delete old chat history (for maintenance)
     */
    public function delete_old_history($days = 90)
    {
        $cutoff_date = date('Y-m-d H:i:s', strtotime("-$days days"));
        $this->db->where('created_at <', $cutoff_date);
        return $this->db->delete($this->table);
    }

    /**
     * Get chat history for admin view with pagination
     */
    public function get_admin_chat_history($limit = 50, $offset = 0, $session_id = null)
    {
        $this->db->select('id, session_id, message_type, message_content, ai_response, user_ip, created_at, is_successful');
        
        if ($session_id) {
            $this->db->where('session_id', $session_id);
        }
        
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit($limit, $offset);
        
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Count total chat messages for pagination
     */
    public function count_chat_messages($session_id = null)
    {
        if ($session_id) {
            $this->db->where('session_id', $session_id);
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Update AI response for a message
     */
    public function update_ai_response($message_id, $ai_response, $webhook_response = null, $response_time_ms = null, $is_successful = 1)
    {
        $data = array(
            'ai_response' => $ai_response,
            'is_successful' => $is_successful
        );
        
        if ($webhook_response !== null) {
            $data['webhook_response'] = $webhook_response;
        }
        
        if ($response_time_ms !== null) {
            $data['response_time_ms'] = $response_time_ms;
        }
        
        $this->db->where('id', $message_id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Get last message ID for a session (useful for updating responses)
     */
    public function get_last_message_id($session_id, $message_type = 'user')
    {
        $this->db->select('id');
        $this->db->where('session_id', $session_id);
        $this->db->where('message_type', $message_type);
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(1);
        
        $query = $this->db->get($this->table);
        $result = $query->row();
        
        return $result ? $result->id : null;
    }

    /**
     * Check if session exists
     */
    public function session_exists($session_id)
    {
        $this->db->where('session_id', $session_id);
        return $this->db->count_all_results($this->table) > 0;
    }

    /**
     * Get conversation summary for a session
     */
    public function get_conversation_summary($session_id)
    {
        $this->db->select('
            session_id,
            COUNT(*) as total_messages,
            SUM(CASE WHEN message_type = "user" THEN 1 ELSE 0 END) as user_messages,
            SUM(CASE WHEN message_type = "ai" THEN 1 ELSE 0 END) as ai_messages,
            MIN(created_at) as conversation_start,
            MAX(created_at) as conversation_end,
            AVG(response_time_ms) as avg_response_time
        ');
        $this->db->where('session_id', $session_id);
        $this->db->group_by('session_id');
        
        $query = $this->db->get($this->table);
        return $query->row();
    }
}
