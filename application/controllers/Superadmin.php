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

        $this->load->model('Plan_model');
    }

    public function dashboard()
    {
        $this->load->view('superadmin/header');
        $this->load->view('superadmin/dashboard');
        $this->load->view('superadmin/footer');
    }

    public function companies()
    {
        $data['companies'] = $this->db->order_by('company_name', 'ASC')->get('companies')->result();
        $this->load->view('superadmin/header', $data);
        $this->load->view('superadmin/companies', $data);
        $this->load->view('superadmin/footer');
    }

    public function plans()
    {
        $data['plans'] = $this->Plan_model->getAllPlans();
        $this->load->view('superadmin/header', $data);
        $this->load->view('superadmin/plan_list', $data);
        $this->load->view('superadmin/footer');
    }

    public function add_plan()
    {
        $data['plan'] = null;
        $data['form_action'] = 'superadmin/save_plan';

        $this->load->view('superadmin/header', $data);
        $this->load->view('superadmin/plan_form', $data);
        $this->load->view('superadmin/footer');
    }

    public function save_plan()
    {
        $plan_data = [
            'plan_name' => $this->input->post('plan_name'),
            'duration_days' => (int) $this->input->post('duration_days'),
            'amount' => (float) $this->input->post('amount'),
            'status' => $this->input->post('status') === 'Inactive' ? 'Inactive' : 'Active'
        ];

        $this->Plan_model->createPlan($plan_data);
        $this->session->set_flashdata('success', 'Plan created successfully.');
        redirect('superadmin/plans');
    }

    public function edit_plan($plan_id = 0)
    {
        $plan = $this->Plan_model->getPlanById((int) $plan_id);

        if (!$plan) {
            show_404();
        }

        $data['plan'] = $plan;
        $data['form_action'] = 'superadmin/update_plan/' . $plan->id;

        $this->load->view('superadmin/header', $data);
        $this->load->view('superadmin/plan_form', $data);
        $this->load->view('superadmin/footer');
    }

    public function update_plan($plan_id = 0)
    {
        $plan_id = (int) $plan_id;
        $plan_data = [
            'plan_name' => $this->input->post('plan_name'),
            'duration_days' => (int) $this->input->post('duration_days'),
            'amount' => (float) $this->input->post('amount'),
            'status' => $this->input->post('status') === 'Inactive' ? 'Inactive' : 'Active'
        ];

        $this->Plan_model->updatePlan($plan_id, $plan_data);
        $this->session->set_flashdata('success', 'Plan updated successfully.');
        redirect('superadmin/plans');
    }

    public function delete_plan($plan_id = 0)
    {
        $plan_id = (int) $plan_id;

        if ($plan_id > 0) {
            $this->Plan_model->deletePlan($plan_id);
            $this->session->set_flashdata('success', 'Plan deleted successfully.');
        }

        redirect('superadmin/plans');
    }

    public function company_status($company_id = 0, $status = 0)
    {
        $company_id = (int) $company_id;
        $status = (int) $status;

        if ($company_id <= 0) {
            redirect('superadmin/companies');
        }

        $status = $status === 1 ? 1 : 0;

        $this->db->where('id', $company_id)->update('companies', ['status' => $status]);

        $this->session->set_flashdata('success', 'Company status has been updated successfully.');
        redirect('superadmin/companies');
    }
}