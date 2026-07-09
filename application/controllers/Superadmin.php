<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'superadmin') {
            redirect('auth/logout');
        }
    }

    public function dashboard()
    {
        $this->load->view('superadmin/header');
        $this->load->view('superadmin/dashboard');
        $this->load->view('superadmin/footer');
    }
}