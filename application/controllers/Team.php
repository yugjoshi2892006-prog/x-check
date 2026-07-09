<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Team_model');
    }

    public function index()
    {
        $data['team'] = $this->Team_model->getAll();

        $this->load->view('admin/header');
        $this->load->view('admin/team_list', $data);
        $this->load->view('admin/footer');
    }

    public function add()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/team_add');
        $this->load->view('admin/footer');
    }

    public function insert()
    {
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

            'is_senior' => $this->input->post('is_senior') ? 1 : 0,
            'is_project_manager' => $this->input->post('is_project_manager') ? 1 : 0,
            'is_site_engineer' => $this->input->post('is_site_engineer') ? 1 : 0,

            'status' => $this->input->post('status')
        );

        $this->Team_model->insert($data);

        redirect('team');
    }

    public function edit($id)
    {
        $data['member'] = $this->Team_model->getById($id);

        $this->load->view('admin/header');
        $this->load->view('admin/team_edit', $data);
        $this->load->view('admin/footer');
    }
    public function update($id)
    {
        $data = array(

            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),

            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address'),

            'is_senior' => $this->input->post('is_senior') ? 1 : 0,
            'is_project_manager' => $this->input->post('is_project_manager') ? 1 : 0,
            'is_site_engineer' => $this->input->post('is_site_engineer') ? 1 : 0,

            'status' => $this->input->post('status')
        );

        $this->Team_model->update($id, $data);

        redirect('team');
    }

    public function delete($id)
    {
        $this->Team_model->delete($id);

        redirect('team');
    }
}