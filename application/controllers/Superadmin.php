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
        $today = date('Y-m-d');
        $data['total_companies'] = $this->db->count_all('companies');
        $data['active_companies'] = $this->db->where('status', 1)->count_all_results('companies');
        $data['total_plans'] = $this->db->count_all('plans');
        $data['active_plans'] = $this->db
            ->where('status', 'Active')
            ->where('expiry_date >=', $today)
            ->count_all_results('company_plans');
        $data['total_payments'] = $this->db->count_all('payments');
        $data['inactive_companies'] = $this->db->where('status !=', 1)->count_all_results('companies');

        $this->load->view('superadmin/header', $data);
        $this->load->view('superadmin/dashboard', $data);
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
        $plan_data = $this->plan_payload();

        if ($plan_data['plan_name'] === '' || $plan_data['duration_days'] < 1 || $plan_data['amount'] < 0) {
            $this->session->set_flashdata('error', 'Please enter a plan name, valid duration and price.');
            redirect('superadmin/plan/add');
        }

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
        $plan_data = $this->plan_payload();

        if ($plan_id <= 0 || $plan_data['plan_name'] === '' || $plan_data['duration_days'] < 1 || $plan_data['amount'] < 0) {
            $this->session->set_flashdata('error', 'Please enter a plan name, valid duration and price.');
            redirect('superadmin/plans');
        }

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

    private function plan_payload()
    {
        return [
            'plan_name' => trim((string) $this->input->post('plan_name', true)),
            'duration_days' => max(0, (int) $this->input->post('duration_days')),
            'amount' => max(0, (float) $this->input->post('amount')),
            'customer_limit' => max(0, (int) $this->input->post('customer_limit')),
            'team_limit' => max(0, (int) $this->input->post('team_limit')),
            'project_limit' => max(0, (int) $this->input->post('project_limit')),
            'status' => $this->input->post('status') === 'Inactive' ? 'Inactive' : 'Active'
        ];
    }
}
