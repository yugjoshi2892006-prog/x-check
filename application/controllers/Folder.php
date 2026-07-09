<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Folder_model');
    }

    public function index()
    {
        $data['folders'] = $this->Folder_model->getAll();

        $data['edit_folder'] = null;

        $this->load->view('admin/header');
        $this->load->view('admin/folder_list', $data);
        $this->load->view('admin/footer');
    }

    public function insert()
    {
        $data = array(

            'company_id' => $this->session->userdata('company_id'),

            'folder_name' => $this->input->post('folder_name'),

            'status' => $this->input->post('status')
        );
        $this->Folder_model->insert($data);

        redirect('folder');
    }

    public function edit($id)
    {
        $data['folders'] = $this->Folder_model->getAll();

        $data['edit_folder'] =
            $this->Folder_model->getById($id);

        $this->load->view('admin/header');
        $this->load->view('admin/folder_list', $data);
        $this->load->view('admin/footer');
    }

    public function update($id)
    {
        $data = array(
            'folder_name' => $this->input->post('folder_name'),
            'status' => $this->input->post('status')
        );

        $this->Folder_model->update($id, $data);

        redirect('folder');
    }

    public function delete($id)
    {
        $this->Folder_model->delete($id);

        redirect('folder');
    }
}