<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function show_404() {
        $this->output->set_status_header('404');
        $this->load->view('errors/html/error_404');
    }

    public function show_error() {
        $this->output->set_status_header('500');
        $this->load->view('errors/html/error_general');
    }
}
