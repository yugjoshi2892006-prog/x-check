<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Customer_model');
    }

    public function index()
    {
        $data['customers'] = $this->Customer_model->getAll();

        $data['total_rows'] = count($data['customers']);
        $data['current_page'] = 1;
        $data['per_page'] = 10;

        $this->load->view('admin/header');
        $this->load->view('admin/customer_list', $data);
        $this->load->view('admin/footer');
    }

    public function add()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/customer_add');
        $this->load->view('admin/footer');
    }

    public function insert()
    {
        // Check if email already exists in users table
        $email = $this->input->post('email');

        $check = $this->db
            ->where('email', $email)
            ->get('users')
            ->row();

        if ($check) {
            $this->session->set_flashdata('error', 'Email already exists.');
            redirect('customer/add');
            return;
        }

        // Customer Data
        $data = array(

            'company_id' => $this->session->userdata('company_id'),

            'name' => $this->input->post('name'),
            'email' => $email,
            'mobile' => $this->input->post('mobile'),
            'password' => md5($this->input->post('password')),

            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address'),

            'status' => $this->input->post('status')
        );

        // Insert into customers table
        $this->Customer_model->insert($data);

        // User Data
        $user = array(

            'company_id' => $this->session->userdata('company_id'),

            'name' => $this->input->post('name'),
            'email' => $email,
            'password' => md5($this->input->post('password')),

            'mobile' => $this->input->post('mobile'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),

            'role' => 'customer',
            'status' => 1
        );

        // Insert into users table
        $this->db->insert('users', $user);

        $this->session->set_flashdata('success', 'Customer added successfully.');

        redirect('customer');
    }

    public function edit($id)
    {
        $data['customer'] = $this->db
            ->where('id', $id)
            ->where('company_id', $this->session->userdata('company_id'))
            ->get('customers')
            ->row();

        if (!$data['customer']) {
            show_404();
        }

        $this->load->view('admin/header');
        $this->load->view('admin/customer_edit', $data);
        $this->load->view('admin/footer');
    }

    public function update($id)
    {
        // Customer Data
        $data = array(

            'company_id' => $this->session->userdata('company_id'),

            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),

            'password' => md5($this->input->post('password')),

            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address'),

            'status' => $this->input->post('status')
        );

        // Update customer table
        $this->Customer_model->update($id, $data);

        // Update users table
        $user = array(

            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),

            'password' => md5($this->input->post('password')),

            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),

            'status' => 1
        );

        $this->db
            ->where('company_id', $this->session->userdata('company_id'))
            ->where('role', 'customer')
            ->where('email', $this->input->post('email'))
            ->update('users', $user);

        $this->session->set_flashdata('success', 'Customer updated successfully.');

        redirect('customer');
    }

    public function delete($id)
    {
        // Get customer details
        $customer = $this->db
            ->where('id', $id)
            ->where('company_id', $this->session->userdata('company_id'))
            ->get('customers')
            ->row();

        if (!$customer) {
            show_404();
        }

        // Delete from users table
        $this->db
            ->where('email', $customer->email)
            ->where('role', 'customer')
            ->delete('users');

        // Delete from customers table
        $this->Customer_model->delete($id);

        $this->session->set_flashdata('success', 'Customer deleted successfully.');

        redirect('customer');
    }


    // sub user section 


    public function add_subcustomer($customer_id)
    {
        $data['customer_id'] = $customer_id;

        $this->load->view('admin/header');
        $this->load->view('admin/subcustomer_add', $data);
        $this->load->view('admin/footer');
    }

    public function insert_subcustomer()
    {
        $data = array(

            'customer_id' => $this->input->post('customer_id'),

            'name' => $this->input->post('name'),

            'email' => $this->input->post('email'),

            'mobile' => $this->input->post('mobile'),

            'password' => md5(
                $this->input->post('password')
            ),

            'type' => $this->input->post('type'),

            'status' => $this->input->post('status')
        );

        $this->db->insert(
            'sub_customers',
            $data
        );

        redirect(
            'customer/subcustomer_list/' .
            $this->input->post('customer_id')
        );
    }

    public function subcustomer_list($customer_id)
    {
        $data['customer'] = $this->Customer_model->getById($customer_id);

        $data['users'] = $this->db
            ->where('customer_id', $customer_id)
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->get('sub_customers')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/subcustomer_list', $data);
        $this->load->view('admin/footer');
    }
    public function edit_subcustomer($id)
    {
        $data['user'] =
            $this->db
                ->where('id', $id)
                ->where(
                    'company_id',
                    $this->session->userdata('company_id')
                )
                ->get('sub_customers')
                ->row();

        $this->load->view('admin/header');
        $this->load->view(
            'admin/subcustomer_edit',
            $data
        );
        $this->load->view('admin/footer');
    }
    public function update_subcustomer($id)
    {
        $data = [
            'company_id' => $this->session->userdata('company_id'),
            'name' => $this->input->post('name'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'type' => $this->input->post('type'),
            'status' => $this->input->post('status')
        ];

        $this->db
            ->where('id', $id)
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            );
        $this->db->update('sub_customers', $data);

        redirect(
            'customer/subcustomer_list/' .
            $this->input->post('customer_id')
        );
    }

    public function delete_subcustomer($id)
    {
        $user = $this->db->get_where(
            'sub_customers',
            ['id' => $id]
        )->row();

        $this->db
            ->where('id', $id)
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->delete('sub_customers');

        redirect(
            'customer/subcustomer_list/' .
            $user->customer_id
        );
    }

    public function get_cities()
    {
        $state = $this->input->get('state');

        $rows = $this->Customer_model->get_cities_by_state($state);

        echo json_encode($rows);
    }
}