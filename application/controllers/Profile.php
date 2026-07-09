<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Profile_model');
    }

    public function index()
    {
        $data['profile'] =
            $this->Profile_model->getProfile();


        $this->load->view('admin/header');
        $this->load->view('admin/profile', $data);
        $this->load->view('admin/footer');
    }

    public function save()
    {

        $profile = $this->Profile_model->getProfile();


        $user_id = $this->session->userdata('id');
        $company_id = $this->session->userdata('company_id');

        $data = [

            'company_name' => $this->input->post('company_name'),
            'contact_person' => $this->input->post('contact_person'),
            'mobile' => $this->input->post('mobile'),
            'email' => $this->input->post('email'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address'),
            'zipcode' => $this->input->post('zipcode'),
            'gst_number' => $this->input->post('gst_number'),
            'tax_id' => $this->input->post('tax_id'),
            'industry_type' => $this->input->post('industry_type'),

            'user_id' => $user_id,
            'company_id' => $company_id
        ];

        /* Image Upload */

        if (!empty($_FILES['profile_image']['name'])) {

            if (!is_dir('./assets/uploads/profile/')) {
                mkdir('./assets/uploads/profile/', 0777, true);
            }

            $config['upload_path'] = './assets/uploads/profile/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 10240;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_image')) {

                $uploadData = $this->upload->data();

                $data['profile_image'] = $uploadData['file_name'];

            } else {

                echo $this->upload->display_errors();
                exit;
            }
        }

        if ($profile) {

            $this->Profile_model->update(
                $profile->id,
                $data
            );

        } else {

            $this->Profile_model->insert(
                $data
            );
        }
        $this->db
            ->where('id', $user_id)
            ->update('users', [
                'name' => $this->input->post('contact_person'),
                'email' => $this->input->post('email')
            ]);

        $this->session->set_userdata([
            'name' => $this->input->post('contact_person'),
            'email' => $this->input->post('email')
        ]);

        redirect('profile');


    }

}