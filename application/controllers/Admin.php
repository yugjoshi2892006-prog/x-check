<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        if ($this->session->userdata('role') != 'admin') {
            redirect('auth/logout');
        }
    }
    public function monitoring_images($project_id)
    {
        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        $data['images'] = $this->db
            ->select('project_images.*, team_members.name as employee_name')
            ->from('project_images')
            ->join(
                'team_members',
                'team_members.id = project_images.employee_id',
                'left'
            )
            ->where('project_images.project_id', $project_id)
            ->order_by('project_images.id', 'DESC')
            ->get()
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/monitoring_images', $data);
        $this->load->view('admin/footer');
    }
    public function dashboard()
    {
        $company_id = $this->session->userdata('company_id');

        $data['current_plan'] = $this->db
            ->select('plans.plan_name, company_plans.expiry_date')
            ->from('company_plans')
            ->join('plans', 'plans.id = company_plans.plan_id')
            ->where('company_plans.company_id', $company_id)
            ->where('company_plans.status', 'Active')
            ->order_by('company_plans.id', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        $data['project_count'] = $this->db
            ->where('company_id', $company_id)
            ->count_all_results('projects');

        $data['team_count'] = $this->db
            ->where('company_id', $company_id)
            ->count_all_results('team_members');

        $data['customer_count'] = $this->db
            ->where('company_id', $company_id)
            ->count_all_results('customers');

        $data['folder_count'] = $this->db
            ->where('company_id', $company_id)
            ->count_all_results('folders');

        $data['project_progress_chart'] = $this->get_project_progress_chart($company_id);
        $data['recent_activities'] = $this->get_recent_activities($company_id);

        $this->load->view('admin/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer');
    }

    /**
     * Return project-status totals for the dashboard's 1, 3 and 6 month chart.
     * A project is counted in the month in which it was created.
     */
    private function get_project_progress_chart($company_id)
    {
        $start_date = date('Y-m-01 00:00:00', strtotime('-5 months'));
        $rows = $this->db
            ->select("DATE_FORMAT(created_at, '%Y-%m') AS month_key", FALSE)
            ->select("SUM(status = 'Completed') AS completed", FALSE)
            ->select("SUM(status = 'Running') AS running", FALSE)
            ->select("SUM(status = 'Pending') AS pending", FALSE)
            ->from('projects')
            ->where('company_id', $company_id)
            ->where('created_at >=', $start_date)
            ->group_by("DATE_FORMAT(created_at, '%Y-%m')", FALSE)
            ->get()
            ->result();

        $totals_by_month = array();
        foreach ($rows as $row) {
            $totals_by_month[$row->month_key] = array(
                'completed' => (int) $row->completed,
                'running' => (int) $row->running,
                'pending' => (int) $row->pending,
            );
        }

        $months = array();
        for ($offset = 5; $offset >= 0; $offset--) {
            $date = strtotime('-' . $offset . ' months');
            $key = date('Y-m', $date);
            $months[] = array(
                'label' => date('M', $date),
                'completed' => isset($totals_by_month[$key]) ? $totals_by_month[$key]['completed'] : 0,
                'running' => isset($totals_by_month[$key]) ? $totals_by_month[$key]['running'] : 0,
                'pending' => isset($totals_by_month[$key]) ? $totals_by_month[$key]['pending'] : 0,
            );
        }

        $chart = array();
        foreach (array('6months' => 6, '3months' => 3, '1month' => 1) as $range => $length) {
            $period_months = array_slice($months, -$length);
            $chart[$range] = array(
                'labels' => array_column($period_months, 'label'),
                'completed' => array_column($period_months, 'completed'),
                'running' => array_column($period_months, 'running'),
                'pending' => array_column($period_months, 'pending'),
            );
        }

        return $chart;
    }

    /** Return the newest company records for the dashboard activity feed. */
    private function get_recent_activities($company_id)
    {
        $activities = array();
        $sources = array(
            array(
                'type' => 'project',
                'records' => $this->db->select('project_name AS title, created_at')
                    ->where('company_id', $company_id)->order_by('created_at', 'DESC')
                    ->limit(5)->get('projects')->result()
            ),
            array(
                'type' => 'member',
                'records' => $this->db->select('name AS title, created_at')
                    ->where('company_id', $company_id)->order_by('created_at', 'DESC')
                    ->limit(5)->get('team_members')->result()
            ),
            array(
                'type' => 'folder',
                'records' => $this->db->select('folder_name AS title, created_at')
                    ->where('company_id', $company_id)->order_by('created_at', 'DESC')
                    ->limit(5)->get('folders')->result()
            ),
            array(
                'type' => 'upload',
                'records' => $this->db->select('projects.project_name AS title, project_images.created_at')
                    ->from('project_images')->join('projects', 'projects.id = project_images.project_id')
                    ->where('projects.company_id', $company_id)->order_by('project_images.created_at', 'DESC')
                    ->limit(5)->get()->result()
            ),
            array(
                'type' => 'plan',
                'records' => $this->db->select('plans.plan_name AS title, company_plans.created_at')
                    ->from('company_plans')->join('plans', 'plans.id = company_plans.plan_id', 'left')
                    ->where('company_plans.company_id', $company_id)->order_by('company_plans.created_at', 'DESC')
                    ->limit(5)->get()->result()
            ),
        );

        foreach ($sources as $source) {
            foreach ($source['records'] as $record) {
                $timestamp = strtotime($record->created_at);
                if ($timestamp === FALSE) {
                    continue;
                }

                $activities[] = array(
                    'type' => $source['type'],
                    'title' => $record->title ?: 'Untitled',
                    'timestamp' => $timestamp,
                );
            }
        }

        usort($activities, function ($first, $second) {
            return $second['timestamp'] <=> $first['timestamp'];
        });

        return array_slice($activities, 0, 5);
    }

    public function project_dashboard($project_id)
    {
        $data['project'] = $this->db
            ->select('projects.*, customers.name as customer_name')
            ->from('projects')
            ->join(
                'customers',
                'customers.id = projects.customer_id',
                'left'
            )
            ->where('projects.id', $project_id)
            ->get()
            ->row();


        $data['engineers'] = $this->db
            ->select('team_members.name')
            ->from('project_team')
            ->join(
                'team_members',
                'team_members.id = project_team.team_member_id'
            )
            ->where('project_team.project_id', $project_id)
            ->where('project_team.role', 'engineer')
            ->get()
            ->result();

        // Last Capture Date
        $last_capture = $this->db
            ->select('created_at')
            ->from('project_images')
            ->where('project_id', $project_id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        $data['last_capture'] =
            $last_capture
            ? date('d/m/Y', strtotime($last_capture->created_at))
            : 'No Capture';

        // Progress
        $data['progress'] =
            $this->Project_model->getProjectProgress($project_id);

        $this->load->view('admin/header');
        $this->load->view('admin/project_dashboard', $data);
        $this->load->view('admin/footer');
    }

    public function attendance_projects()
    {
        $company_id = $this->session->userdata('company_id');

        $data['projects'] = $this->db
            ->where('company_id', $company_id)
            ->get('projects')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/attendance_projects', $data);
        $this->load->view('admin/footer');
    }


    public function attendance_list($project_id)
    {
        $company_id = $this->session->userdata('company_id');

        $data['project'] = $this->db
            ->where('id', $project_id)
            ->where('company_id', $company_id)
            ->get('projects')
            ->row();

        $data['attendance'] = $this->db
            ->select('attendance.*, team_members.name as employee_name')
            ->from('attendance')
            ->join('projects', 'projects.id = attendance.project_id')
            ->join(
                'team_members',
                'team_members.id = attendance.employee_id',
                'left'
            )
            ->where('attendance.project_id', $project_id)
            ->where('projects.company_id', $company_id)
            ->order_by('attendance.attendance_date', 'DESC')
            ->get()
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/attendance_list', $data);
        $this->load->view('admin/footer');
    }





    public function manpower_report_list()
    {
        $data['reports'] = $this->db
            ->select('
            manpower_reports.*,
            projects.project_name,
            team_members.name as engineer
        ')
            ->from('manpower_reports')
            ->join('projects', 'projects.id=manpower_reports.project_id')
            ->join('team_members', 'team_members.id=manpower_reports.employee_id')
            ->order_by('manpower_reports.id', 'DESC')
            ->get()
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/manpower_report_list', $data);
        $this->load->view('admin/footer');
    }


    public function view_manpower($id)
    {
        $data['report'] = $this->db
            ->select("
            manpower_reports.*,
            projects.project_name,
            team_members.name AS engineer
        ")
            ->from('manpower_reports')
            ->join('projects', 'projects.id = manpower_reports.project_id')
            ->join('team_members', 'team_members.id = manpower_reports.employee_id', 'left')
            ->where('manpower_reports.id', $id)
            ->get()
            ->row();

        if (!$data['report']) {
            show_404();
        }

        $data['details'] = $this->db
            ->where('report_id', $id)
            ->get('manpower_report_details')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/view_manpower', $data);
        $this->load->view('admin/footer');
    }


}
