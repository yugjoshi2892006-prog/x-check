<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '../vendor/autoload.php';

use Razorpay\Api\Api;



class Plan extends CI_Controller
{
    public function index()
    {
        $company_id = $this->session->userdata('company_id');

        $data['plans'] = $this->Plan_model->getActivePlans();

        $data['active_plan'] = $this->Plan_model->getCompanyActivePlan($company_id);

        $this->load->view('admin/header');
        $this->load->view('admin/plan_list', $data);
        $this->load->view('admin/footer');
    }
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Plan_model');

        if (!$this->session->userdata('company_id')) {
            redirect('auth');
        }
    }

    public function buy($plan_id)
    {
        $company_id = $this->session->userdata('company_id');

        // Check Active Plan
        $active_plan = $this->Plan_model->hasActivePlan($company_id);

        if ($active_plan) {

            $this->session->set_flashdata(
                'plan_error',
                'Your current plan is active until '
                . date('d M Y', strtotime($active_plan->expiry_date)) .
                '. Please wait until it expires before purchasing another plan.'
            );

            redirect('plan');
        }

        // Razorpay Config
        $this->config->load('razorpay');

        $key_id = $this->config->item('key_id');
        $key_secret = $this->config->item('key_secret');

        // $plan = $this->db->where('id', $plan_id)->get('plans')->row();
        $plan = $this->Plan_model->getPlan($plan_id);

        if (!$plan) {
            show_error('Plan not found');
        }

        $api = new Api($key_id, $key_secret);

        $order = $api->order->create([
            'receipt' => 'PLAN_' . $plan->id . '_' . time(),
            'amount' => (int) ($plan->amount * 100),
            'currency' => 'INR'
        ]);

        $data['plan'] = $plan;
        $data['order'] = $order;
        $data['key'] = $key_id;

        $this->load->view('admin/payment', $data);
    }




    public function payment_success()
    {
        $payment_id = $this->input->get('payment_id');
        $order_id = $this->input->get('order_id');
        $signature = $this->input->get('signature');
        $plan_id = $this->input->get('plan_id');

        if (!$payment_id || !$order_id || !$plan_id) {
            show_error('Invalid payment response.');
        }

        $company_id = $this->session->userdata('company_id');

        $plan = $this->db
            ->where('id', $plan_id)
            ->where('status', 'Active')
            ->get('plans')
            ->row();

        if (!$plan) {
            show_error('Plan not found.');
        }

        // -------------------------
        // Save Payment History
        // -------------------------
        $this->db->insert('payments', [
            'company_id' => $company_id,
            'plan_id' => $plan_id,
            'razorpay_payment_id' => $payment_id,
            'razorpay_order_id' => $order_id,
            'razorpay_signature' => $signature,
            'amount' => $plan->amount,
            'payment_status' => 'Success',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        // -------------------------
        // Expire old active plan
        // -------------------------
        $this->db->where('company_id', $company_id);
        $this->db->where('status', 'Active');
        $this->db->update('company_plans', [
            'status' => 'Expired'
        ]);

        // -------------------------
        // Activate new plan
        // -------------------------
        $start_date = date('Y-m-d');
        $expiry_date = date(
            'Y-m-d',
            strtotime("+{$plan->duration_days} days")
        );

        $this->db->insert('company_plans', [
            'company_id' => $company_id,
            'plan_id' => $plan_id,
            'start_date' => $start_date,
            'expiry_date' => $expiry_date,
            'payment_status' => 'Paid',
            'status' => 'Active'
        ]);

        $this->session->set_flashdata(
            'success',
            'Plan purchased successfully.'
        );

        redirect('admin/dashboard');
    }

        public function payment_history()
    {
        $company_id = $this->session->userdata('company_id');

        $data['payments'] = $this->Plan_model->getPaymentHistory($company_id);

        $this->load->view('admin/header');
        $this->load->view('admin/payment_history', $data);
        $this->load->view('admin/footer');
    }
}


