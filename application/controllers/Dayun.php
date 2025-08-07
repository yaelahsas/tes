<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dayun extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dayun_usage_model');
        $this->load->model('Dayun_chat_model');
    }

    public function index()
    {
        // Track page visit when user accesses Dayun
        $this->Dayun_usage_model->track_page_visit();
        
        // Get today's statistics for potential display
        $today_stats = $this->Dayun_usage_model->get_today_stats();
        
        // Generate or get session ID for chat history
        $session_id = $this->_get_or_create_session_id();
        
        $data = array(
            'today_stats' => $today_stats,
            'session_id' => $session_id
        );
        
        $this->load->view('dayun', $data);
    }

    /**
     * AJAX endpoint to save chat message and track usage
     */
    public function save_message()
    {
        // Set JSON response header
        header('Content-Type: application/json');
        
        // Only allow POST requests
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            // Get POST data
            $input = json_decode($this->input->raw_input_stream, true);
            
            $session_id = isset($input['session_id']) ? $input['session_id'] : $this->_get_or_create_session_id();
            $message = isset($input['message']) ? trim($input['message']) : '';
            $message_type = isset($input['message_type']) ? $input['message_type'] : 'user';
            
            if (empty($message)) {
                echo json_encode(['success' => false, 'message' => 'Message cannot be empty']);
                return;
            }
            
            // Save message to chat history
            $additional_data = array();
            if (isset($input['ai_response'])) {
                $additional_data['ai_response'] = $input['ai_response'];
            }
            if (isset($input['webhook_response'])) {
                $additional_data['webhook_response'] = $input['webhook_response'];
            }
            if (isset($input['response_time_ms'])) {
                $additional_data['response_time_ms'] = $input['response_time_ms'];
            }
            if (isset($input['is_successful'])) {
                $additional_data['is_successful'] = $input['is_successful'];
            }
            
            $chat_result = $this->Dayun_chat_model->save_message($session_id, $message, $message_type, $additional_data);
            
            // Track message for usage statistics (only for user messages)
            if ($message_type === 'user') {
                $this->Dayun_usage_model->track_message();
            }
            
            if ($chat_result) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Message saved successfully',
                    'session_id' => $session_id
                ]);
            } else {
                echo json_encode([
                    'success' => false, 
                    'message' => 'Failed to save message'
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false, 
                'message' => 'Server error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * AJAX endpoint to track message sending (backward compatibility)
     */
    public function track_message()
    {
        return $this->save_message();
    }

    /**
     * Get usage statistics (for admin or API purposes)
     */
    public function get_stats()
    {
        // Set JSON response header
        header('Content-Type: application/json');
        
        try {
            $stats = array(
                'today' => $this->Dayun_usage_model->get_today_stats(),
                'total_page_visits' => $this->Dayun_usage_model->get_total_page_visits(),
                'total_messages' => $this->Dayun_usage_model->get_total_messages(),
                'current_month_visits' => $this->Dayun_usage_model->get_monthly_page_visits(date('m'), date('Y')),
                'current_month_messages' => $this->Dayun_usage_model->get_monthly_messages(date('m'), date('Y')),
                'recent_usage' => $this->Dayun_usage_model->get_recent_usage(7) // Last 7 days
            );
            
            echo json_encode([
                'success' => true,
                'data' => $stats
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error retrieving stats: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get chat history for current session
     */
    public function get_chat_history()
    {
        // Set JSON response header
        header('Content-Type: application/json');
        
        try {
            $session_id = $this->input->get('session_id');
            $limit = $this->input->get('limit') ? (int)$this->input->get('limit') : 50;
            $offset = $this->input->get('offset') ? (int)$this->input->get('offset') : 0;
            
            if (empty($session_id)) {
                echo json_encode(['success' => false, 'message' => 'Session ID required']);
                return;
            }
            
            $history = $this->Dayun_chat_model->get_session_history($session_id, $limit, $offset);
            
            echo json_encode([
                'success' => true,
                'data' => $history,
                'session_id' => $session_id
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error retrieving chat history: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Update AI response for a message
     */
    public function update_ai_response()
    {
        // Set JSON response header
        header('Content-Type: application/json');
        
        // Only allow POST requests
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            $input = json_decode($this->input->raw_input_stream, true);
            
            $message_id = isset($input['message_id']) ? (int)$input['message_id'] : 0;
            $ai_response = isset($input['ai_response']) ? $input['ai_response'] : '';
            $webhook_response = isset($input['webhook_response']) ? $input['webhook_response'] : null;
            $response_time_ms = isset($input['response_time_ms']) ? (int)$input['response_time_ms'] : null;
            $is_successful = isset($input['is_successful']) ? (bool)$input['is_successful'] : true;
            
            if ($message_id <= 0 || empty($ai_response)) {
                echo json_encode(['success' => false, 'message' => 'Invalid message ID or response']);
                return;
            }
            
            $result = $this->Dayun_chat_model->update_ai_response($message_id, $ai_response, $webhook_response, $response_time_ms, $is_successful);
            
            if ($result) {
                echo json_encode([
                    'success' => true,
                    'message' => 'AI response updated successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Failed to update AI response'
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Admin dashboard to view Dayun usage statistics
     */
    public function admin_stats()
    {
        // Get comprehensive statistics
        $data = array(
            'today_stats' => $this->Dayun_usage_model->get_today_stats(),
            'total_page_visits' => $this->Dayun_usage_model->get_total_page_visits(),
            'total_messages' => $this->Dayun_usage_model->get_total_messages(),
            'current_month_visits' => $this->Dayun_usage_model->get_monthly_page_visits(date('m'), date('Y')),
            'current_month_messages' => $this->Dayun_usage_model->get_monthly_messages(date('m'), date('Y')),
            'recent_usage' => $this->Dayun_usage_model->get_recent_usage(30), // Last 30 days
            'current_month' => date('F Y'),
            'current_date' => date('d F Y')
        );
        
        $this->load->view('dayun_admin_stats', $data);
    }

    /**
     * Admin view for chat history
     */
    public function admin_chat_history()
    {
        $limit = 50;
        $offset = $this->input->get('offset') ? (int)$this->input->get('offset') : 0;
        $session_id = $this->input->get('session_id');
        
        // Get chat history
        $chat_history = $this->Dayun_chat_model->get_admin_chat_history($limit, $offset, $session_id);
        $total_messages = $this->Dayun_chat_model->count_chat_messages($session_id);
        
        // Get recent sessions
        $recent_sessions = $this->Dayun_chat_model->get_recent_sessions(20);
        
        // Get chat statistics
        $chat_stats = $this->Dayun_chat_model->get_chat_statistics(30);
        
        $data = array(
            'chat_history' => $chat_history,
            'recent_sessions' => $recent_sessions,
            'chat_stats' => $chat_stats,
            'total_messages' => $total_messages,
            'current_offset' => $offset,
            'limit' => $limit,
            'selected_session' => $session_id,
            'current_date' => date('d F Y')
        );
        
        $this->load->view('dayun_admin_chat_history', $data);
    }

    /**
     * Search chat messages
     */
    public function search_chat()
    {
        // Set JSON response header
        header('Content-Type: application/json');
        
        try {
            $search_term = $this->input->get('q');
            $limit = $this->input->get('limit') ? (int)$this->input->get('limit') : 50;
            $offset = $this->input->get('offset') ? (int)$this->input->get('offset') : 0;
            
            if (empty($search_term)) {
                echo json_encode(['success' => false, 'message' => 'Search term required']);
                return;
            }
            
            $results = $this->Dayun_chat_model->search_messages($search_term, $limit, $offset);
            
            echo json_encode([
                'success' => true,
                'data' => $results,
                'search_term' => $search_term
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error searching messages: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Private method to get or create session ID
     */
    private function _get_or_create_session_id()
    {
        // Check if session ID exists in session
        if ($this->session->userdata('dayun_session_id')) {
            return $this->session->userdata('dayun_session_id');
        }
        
        // Generate new session ID
        $session_id = 'dayun_' . uniqid() . '_' . time();
        
        // Store in session
        $this->session->set_userdata('dayun_session_id', $session_id);
        
        return $session_id;
    }

    /**
     * Clear current chat session
     */
    public function clear_session()
    {
        // Set JSON response header
        header('Content-Type: application/json');
        
        try {
            // Remove session ID from session
            $this->session->unset_userdata('dayun_session_id');
            
            // Generate new session ID
            $new_session_id = $this->_get_or_create_session_id();
            
            echo json_encode([
                'success' => true,
                'message' => 'Chat session cleared',
                'new_session_id' => $new_session_id
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error clearing session: ' . $e->getMessage()
            ]);
        }
    }
}
