<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Layout_member_model');
        $this->Layout_member_model->ensureLayoutProcessTable();
    }

    // List
    public function index()
    {
        $data['members'] = $this->Layout_member_model->getAll();

        $this->load->view('admin/header');
        $this->load->view('admin/layout_member_list', $data);
        $this->load->view('admin/footer');
    }

    // Add Page
    public function add()
    {
        $data['companies'] = $this->Layout_member_model->getCompanies();

        $this->load->view('admin/header');
        $this->load->view('admin/layout_member', $data);
        $this->load->view('admin/footer');
    }




    public function get_team_members()
    {
        $company_id = $this->input->post('company_id');

        if (!$company_id) {
            echo json_encode([]);
            return;
        }

        $members = $this->Layout_member_model->getTeamMembersByCompany($company_id);

        echo json_encode($members);
    }


    // Save
    public function save()
    {
        $company_id = $this->input->post('company_id');       // source company (team member ka)
        $member_name = $this->input->post('member_name');

        if ($this->Layout_member_model->isMemberAlreadyAssigned($company_id, $member_name)) {
            $this->session->set_flashdata('error', 'This employee already has a layout role.');
            redirect('layout_member/add');
        }

        $company = $this->db->where('id', $company_id)->get('companies')->row();

        // Fetch owner (logged-in admin's) company fresh from DB — don't rely only on session
        $owner_company_id = $this->session->userdata('company_id');
        $owner_company = $this->db->where('id', $owner_company_id)->get('companies')->row();
        $owner_company_name = $owner_company ? $owner_company->company_name : '';

        // --- Server-side fallback for team_member_id ---
        // The dropdown can post an empty/0 value if the company select gets
        // changed again after a member was picked (rebuilds the member
        // dropdown via AJAX and resets it). Don't trust the posted value
        // blindly — if it's missing or 0, look the real team_members.id up
        // ourselves using the posted email + company_id, which are reliable.
        $team_member_id = (int) $this->input->post('team_member_id');
        $posted_email = $this->input->post('email');

        if (!$team_member_id) {
            $matched_member = $this->db
                ->where('company_id', $company_id)
                ->where('email', $posted_email)
                ->get('team_members')
                ->row();

            if ($matched_member) {
                $team_member_id = (int) $matched_member->id;
            }
        }

        $data = array(
            'company_id' => $company->id,
            'company_name' => $company->company_name,

            'added_by_company_id' => $owner_company_id,
            'layout_company_name' => $owner_company_name,

            'member_name' => $member_name,
            'team_member_id' => $team_member_id,
            'location' => $this->input->post('location'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role'),
            'status' => $this->input->post('status'),

        );

        $this->Layout_member_model->insert($data);

        $this->session->set_flashdata('success', 'Layout Member Added Successfully');
        redirect('layout_member');
    }
    // Edit Page


    // Update
    // public function update($id)
    // {
    //     $data = array(

    //         'company_name' => $this->input->post('company_name'),

    //         'member_name' => $this->input->post('member_name'),

    //         'location' => $this->input->post('location'),

    //         'address' => $this->input->post('address'),

    //         'email' => $this->input->post('email'),

    //         'phone' => $this->input->post('phone'),

    //         'role' => $this->input->post('role'),

    //         'status' => $this->input->post('status')

    //     );

    //     $this->Layout_member_model->update($id, $data);

    //     $this->session->set_flashdata('success', 'Updated Successfully');

    //     redirect('layout_member');
    // }

    // Delete
    public function delete($id)
    {
        $this->Layout_member_model->delete($id);

        $this->session->set_flashdata('success', 'Deleted Successfully');

        redirect('layout_member');
    }





    public function edit($id)
    {
        $data['member'] = $this->Layout_member_model->getById($id);

        if (!$data['member']) {

            $this->session->set_flashdata('error', 'Member not found.');

            redirect('layout_member');

        }

        $data['companies'] = $this->Layout_member_model->getCompanies();

        $data['team_members'] = $this->Layout_member_model
            ->getTeamMembersByCompany($data['member']->company_id);

        $this->load->view('admin/header');
        $this->load->view('admin/layout_member_edit', $data);
        $this->load->view('admin/footer');
    }








    public function check_role_exists()
    {
        $role = $this->input->post('role');

        $exists = $this->Layout_member_model->isRoleAlreadyAssigned($role) > 0;

        echo json_encode(['exists' => $exists]);
    }

    public function update($id)
    {
        $company = $this->db
            ->where('id', $this->input->post('company_id'))
            ->get('companies')
            ->row();

        $data = array(

            'company_id' => $company->id,
            'company_name' => $company->company_name,

            'member_name' => $this->input->post('member_name'),
            'team_member_id' => $this->input->post('team_member_id'),
            'location' => $this->input->post('location'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role'),
            'status' => $this->input->post('status')

        );

        $this->Layout_member_model->update($id, $data);

        $this->session->set_flashdata('success', 'Layout Member Updated Successfully');

        redirect('layout_member');
    }




    public function layout_plan_list()
    {
        $data['plans'] = $this->Layout_member_model->getLayoutPlans();

        $this->load->view('admin/header');
        $this->load->view('admin/layout_plan_list', $data);
        $this->load->view('admin/footer');
    }

    public function layout_process()
    {
        $data['reports'] = $this->Layout_member_model->getLayoutProcessReports('company');

        $this->load->view('admin/header');
        $this->load->view('admin/layout_process', $data);
        $this->load->view('admin/footer');
    }

    // Card-wise view of the full flow (Architect -> Structural -> Interior
    // -> Electrical -> PHE -> Landscape -> HVAC -> Liasoning) for this
    // admin's company, one card per stage.
    public function layout_process_flow($customer_id = 0)
    {
        $company_id = $this->session->userdata('company_id');

        $data['scopes'] = $this->Layout_member_model->getFlowScopes($company_id);

        if (!$customer_id && !empty($data['scopes'])) {
            $customer_id = $data['scopes'][0]->customer_id;
        }

        $data['customer_id'] = $customer_id;
        $data['flow'] = ($company_id && $customer_id)
            ? $this->Layout_member_model->getLayoutFlow($company_id, $customer_id)
            : [];

        $this->load->view('admin/header');
        $this->load->view('admin/layout_process_flow', $data);
        $this->load->view('admin/footer');
    }




    public function layout_plan_add()
    {
        $data['customers'] = $this->Layout_member_model->getCustomers();
        // $data['members'] = $this->Layout_member_model->getLayoutMembers();

        $this->load->view('admin/header');
        $this->load->view('admin/layout_plan_add', $data);
        $this->load->view('admin/footer');
    }
    public function get_customer_details()
    {
        $id = $this->input->post('customer_id');

        $customer = $this->Layout_member_model->getCustomerById($id);

        echo json_encode($customer);
    }


    public function save_layout_plan()
    {
        $company_id = $this->session->userdata('company_id');

        if (!$company_id) {
            $this->session->set_flashdata('error', 'Unable to determine your company. Please login again and try again.');
            redirect('layout_member/layout_plan_add');
        }

        // If the combined upload size crossed PHP's post_max_size, PHP
        // silently empties $_POST and $_FILES before this method even
        // runs - every field (customer_id, plan_name, files) arrives
        // empty, which is what caused the raw "customer_id cannot be
        // null" database error instead of a clear message. Catch that
        // case here first.
        if (post_size_exceeded()) {
            $this->session->set_flashdata(
                'error',
                'The files you selected are too large for this server to accept (upload limit exceeded). Please upload smaller files, or ask your admin to raise upload_max_filesize / post_max_size in php.ini.'
            );
            redirect('layout_member/layout_plan_add');
        }

        $customer_id = $this->input->post('customer_id');
        $plan_name = trim((string) $this->input->post('plan_name'));

        if (!$customer_id) {
            $this->session->set_flashdata('error', 'Please select a Client before saving the Layout Plan.');
            redirect('layout_member/layout_plan_add');
        }

        if ($plan_name === '') {
            $this->session->set_flashdata('error', 'Plan Name is required.');
            redirect('layout_member/layout_plan_add');
        }

        // Ensure the upload library is available before any initialize() call.
        $this->load->library('upload');

        // Track every file we successfully save to disk in this request so
        // that if a LATER upload step fails, we can roll back (delete) the
        // ones already written instead of leaving orphan files behind with
        // no matching DB row.
        $uploaded_paths = [];

        // ---------------- Drawing Upload ----------------
        $drawing = "";

        if (!empty($_FILES['drawing_file']['name'])) {

            $config['upload_path'] = FCPATH . 'uploads/layout_plan/drawing/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['encrypt_name'] = TRUE;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }
            if (!is_dir($config['upload_path'])) {
                $this->session->set_flashdata('error', 'Upload directory is not available: ' . $config['upload_path']);
                redirect('layout_member/layout_plan_add');
            }

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('drawing_file')) {

                $drawing = $this->upload->data('file_name');
                $uploaded_paths[] = $config['upload_path'] . $drawing;

            } else {

                $this->_cleanup_uploaded_files($uploaded_paths);
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('layout_member/layout_plan_add');
            }
        }

        // ---------------- Layout Photo ----------------

        $photo = "";

        if (!empty($_FILES['layout_photo']['name'])) {

            $config['upload_path'] = FCPATH . 'uploads/layout_plan/photo/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['encrypt_name'] = TRUE;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }
            if (!is_dir($config['upload_path'])) {
                $this->session->set_flashdata('error', 'Upload directory is not available: ' . $config['upload_path']);
                redirect('layout_member/layout_plan_add');
            }

            $this->upload->initialize($config);

            if ($this->upload->do_upload('layout_photo')) {

                $photo = $this->upload->data('file_name');
                $uploaded_paths[] = $config['upload_path'] . $photo;

            } else {

                $this->_cleanup_uploaded_files($uploaded_paths);
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('layout_member/layout_plan_add');
            }
        }

        // ---------------- Soil PDF ----------------

        $soil = "";

        if (!empty($_FILES['soil_test_pdf']['name'])) {

            $config['upload_path'] = FCPATH . 'uploads/layout_plan/soil/';
            $config['allowed_types'] = 'pdf';
            $config['encrypt_name'] = TRUE;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0755, true);
            }
            if (!is_dir($config['upload_path'])) {
                $this->session->set_flashdata('error', 'Upload directory is not available: ' . $config['upload_path']);
                redirect('layout_member/layout_plan_add');
            }

            $this->upload->initialize($config);

            if ($this->upload->do_upload('soil_test_pdf')) {

                $soil = $this->upload->data('file_name');
                $uploaded_paths[] = $config['upload_path'] . $soil;

            } else {

                $this->_cleanup_uploaded_files($uploaded_paths);
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('layout_member/layout_plan_add');
            }
        }

        // ---------------- Save ----------------

        $data = array(

            'company_id' => $company_id,

            'customer_id' => $customer_id,

            'plan_name' => $plan_name,

            'drawing_file' => $drawing,

            'layout_photo' => $photo,

            'soil_test_pdf' => $soil,

            'requirement' => $this->input->post('requirement')

        );

        if (!$this->Layout_member_model->insertLayoutPlan($data)) {

            $this->_cleanup_uploaded_files($uploaded_paths);

            $db_error = $this->db->error();
            $this->session->set_flashdata(
                'error',
                'Failed to save Layout Plan. ' . ($db_error['message'] ?: 'Please try again.')
            );
            redirect('layout_member/layout_plan_add');
        }

        $this->session->set_flashdata('success', 'Layout Plan Added Successfully');

        redirect('layout_member/layout_plan_list');
    }

    // Deletes any files this request already wrote to disk. Used when a
    // later step in save_layout_plan() fails (bad filetype, DB error, etc.)
    // so we don't leave orphan uploads with no matching layout_plans row.
    private function _cleanup_uploaded_files($paths)
    {
        foreach ($paths as $path) {
            if (file_exists($path)) {
                @unlink($path);
            }
        }
    }



    public function layout_plan_view($id)
    {
        $data['plan'] = $this->Layout_member_model->getLayoutPlanById($id);

        if (!$data['plan']) {
            show_404();
        }

        $data['customer'] = $this->Layout_member_model->getCustomerById($data['plan']->customer_id);

        $this->load->view('admin/header');
        $this->load->view('admin/layout_plan_view', $data);
        $this->load->view('admin/footer');
    }


    public function layout_plan_edit($id)
    {
        $data['plan'] = $this->Layout_member_model->getLayoutPlanById($id);

        if (!$data['plan']) {
            show_404();
        }

        $data['customers'] = $this->Layout_member_model->getCustomers();

        $this->load->view('admin/header');
        $this->load->view('admin/layout_plan_edit', $data);
        $this->load->view('admin/footer');
    }
    public function delete_layout_plan($id)
    {
        $plan = $this->Layout_member_model->getLayoutPlanById($id);

        if (!$plan) {
            $this->session->set_flashdata('error', 'Layout Plan not found.');
            redirect('layout_member/layout_plan_list');
        }

        // Delete Drawing
        if (
            !empty($plan->drawing_file) &&
            file_exists('./uploads/layout_plan/drawing/' . $plan->drawing_file)
        ) {

            unlink('./uploads/layout_plan/drawing/' . $plan->drawing_file);
        }

        // Delete Layout Photo
        if (
            !empty($plan->layout_photo) &&
            file_exists('./uploads/layout_plan/photo/' . $plan->layout_photo)
        ) {

            unlink('./uploads/layout_plan/photo/' . $plan->layout_photo);
        }

        // Delete Soil Test PDF
        if (
            !empty($plan->soil_test_pdf) &&
            file_exists('./uploads/layout_plan/soil/' . $plan->soil_test_pdf)
        ) {

            unlink('./uploads/layout_plan/soil/' . $plan->soil_test_pdf);
        }

        // Delete Database Record
        $this->Layout_member_model->deleteLayoutPlan($id);

        $this->session->set_flashdata('success', 'Layout Plan Deleted Successfully.');

        redirect('layout_member/layout_plan_list');
    }
}