<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->session->userdata('user_id');
        $this->session->userdata('company_id');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            if ($this->session->userdata('role') == 'superadmin') {

                redirect('superadmin/dashboard');

            } elseif ($this->session->userdata('role') == 'admin') {

                redirect('admin/dashboard');

            } elseif ($this->session->userdata('role') == 'employee') {

                redirect('employee/dashboard');

            } elseif ($this->session->userdata('role') == 'customer') {

                redirect('employee/dashboard');

            }
        }

        $this->load->view('auth/login');
    }

    public function login()
    {
        $email = trim($this->input->post('email'));
        $password = md5(trim($this->input->post('password')));

        $user = $this->Auth_model->checkLogin($email, $password);

        if ($user) {
            $this->session->sess_regenerate(TRUE);
            $company_name = '';
            if ($user->company_id) {
                $company = $this->db->where('id', $user->company_id)->get('companies')->row();
                if ($company) {
                    $company_name = $company->company_name;
                }
            }

            $this->session->set_userdata([
                'id' => $user->id,
                'company_id' => $user->company_id,
                'company_name' => $company_name,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'logged_in' => TRUE
            ]);
            // $this->session->set_userdata([
            //     'id' => $user->id,
            //     'company_id' => $user->company_id,
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     'role' => $user->role,
            //     'logged_in' => TRUE
            // ]);

            if ($user->role == 'superadmin') {

                redirect('superadmin/dashboard');

            } elseif ($user->role == 'admin') {

                redirect('admin/dashboard');

            } elseif ($user->role == 'employee') {

                redirect('employee/dashboard');

            } elseif ($user->role == 'customer') {

                redirect('employee/dashboard');

            } else {

                $this->session->set_flashdata('error', 'Invalid User Role');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid Email or Password');
            redirect('auth');
        }

    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }

    public function change_password()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->view('admin/header');
        $this->load->view('admin/change_password');
        $this->load->view('admin/footer');
    }
    public function update_password()
    {
        $user_id = $this->session->userdata('user_id');

        $old_password = md5($this->input->post('old_password'));
        $new_password = md5($this->input->post('new_password'));

        $user = $this->db
            ->where('id', $user_id)
            ->where('password', $old_password)
            ->get('users')
            ->row();

        if (!$user) {

            $this->session->set_flashdata(
                'error',
                'Current password is incorrect.'
            );

            redirect('auth/change_password');
        }

        $this->db
            ->where('id', $user_id)
            ->update('users', [
                'password' => $new_password
            ]);

        $this->session->set_flashdata(
            'success',
            'Password updated successfully.'
        );

        redirect('auth/change_password');
    }


    public function register()
    {
        $this->load->view('auth/register');
    }

    public function save_register()
    {
        $email = $this->input->post('email');

        $check = $this->db
            ->where('email', $email)
            ->get('users')
            ->row();

        if ($check) {
            $this->session->set_flashdata(
                'error',
                'Email already exists'
            );

            redirect('register');
        }

        // COMPANY SAVE

        $company_data = [
            'company_name' => $this->input->post('company_name'),
            'email' => $email,
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'status' => 1
        ];

        $this->db->insert('companies', $company_data);

        $company_id = $this->db->insert_id();

        // USER SAVE

        $user_data = [
            'company_id' => $company_id,
            'name' => $this->input->post('name'),
            'email' => $email,
            'password' => md5($this->input->post('password')),
            'role' => 'admin',
            'status' => 1
        ];

        $this->db->insert('users', $user_data);

        $this->session->set_flashdata(
            'success',
            'Registration Successful'
        );

        redirect('auth');
    }

}