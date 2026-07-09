<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_member_model extends CI_Model
{
    // Only show layout members THIS admin's company added
    public function getAll()
    {
        return $this->db
            ->select('layout_members.*, companies.company_name')
            ->from('layout_members')
            ->join('companies', 'companies.id = layout_members.company_id', 'left')
            ->where('layout_members.added_by_company_id', $this->session->userdata('company_id'))
            ->order_by('layout_members.id', 'DESC')
            ->get()
            ->result();
    }

    public function insert($data)
    {
        return $this->db->insert('layout_members', $data);
    }

    public function getById($id)
    {
        return $this->db
            ->where('id', $id)
            ->where('added_by_company_id', $this->session->userdata('company_id'))
            ->get('layout_members')
            ->row();
    }

    public function update($id, $data)
    {
        $this->db
            ->where('id', $id)
            ->where('added_by_company_id', $this->session->userdata('company_id'))
            ->update('layout_members', $data);
    }

    public function delete($id)
    {
        $this->db
            ->where('id', $id)
            ->where('added_by_company_id', $this->session->userdata('company_id'))
            ->delete('layout_members');
    }

    public function getCompanies()
    {
        return $this->db
            ->where('status', 1)
            ->order_by('company_name', 'ASC')
            ->get('companies')
            ->result();
    }

    public function getTeamMembersByCompany($company_id)
    {
        return $this->db
            ->select('id,name,email,mobile,address,city')
            ->where('company_id', $company_id)
            ->where('status', 'Active')
            ->order_by('name', 'ASC')
            ->get('team_members')
            ->result();
    }

    public function isMemberAlreadyAssigned($company_id, $member_name)
    {
        return $this->db
            ->where('added_by_company_id', $this->session->userdata('company_id'))
            ->where('company_id', $company_id)
            ->where('member_name', $member_name)
            ->count_all_results('layout_members');
    }

    public function isRoleAlreadyAssigned($role)
    {
        return $this->db
            ->where('added_by_company_id', $this->session->userdata('company_id'))
            ->where('role', $role)
            ->count_all_results('layout_members');

    }



    public function getCustomers()
    {
        return $this->db
            ->where('company_id', $this->session->userdata('company_id'))
            ->where('status', 1)
            ->order_by('name', 'ASC')
            ->get('customers')
            ->result();
    }
    public function getCustomerById($id)
    {
        return $this->db
            ->where('id', $id)
            ->where('company_id', $this->session->userdata('company_id'))
            ->get('customers')
            ->row();
    }

    // public function getLayoutMembers()
    // {
    //     return $this->db
    //         ->where('added_by_company_id', $this->session->userdata('company_id'))
    //         ->order_by('member_name', 'ASC')
    //         ->get('layout_members')
    //         ->result();
    // }

    public function insertLayoutPlan($data)
    {
        return $this->db->insert('layout_plans', $data);
    }

    public function getLayoutPlans()
    {
        return $this->db
            ->select('
            layout_plans.*,
            customers.name as customer_name
        ')
            ->from('layout_plans')
            ->join('customers', 'customers.id = layout_plans.customer_id', 'left')
            ->where('layout_plans.company_id', $this->session->userdata('company_id'))
            ->order_by('layout_plans.id', 'DESC')
            ->get()
            ->result();
    }

    public function getLayoutPlanById($id)
    {
        return $this->db
            ->select('layout_plans.*, customers.name as customer_name')
            ->from('layout_plans')
            ->join('customers', 'customers.id=layout_plans.customer_id', 'left')
            ->where('layout_plans.id', $id)
            ->where('layout_plans.company_id', $this->session->userdata('company_id'))
            ->get()
            ->row();
    }

    public function updateLayoutPlan($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->where('company_id', $this->session->userdata('company_id'))
            ->update('layout_plans', $data);
    }

    public function deleteLayoutPlan($id)
    {
        return $this->db
            ->where('id', $id)
            ->where('company_id', $this->session->userdata('company_id'))
            ->delete('layout_plans');
    }

    public function ensureLayoutProcessTable()
    {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS layout_process_reports (
                id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                company_id INT(11) NOT NULL,
                customer_id INT(11) NOT NULL,
                architect_member_id INT(11) NOT NULL,
                parent_report_id INT(11) NOT NULL DEFAULT 0,
                revision_no INT(11) NOT NULL DEFAULT 1,
                recipient_type VARCHAR(20) NOT NULL DEFAULT 'both',
                plan_title VARCHAR(255) NOT NULL,
                plan_doc VARCHAR(255) NOT NULL,
                remark TEXT NULL,
                start_date DATE NULL,
                end_date DATE NULL,
                requirements TEXT NULL,
                point_wise_report TEXT NULL,
                status VARCHAR(30) NOT NULL DEFAULT 'Submitted',
                client_remark TEXT NULL,
                pmc_remark TEXT NULL,
                approved_by INT(11) NOT NULL DEFAULT 0,
                approved_by_role VARCHAR(30) NULL,
                approved_at DATETIME NULL,
                created_at DATETIME NULL,
                updated_at DATETIME NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ");

        $columns = [
            'company_id' => "ALTER TABLE layout_process_reports ADD company_id INT(11) NOT NULL DEFAULT 0 AFTER id",
            'customer_id' => "ALTER TABLE layout_process_reports ADD customer_id INT(11) NOT NULL DEFAULT 0 AFTER company_id",
            'architect_member_id' => "ALTER TABLE layout_process_reports ADD architect_member_id INT(11) NOT NULL DEFAULT 0 AFTER customer_id",
            'parent_report_id' => "ALTER TABLE layout_process_reports ADD parent_report_id INT(11) NOT NULL DEFAULT 0 AFTER architect_member_id",
            'revision_no' => "ALTER TABLE layout_process_reports ADD revision_no INT(11) NOT NULL DEFAULT 1 AFTER parent_report_id",
            'recipient_type' => "ALTER TABLE layout_process_reports ADD recipient_type VARCHAR(20) NOT NULL DEFAULT 'both' AFTER revision_no",
            'plan_title' => "ALTER TABLE layout_process_reports ADD plan_title VARCHAR(255) NOT NULL DEFAULT '' AFTER recipient_type",
            'plan_doc' => "ALTER TABLE layout_process_reports ADD plan_doc VARCHAR(255) NOT NULL DEFAULT '' AFTER plan_title",
            'remark' => "ALTER TABLE layout_process_reports ADD remark TEXT NULL AFTER plan_doc",
            'start_date' => "ALTER TABLE layout_process_reports ADD start_date DATE NULL AFTER remark",
            'end_date' => "ALTER TABLE layout_process_reports ADD end_date DATE NULL AFTER start_date",
            'requirements' => "ALTER TABLE layout_process_reports ADD requirements TEXT NULL AFTER end_date",
            'point_wise_report' => "ALTER TABLE layout_process_reports ADD point_wise_report TEXT NULL AFTER requirements",
            'status' => "ALTER TABLE layout_process_reports ADD status VARCHAR(30) NOT NULL DEFAULT 'Submitted' AFTER point_wise_report",
            'client_remark' => "ALTER TABLE layout_process_reports ADD client_remark TEXT NULL AFTER status",
            'pmc_remark' => "ALTER TABLE layout_process_reports ADD pmc_remark TEXT NULL AFTER client_remark",
            'approved_by' => "ALTER TABLE layout_process_reports ADD approved_by INT(11) NOT NULL DEFAULT 0 AFTER pmc_remark",
            'approved_by_role' => "ALTER TABLE layout_process_reports ADD approved_by_role VARCHAR(30) NULL AFTER approved_by",
            'approved_at' => "ALTER TABLE layout_process_reports ADD approved_at DATETIME NULL AFTER approved_by_role",
            'created_at' => "ALTER TABLE layout_process_reports ADD created_at DATETIME NULL AFTER approved_at",
            'updated_at' => "ALTER TABLE layout_process_reports ADD updated_at DATETIME NULL AFTER created_at",
        ];

        foreach ($columns as $column => $sql) {
            if (!$this->db->field_exists($column, 'layout_process_reports')) {
                $this->db->query($sql);
            }
        }
    }

    public function getCurrentLayoutRole()
    {
        return $this->db
            ->where('team_member_id', $this->session->userdata('id'))
            ->where('status', 1)
            ->get('layout_members')
            ->row();
    }

    public function getLayoutProcessReports($scope = 'company')
    {
        $this->ensureLayoutProcessTable();

        $customer_id = null;

        if ($scope === 'customer') {
            $this->db->reset_query();

            $user = $this->db
                ->where('users.id', $this->session->userdata('id'))
                ->where('users.role', 'customer')
                ->get('users')
                ->row();

            if (!$user) {
                return [];
            }

            $this->db->reset_query();

            $customer = $this->db
                ->where('customers.company_id', $user->company_id)
                ->where('customers.email', $user->email)
                ->get('customers')
                ->row();

            if (!$customer) {
                return [];
            }

            $customer_id = $customer->id;
            $this->db->reset_query();
        }

        $query = $this->db
            ->select('layout_process_reports.*, customers.name as customer_name, team_members.name as architect_name')
            ->from('layout_process_reports')
            ->join('customers', 'customers.id = layout_process_reports.customer_id', 'left')
            ->join('team_members', 'team_members.id = layout_process_reports.architect_member_id', 'left');

        if ($scope === 'customer') {
            $query->where('layout_process_reports.customer_id', $customer_id);
            $query->where_in('layout_process_reports.recipient_type', ['client', 'both']);
        } elseif ($scope === 'architect') {
            $query->where('layout_process_reports.architect_member_id', $this->session->userdata('id'));
        } elseif ($scope === 'pmc') {
            $query->where_in('layout_process_reports.recipient_type', ['pmc', 'both']);
        } else {
            $query->where('layout_process_reports.company_id', $this->session->userdata('company_id'));
        }

        return $query
            ->order_by('layout_process_reports.id', 'DESC')
            ->get()
            ->result();
    }

    public function getLayoutProcessReportById($id)
    {
        $this->ensureLayoutProcessTable();

        return $this->db
            ->select('layout_process_reports.*, customers.name as customer_name, team_members.name as architect_name')
            ->from('layout_process_reports')
            ->join('customers', 'customers.id = layout_process_reports.customer_id', 'left')
            ->join('team_members', 'team_members.id = layout_process_reports.architect_member_id', 'left')
            ->where('layout_process_reports.id', $id)
            ->get()
            ->row();
    }

    // Schedule tracker shown to Architect, Client and PMC alike: how the
    // report stands against its end_date, independent of approval status.
    public function getScheduleStatus($report)
    {
        if (empty($report->end_date)) {
            return (object) ['label' => '-', 'class' => 'xc-gray'];
        }

        $end = strtotime($report->end_date);

        if ($report->status === 'Approved') {
            $finished = !empty($report->approved_at) ? strtotime($report->approved_at) : time();

            if ($finished <= strtotime(date('Y-m-d', $end) . ' 23:59:59')) {
                return (object) ['label' => 'On Time', 'class' => 'xc-green'];
            }

            $late_days = (int) ceil((strtotime(date('Y-m-d', $finished)) - strtotime(date('Y-m-d', $end))) / 86400);
            return (object) ['label' => 'Delayed by ' . $late_days . 'd', 'class' => 'xc-red'];
        }

        $today = strtotime(date('Y-m-d'));
        $end_day = strtotime(date('Y-m-d', $end));

        if ($today > $end_day) {
            $late_days = (int) ceil(($today - $end_day) / 86400);
            return (object) ['label' => 'Delay by ' . $late_days . 'd', 'class' => 'xc-red'];
        }

        if ($today === $end_day) {
            return (object) ['label' => 'Due Today', 'class' => 'xc-orange'];
        }

        $days_left = (int) ceil(($end_day - $today) / 86400);
        return (object) ['label' => $days_left . ' Days Left', 'class' => 'xc-blue'];
    }

    public function insertLayoutProcessReport($data)
    {
        $this->ensureLayoutProcessTable();
        return $this->db->insert('layout_process_reports', $data);
    }

    public function updateLayoutProcessReport($id, $data)
    {
        $this->ensureLayoutProcessTable();

        return $this->db
            ->where('id', $id)
            ->update('layout_process_reports', $data);
    }

}