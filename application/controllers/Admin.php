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

        $this->load->view('admin/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/footer');
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
