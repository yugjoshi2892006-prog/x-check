<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Get all active plans
    public function getActivePlans()
    {
        return $this->db
            ->where('status', 'Active')
            ->get('plans')
            ->result();
    }

    // Get active plan of logged in company
    public function getCompanyActivePlan($company_id)
    {
        return $this->db
            ->where('company_id', $company_id)
            ->where('status', 'Active')
            ->where('expiry_date >=', date('Y-m-d'))
            ->get('company_plans')
            ->row();
    }

    // Check active plan
    public function hasActivePlan($company_id)
    {
        return $this->db
            ->where('company_id', $company_id)
            ->where('status', 'Active')
            ->where('expiry_date >=', date('Y-m-d'))
            ->get('company_plans')
            ->row();
    }

    // Get plan by ID
    public function getPlan($plan_id)
    {
        return $this->db
            ->where('id', $plan_id)
            ->where('status', 'Active')
            ->get('plans')
            ->row();
    }

    public function getPaymentHistory($company_id)
    {
        return $this->db
            ->select('
            payments.*,
            plans.plan_name,
            plans.duration_days
        ')
            ->from('payments')
            ->join('plans', 'plans.id=payments.plan_id')
            ->where('payments.company_id', $company_id)
            ->order_by('payments.id', 'DESC')
            ->get()
            ->result();
    }



}