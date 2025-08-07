<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dayun extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dayun_usage_model');
    }

    public function index()
    {
        // Track page visit when user accesses Dayun
        $this->Dayun_usage_model->track_page_visit();
        
        // Get today's statistics for potential display
        $today_stats = $this->Dayun_usage_model->get_today_stats();
        
        $data = array(
            'today_stats' => $today_stats
        );
        
        $this->load->view('dayun', $data);
    }

    /**
     * AJAX endpoint to track message sending
     */
    public function track_message()
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
            // Track the message
            $result = $this->Dayun_usage_model->track_message();
            
            if ($result) {
                echo json_encode([
                    'success' => true, 
                    'message' => 'Message tracked successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false, 
                    'message' => 'Failed to track message'
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
}
