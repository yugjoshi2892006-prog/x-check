<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_member_model extends CI_Model
{
    // Sequential stage flow, per Yug's flow diagram:
    // Architect -> (Client/PMC approval) -> Structure -> Interior -> ...
    public static $STAGE_ORDER = [
        'Architect',
        'Structure Consultant',
        'Interior Designer',
        'Electrical Consultant',
        'PHE Consultant',
        'Landscape Consultant',
        'HVAC Consultant',
        'Liasoning',
    ];

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

    // Plans available for a given layout-company + client pairing, used to
    // populate the "Select Plan Name" dropdown on the Layout Process form
    // so the Architect picks from plans that were actually set up for this
    // client, instead of retyping a free-text name.
    public function getLayoutPlansForCustomer($company_id, $customer_id)
    {
        return $this->db
            ->where('company_id', $company_id)
            ->where('customer_id', $customer_id)
            ->order_by('plan_name', 'ASC')
            ->get('layout_plans')
            ->result();
    }

    // Distinct plan titles already used in previously-submitted Layout
    // Process reports for this client — covers older/free-text titles
    // (e.g. "phase 1") that were submitted before a formal Layout Plan
    // record existed for them, so they still show up as pickable options
    // instead of forcing the architect to retype them.
    public function getDistinctPlanTitlesForCustomer($company_id, $customer_id)
    {
        return $this->db
            ->distinct()
            ->select('plan_title')
            ->where('company_id', $company_id)
            ->where('customer_id', $customer_id)
            ->where('plan_title !=', '')
            ->order_by('plan_title', 'ASC')
            ->get('layout_process_reports')
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

            // Which stage of the flow this submission belongs to (Architect,
            // Structure Consultant, Interior Designer, ...). Drives the
            // sequential card flow in layout_process_flow().
            'stage' => "ALTER TABLE layout_process_reports ADD stage VARCHAR(50) NOT NULL DEFAULT 'Architect' AFTER architect_member_id",

            // Dual sign-off: Client and PMC each act independently. The
            // shared `status` column only resolves to Approved/Remarked
            // once BOTH have responded - see recomputeOverallStatus(). Only
            // once a stage is Approved does the next stage in the flow
            // unlock for its member to submit.
            'client_status' => "ALTER TABLE layout_process_reports ADD client_status VARCHAR(20) NOT NULL DEFAULT 'Pending' AFTER pmc_remark",
            'client_acted_by' => "ALTER TABLE layout_process_reports ADD client_acted_by INT(11) NULL AFTER client_status",
            'client_acted_at' => "ALTER TABLE layout_process_reports ADD client_acted_at DATETIME NULL AFTER client_acted_by",
            'pmc_status' => "ALTER TABLE layout_process_reports ADD pmc_status VARCHAR(20) NOT NULL DEFAULT 'Pending' AFTER client_acted_at",
            'pmc_acted_by' => "ALTER TABLE layout_process_reports ADD pmc_acted_by INT(11) NULL AFTER pmc_status",
            'pmc_acted_at' => "ALTER TABLE layout_process_reports ADD pmc_acted_at DATETIME NULL AFTER pmc_acted_by",

            // Triple sign-off for the Structure Consultant stage only:
            // Architect also has to review, in addition to Client + PMC.
            // For every other stage this stays 'Not Required' and is
            // ignored by recomputeOverallStatus().
            'architect_status' => "ALTER TABLE layout_process_reports ADD architect_status VARCHAR(20) NOT NULL DEFAULT 'Not Required' AFTER pmc_acted_at",
            'architect_acted_by' => "ALTER TABLE layout_process_reports ADD architect_acted_by INT(11) NULL AFTER architect_status",
            'architect_acted_at' => "ALTER TABLE layout_process_reports ADD architect_acted_at DATETIME NULL AFTER architect_acted_by",
            'architect_remark' => "ALTER TABLE layout_process_reports ADD architect_remark TEXT NULL AFTER architect_acted_at",
        ];

        $architect_status_just_added = !$this->db->field_exists('architect_status', 'layout_process_reports');

        foreach ($columns as $column => $sql) {
            if (!$this->db->field_exists($column, 'layout_process_reports')) {
                $this->db->query($sql);
            }
        }

        // One-time backfill, the moment this column is first created: any
        // Structure Consultant submission still awaiting Client/PMC (i.e.
        // not yet Approved/Remarked) also needs the Architect's sign-off
        // going forward, not just brand-new submissions made after this
        // update.
        if ($architect_status_just_added) {
            $this->db
                ->where('stage', 'Structure Consultant')
                ->where('status', 'Pending Review')
                ->update('layout_process_reports', ['architect_status' => 'Pending']);
        }
    }

    // ---------------- Final Project (Architect -> Structural handoff) ----------------
    // After Client + PMC approve the Architect's stage, the Architect fills
    // this one lightweight form (Project Name, Final Doc, Notes). Saving it
    // is what actually hands the flow off to the Structure Consultant -
    // see getLayoutFlow(), where the next stage only unlocks once a row
    // exists here for that customer.
    public function ensureLayoutFinalProjectsTable()
    {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS layout_final_projects (
                id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                company_id INT(11) NOT NULL,
                customer_id INT(11) NOT NULL,
                architect_report_id INT(11) UNSIGNED NOT NULL,
                project_name VARCHAR(255) NOT NULL,
                final_doc VARCHAR(255) NOT NULL,
                notes TEXT NULL,
                added_by INT(11) NOT NULL,
                created_at DATETIME NOT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ");
    }

    public function insertFinalProject($data)
    {
        $this->ensureLayoutFinalProjectsTable();
        return $this->db->insert('layout_final_projects', $data);
    }

    // Latest Final Project record for this company+customer, or null if
    // the Architect hasn't submitted one yet (i.e. Structural is still
    // locked).
    public function getFinalProjectForCustomer($company_id, $customer_id)
    {
        $this->ensureLayoutFinalProjectsTable();

        return $this->db
            ->where('company_id', $company_id)
            ->where('customer_id', $customer_id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('layout_final_projects')
            ->row();
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

        // Resolve this BEFORE starting the main query below — calling
        // getCurrentLayoutRole() (its own where()/get()) *while* the main
        // query builder is mid-chain corrupts it, since CodeIgniter's
        // active record builder is stateful on $this->db. That's what
        // caused "Column 'status' in where clause is ambiguous".
        $layout_company_id = null;
        if ($scope === 'pmc' || $scope === 'architect') {
            $layout_role = $this->getCurrentLayoutRole();
            $layout_company_id = $layout_role ? $layout_role->added_by_company_id : 0;
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
            // Any non-PMC layout member (Architect, Structure Consultant,
            // Interior Designer, ...) sees the FULL flow history for their
            // company — every stage, every revision — not just their own
            // submissions, so they can see how the project got to them.
            $query->where('layout_process_reports.company_id', $layout_company_id);
        } elseif ($scope === 'pmc') {
            $query->where('layout_process_reports.company_id', $layout_company_id);
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

    // Sign-off gate: a submission only resolves out of "Pending Review" -
    // and only then does the Architect / next stage see a final result -
    // once every required reviewer has responded, either by approving or
    // by sending a remark. One side acting alone is never enough to flip
    // the report to Approved or Remarked.
    //
    // Every stage needs Client + PMC. The Structure Consultant stage
    // additionally needs the Architect (3 reviewers total) - see
    // isArchitectReviewRequired().
    public function recomputeOverallStatus($id)
    {
        $this->ensureLayoutProcessTable();

        $report = $this->db->where('id', $id)->get('layout_process_reports')->row();

        if (!$report) {
            return;
        }

        $client_done = in_array($report->client_status, ['Approved', 'Remarked']);
        $pmc_done = in_array($report->pmc_status, ['Approved', 'Remarked']);

        $architect_required = self::isArchitectReviewRequired($report->stage);
        $architect_done = !$architect_required || in_array($report->architect_status, ['Approved', 'Remarked']);

        if (!$client_done || !$pmc_done || !$architect_done) {
            $overall = 'Pending Review';
        } else {
            $all_approved = $report->client_status === 'Approved'
                && $report->pmc_status === 'Approved'
                && (!$architect_required || $report->architect_status === 'Approved');

            $overall = $all_approved ? 'Approved' : 'Remarked';
        }

        $update = [
            'status' => $overall,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($overall === 'Approved') {
            $update['approved_by_role'] = $architect_required ? 'Architect, Client & PMC' : 'Client & PMC';
            $update['approved_at'] = date('Y-m-d H:i:s');
        }

        $this->db->where('id', $id)->update('layout_process_reports', $update);
    }

    // Only the Structure Consultant stage needs the Architect's sign-off
    // in addition to Client + PMC. Kept as one helper so the controller
    // and every view stay in sync if this list ever grows.
    public static function isArchitectReviewRequired($stage)
    {
        return $stage === 'Structure Consultant';
    }

    // Latest (highest revision) submission for a given stage of a given
    // company+customer flow. A stage can have many rows across revisions;
    // only the newest one decides the stage's current state.
    public function getLatestStageReport($company_id, $customer_id, $stage)
    {
        $this->ensureLayoutProcessTable();

        return $this->db
            ->where('company_id', $company_id)
            ->where('customer_id', $customer_id)
            ->where('stage', $stage)
            ->order_by('revision_no', 'DESC')
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('layout_process_reports')
            ->row();
    }

    // Card-wise flow for one company+customer pair, in the fixed stage
    // order from the diagram. Each card carries enough to render status,
    // the assigned member, and whether it can be actioned yet.
    public function getLayoutFlow($company_id, $customer_id)
    {
        $this->ensureLayoutProcessTable();

        $members = $this->db
            ->where('added_by_company_id', $company_id)
            ->where('status', 1)
            ->get('layout_members')
            ->result();

        $members_by_role = [];
        foreach ($members as $m) {
            $members_by_role[$m->role] = $m;
        }

        $flow = [];
        $previous_approved = true; // Architect (first stage) always unlocked
        $final_project = $this->getFinalProjectForCustomer($company_id, $customer_id);

        foreach (self::$STAGE_ORDER as $stage) {
            $report = $this->getLatestStageReport($company_id, $customer_id, $stage);

            if (!$report) {
                $state = $previous_approved ? 'Not Started' : 'Locked';
            } else {
                // 'Pending Review', 'Approved', or 'Remarked' (needs a
                // resubmission before it can move on).
                $state = $report->status;
                if ($state === 'Submitted' || $state === 'Revised') {
                    $state = 'Pending Review';
                }
            }

            $flow[] = (object) [
                'stage' => $stage,
                'member' => isset($members_by_role[$stage]) ? $members_by_role[$stage] : null,
                'report' => $report,
                'state' => $state,
                'can_submit' => $previous_approved && (!$report || $report->status === 'Remarked'),
                // Only populated on the Architect card - the Final Project
                // record that hands this flow off to Structural.
                'final_project' => ($stage === 'Architect') ? $final_project : null,
            ];

            $stage_approved = $report && $report->status === 'Approved';

            // The Architect stage being Approved isn't enough on its own to
            // unlock Structural - the Architect must also have submitted
            // the Final Project form first.
            if ($stage === 'Architect') {
                $stage_approved = $stage_approved && !empty($final_project);
            }

            $previous_approved = $stage_approved;
        }

        return $flow;
    }

    // Every distinct company+customer pair this admin/employee's company
    // is running a flow for - used to list all flows on the Layout
    // Process page.
    public function getFlowScopes($company_id)
    {
        $this->ensureLayoutProcessTable();

        return $this->db
            ->select('layout_process_reports.customer_id, customers.name as customer_name')
            ->from('layout_process_reports')
            ->join('customers', 'customers.id = layout_process_reports.customer_id', 'left')
            ->where('layout_process_reports.company_id', $company_id)
            ->group_by('layout_process_reports.customer_id')
            ->order_by('layout_process_reports.customer_id', 'DESC')
            ->get()
            ->result();
    }

}