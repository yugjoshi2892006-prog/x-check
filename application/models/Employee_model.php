<?php

class Employee_model extends CI_Model
{
    public function getProjects($employee_id, $role = null)
    {
        if ($role === 'customer') {
            return $this->getCustomerProjects($employee_id);
        }

        $layout_company_ids = $this->db
            ->select('added_by_company_id')
            ->where('team_member_id', $employee_id)
            ->where('status', 1)
            ->get('layout_members')
            ->result();

        if (!empty($layout_company_ids)) {
            $company_ids = array_unique(array_map(function ($row) {
                return (int) $row->added_by_company_id;
            }, $layout_company_ids));

            return $this->db
                ->distinct()
                ->select('projects.*')
                ->from('projects')
                ->where_in('projects.company_id', $company_ids)
                ->order_by('projects.id', 'DESC')
                ->get()
                ->result();
        }

        return $this->db
            ->distinct()
            ->select('projects.*')
            ->from('project_team')
            ->join('projects', 'projects.id = project_team.project_id')
            ->where('project_team.team_member_id', $employee_id)
            ->get()
            ->result();
    }

    public function getCustomerProjects($user_id)
    {
        $user = $this->db
            ->where('id', $user_id)
            ->where('role', 'customer')
            ->get('users')
            ->row();

        if (!$user) {
            return [];
        }

        $customer = $this->db
            ->where('company_id', $user->company_id)
            ->where('email', $user->email)
            ->get('customers')
            ->row();

        if (!$customer) {
            return [];
        }

        return $this->db
            ->where('company_id', $user->company_id)
            ->where('customer_id', $customer->id)
            ->order_by('id', 'DESC')
            ->get('projects')
            ->result();
    }

    // Customer Layout Plans
    public function getCustomerLayouts($customer_id)
    {
        $user = $this->db
            ->where('id', $customer_id)
            ->where('role', 'customer')
            ->get('users')
            ->row();

        if (!$user) {
            return [];
        }

        $customer = $this->db
            ->where('company_id', $user->company_id)
            ->where('email', $user->email)
            ->get('customers')
            ->row();

        if (!$customer) {
            return [];
        }

        return $this->db
            ->select('layout_plans.*, customers.name as customer_name')
            ->from('layout_plans')
            ->join('customers', 'customers.id = layout_plans.customer_id', 'left')
            ->where('layout_plans.customer_id', $customer->id)
            ->order_by('layout_plans.id', 'DESC')
            ->get()
            ->result();
    }


    public function getLayoutMembers()
    {
        return $this->db
            ->where('company_id', $this->session->userdata('company_id'))
            ->order_by('role', 'ASC')
            ->get('layout_members')
            ->result();
    }

    public function getLayoutPlans()
    {
        $employee_id = $this->session->userdata('id');

        return $this->db
            ->select('layout_plans.*, customers.name as customer_name')
            ->from('layout_plans')
            ->join('customers', 'customers.id=layout_plans.customer_id', 'left')
            ->join(
                'layout_members',
                'layout_members.added_by_company_id = layout_plans.company_id'
            )
            ->where('layout_members.team_member_id', $employee_id)
            ->group_by('layout_plans.id')
            ->order_by('layout_plans.id', 'DESC')
            ->get()
            ->result();
    }
}
