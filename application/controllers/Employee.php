<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $role = $this->session->userdata('role');

        if ($role != 'employee' && $role != 'customer') {
            redirect('auth/logout');
        }

        $this->load->model('Employee_model');
        $this->load->model('Layout_member_model');
        $this->Layout_member_model->ensureLayoutProcessTable();
    }

    public function dashboard()
    {
        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        if ($role == 'employee') {

            $data['projects'] = $this->Employee_model->getProjects($id, $role);
            $data['layouts'] = [];

        } else {

            $data['projects'] = $this->Employee_model->getProjects($id, $role);
            $data['layouts'] = $this->Employee_model->getCustomerLayouts($id);

        }

        $this->load->view('employee/header');
        $this->load->view('employee/dashboard', $data);
        $this->load->view('employee/footer');
    }

    public function projects()
    {
        $employee_id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        $data['projects'] =
            $this->Employee_model->getProjects($employee_id, $role);

        $this->load->view('employee/header');
        $this->load->view('employee/dashboard', $data);
        $this->load->view('employee/footer');
    }

    public function project_details($id)
    {
        $data['project'] = $this->db
            ->where('id', $id)
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
            ->where('project_images.project_id', $id)
            ->order_by('project_images.created_at', 'DESC')
            ->get()
            ->result();

        $this->load->view('employee/header');
        $this->load->view('employee/project_details', $data);
        $this->load->view('employee/footer');
    }


    public function project($id)
    {
        $data['project'] = $this->db
            ->select('projects.*, customers.name as customer_name')
            ->from('projects')
            ->join('customers', 'customers.id = projects.customer_id', 'left')
            ->where('projects.id', $id)
            ->get()
            ->row();

        $data['attendance_today'] = $this->db
            ->where('project_id', $id)
            ->where('employee_id', $this->session->userdata('id'))
            ->where('attendance_date', date('Y-m-d'))
            ->get('attendance')
            ->row();

        $this->load->view('employee/header');
        $this->load->view('employee/project_home', $data);
        $this->load->view('employee/footer');
    }


    public function get_areas()
    {
        $floor_id = $this->input->post('floor_id');

        $areas = $this->db
            ->where('floor_id', $floor_id)
            ->get('project_areas')
            ->result();

        echo json_encode($areas);
    }



    public function capture_images($project_id)
    {
        $attendance = $this->db
            ->where('project_id', $project_id)
            ->where('employee_id', $this->session->userdata('id'))
            ->where('attendance_date', date('Y-m-d'))
            ->get('attendance')
            ->row();

        if (!$attendance) {
            $this->session->set_flashdata(
                'error',
                'Please mark attendance first'
            );

            redirect('employee/project/' . $project_id);
        }
        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();
        $days_passed =
            floor(
                (strtotime(date('Y-m-d')) -
                    strtotime($data['project']->start_date))
                / 86400
            );

        $data['current_cycle'] =
            floor(
                $days_passed /
                $data['project']->monitoring_cycle
            ) + 1;
        $data['floors'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_floors')
            ->result();

        $data['cameras'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_cameras')
            ->result();

        // Latest uploaded images
        $data['last_images'] = [];

        $images = $this->db
            ->select('camera_id,image')
            ->from('project_images')
            ->where('project_id', $project_id)
            ->where('cycle_id', $data['current_cycle'])
            ->order_by('id', 'DESC')
            ->get()
            ->result();
        foreach ($images as $img) {
            if (!isset($data['last_images'][$img->camera_id])) {
                $data['last_images'][$img->camera_id] = $img->image;
            }
        }

        $this->load->view('employee/header');
        $this->load->view('employee/capture_images', $data);
        $this->load->view('employee/footer');
    }
    public function save_capture()
    {
        $project_id = $this->input->post('project_id');
        $camera_id = $this->input->post('camera_id');
        $remarks = $this->input->post('remarks');

        $config['upload_path'] = './uploads/floor_plan/project_image/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 10240; // 10MB

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            echo $this->upload->display_errors();
            exit;
        }

        $upload = $this->upload->data();

        $camera = $this->db
            ->where('id', $camera_id)
            ->get('project_cameras')
            ->row();
        $project = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        $days_passed =
            floor(
                (strtotime(date('Y-m-d')) -
                    strtotime($project->start_date))
                / 86400
            );

        $current_cycle =
            floor(
                $days_passed /
                $project->monitoring_cycle
            ) + 1;
        $insert = array(
            'project_id' => $project_id,
            'camera_id' => $camera_id,
            // 'cycle_id' => $cycle->id,
            'cycle_id' => $current_cycle,
            'floor_id' => $camera->floor_id,
            'area_id' => $camera->area_id,
            'employee_id' => $this->session->userdata('id'),
            'image' => $upload['file_name'],
            'remarks' => $remarks,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('project_images', $insert);

        redirect('employee/capture_images/' . $project_id);

        // {
        //     $project_id = $this->input->post('project_id');
        //     $camera_id = $this->input->post('camera_id');
        //     $remarks = $this->input->post('remarks');

        //     // upload image
        //     $config['upload_path'] = './uploads/project_images/';
        //     $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
        //     $config['encrypt_name'] = TRUE;

        //     $this->load->library('upload', $config);

        //     if (!$this->upload->do_upload('image')) {
        //         echo $this->upload->display_errors();
        //         exit;
        //     }

        //     $upload = $this->upload->data();

        //     // camera details
        //     $camera = $this->db
        //         ->where('id', $camera_id)
        //         ->get('project_cameras')
        //         ->row();

        //     $insert = [
        //         'project_id' => $project_id,
        //         'floor_id' => $camera->floor_id,
        //         'area_id' => $camera->area_id,
        //         'employee_id' => $this->session->userdata('id'),
        //         'image' => $upload['file_name'],
        //         'remarks' => $remarks,
        //         'created_at' => date('Y-m-d H:i:s')
        //     ];

        //     $this->db->insert('index.php/project_images', $insert);

        //     redirect('employee/capture_images/' . $project_id);
        // }

        $data['last_images'] = [];

        $images = $this->db
            ->select('camera_id,image')
            ->from('project_images')
            ->where('project_id', $project_id)
            ->order_by('id', 'DESC')
            ->get()
            ->result();

        foreach ($images as $img) {
            if (!isset($data['last_images'][$img->camera_id])) {
                $data['last_images'][$img->camera_id] = $img->image;
            }
        }
    }



    // public function profile()
    // {
    //     $employee_id = $this->session->userdata('id');

    //     $data['employee'] = $this->db
    //         ->select('users.*, companies.company_name')
    //         ->from('users')
    //         ->join('companies', 'companies.id = users.company_id', 'left')
    //         ->where('users.id', $employee_id)
    //         ->get()
    //         ->row();

    //     $this->load->view('employee/header');
    //     $this->load->view('employee/profile', $data);
    //     $this->load->view('employee/footer');
    // }

    public function profile()
    {
        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        if ($role == 'customer') {

            $data['employee'] = $this->db
                ->select('users.*, companies.company_name')
                ->from('users')
                ->join('companies', 'companies.id = users.company_id', 'left')
                ->where('users.id', $id)
                ->get()
                ->row();

        } else {

            $data['employee'] = $this->db
                ->select('team_members.*, companies.company_name')
                ->from('team_members')
                ->join('companies', 'companies.id = team_members.company_id', 'left')
                ->where('team_members.id', $id)
                ->get()
                ->row();
        }

        $this->load->view('employee/header');
        $this->load->view('employee/profile', $data);
        $this->load->view('employee/footer');
    }





    public function upload_profile_photo()
    {
        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        $config['upload_path'] = './uploads/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_photo')) {
            echo $this->upload->display_errors();
            exit;
        }

        $upload = $this->upload->data();

        if ($role == 'customer') {

            $this->db->where('id', $id);
            $this->db->update('users', [
                'profile_photo' => $upload['file_name']
            ]);

        } else {

            $this->db->where('id', $id);
            $this->db->update('team_members', [
                'profile_photo' => $upload['file_name']
            ]);

        }

        redirect('employee/profile');
    }
    public function edit_profile()
    {
        $employee_id = $this->session->userdata('id');

        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        if ($role == 'customer') {
            $data['employee'] = $this->db
                ->where('id', $id)
                ->get('users')
                ->row();
        } else {
            $data['employee'] = $this->db
                ->where('id', $id)
                ->get('team_members')
                ->row();
        }

        $this->load->view('employee/header');
        $this->load->view('employee/edit_profile', $data);
        $this->load->view('employee/footer');
    }

    public function update_profile()
    {
        $employee_id = $this->session->userdata('id');

        $update = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'country' => $this->input->post('country'),
            'state' => $this->input->post('state'),
            'city' => $this->input->post('city'),
            'address' => $this->input->post('address')
        ];

        $id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        if ($role == 'customer') {
            $this->db
                ->where('id', $id)
                ->update('users', $update);
        } else {
            $this->db
                ->where('id', $id)
                ->update('team_members', $update);
        }

        redirect('employee/profile');
    }

    public function start_monitoring($project_id)
    {
        $last = $this->db
            ->where('project_id', $project_id)
            ->order_by('id', 'DESC')
            ->get('monitoring_cycles')
            ->row();

        $next_cycle = $last ? ($last->cycle_no + 1) : 1;

        $this->db->insert('monitoring_cycles', [
            'project_id' => $project_id,
            'cycle_no' => $next_cycle,
            'monitoring_date' => date('Y-m-d'),
            'remarks' => '',
            'status' => 'Open',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        redirect('employee/capture_images/' . $project_id);
    }

    public function view_images($project_id)
    {
        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        $data['images'] = $this->db
            ->select('project_images.*, team_members.name as employee_name')
            ->from('project_images')
            ->join('team_members', 'team_members.id = project_images.employee_id', 'left')
            ->where('project_images.project_id', $project_id)
            ->order_by('project_images.created_at', 'DESC')
            ->get()
            ->result();

        $this->load->view('employee/header');
        $this->load->view('employee/view_images', $data);
        $this->load->view('employee/footer');
    }

    public function project_info($id)
    {
        $data['project'] = $this->db
            ->where('id', $id)
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
            ->where('project_images.project_id', $id)
            ->order_by('project_images.created_at', 'DESC')
            ->get()
            ->result();

        $data['areas'] = $this->db
            ->select('project_areas.*, project_floors.floor_name')
            ->from('project_areas')
            ->join(
                'project_floors',
                'project_floors.id = project_areas.floor_id',
                'left'
            )
            ->where('project_areas.project_id', $id)
            ->order_by('project_areas.id', 'ASC')
            ->get()
            ->result();

        $this->load->view('employee/header');
        $this->load->view('employee/project_info', $data);
        $this->load->view('employee/footer');
    }



    public function add_attendance($project_id)
    {
        $employee_id = $this->session->userdata('id');

        $exists = $this->db
            ->where('project_id', $project_id)
            ->where('employee_id', $employee_id)
            ->where('attendance_date', date('Y-m-d'))
            ->get('attendance')
            ->row();

        if (!$exists) {
            $this->db->insert('attendance', [
                'project_id' => $project_id,
                'employee_id' => $employee_id,
                'attendance_date' => date('Y-m-d'),
                'check_in_time' => date('H:i:s'),
                'status' => 'Present',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        redirect('employee/project/' . $project_id);
    }
    public function attendance_list($project_id)
    {
        $employee_id = $this->session->userdata('id');

        $data['attendance'] = $this->db
            ->where('project_id', $project_id)
            ->where('employee_id', $employee_id)
            ->order_by('attendance_date', 'DESC')
            ->get('attendance')
            ->result();

        $this->load->view('employee/header');
        $this->load->view('employee/attendance_list', $data);
        $this->load->view('employee/footer');
    }



    public function get_subcategories()
    {
        $company_id = $this->session->userdata('company_id');

        $category_id = $this->input->post('category_id');

        $sub = $this->db
            ->where('company_id', $company_id)
            ->where('category_id', $category_id)
            ->order_by('subcategory_name', 'ASC')
            ->get('material_subcategories')
            ->result();

        echo json_encode($sub);
    }

    public function materials_report($project_id)
    {
        $company_id = $this->session->userdata('company_id');
        $employee_id = $this->session->userdata('id');

        $data['project_id'] = $project_id;

        // Project Details
        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        /*
            Get only materials assigned to this project.
            We will update this query in Step 5.
        */

        $data['materials'] = $this->db
            ->select('
                    project_priority_materials.*,
                    material_categories.category_name,
                    material_subcategories.subcategory_name
                ')
            ->from('project_priority_materials')
            ->join(
                'material_categories',
                'material_categories.id = project_priority_materials.category_id',
                'left'
            )
            ->join(
                'material_subcategories',
                'material_subcategories.id = project_priority_materials.subcategory_id',
                'left'
            )
            ->where('project_priority_materials.project_id', $project_id)
            ->order_by('project_priority_materials.id', 'ASC')
            ->get()
            ->result();

        $data['reports'] = $this->db
            ->select("
                material_report_items.*,
                material_reports.cycle_id,
                material_reports.report_date,
                attendance.attendance_date,
                material_categories.category_name,
                material_subcategories.subcategory_name
            ")
            ->from('material_report_items')
            ->join(
                'material_reports',
                'material_reports.id = material_report_items.report_id'
            )
            ->join(
                'attendance',
                'attendance.project_id = material_reports.project_id
            AND attendance.employee_id = material_reports.employee_id
            AND attendance.attendance_date = material_reports.report_date',
                'left'
            )
            ->join(
                'material_categories',
                'material_categories.id = material_report_items.category_id',
                'left'
            )
            ->join(
                'material_subcategories',
                'material_subcategories.id = material_report_items.subcategory_id',
                'left'
            )
            ->where('material_reports.project_id', $project_id)
            ->order_by('material_reports.report_date', 'DESC')
            ->get()
            ->result();

        $this->load->view('employee/header');
        $this->load->view('employee/materials_report', $data);
        $this->load->view('employee/footer');
    }
    public function save_material_report()
    {
        $report = [

            'admin_id' => $this->session->userdata('company_id'),
            'project_id' => $this->input->post('project_id'),
            'employee_id' => $this->session->userdata('id'),
            'cycle_id' => 1, // later we'll calculate current cycle
            'report_date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->db->insert('material_reports', $report);

        $report_id = $this->db->insert_id();

        // Upload Configuration
        $config['upload_path'] = './uploads/materials/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|webp';
        $config['encrypt_name'] = TRUE;

        if (!is_dir('./uploads/materials/')) {
            mkdir('./uploads/materials/', 0777, true);
        }

        $this->load->library('upload', $config);

        $site_photo = '';
        $invoice_photo = '';

        // Site Photo
        if (!empty($_FILES['site_photo']['name'])) {

            if ($this->upload->do_upload('site_photo')) {

                $upload = $this->upload->data();

                $site_photo = $upload['file_name'];

            } else {

                echo $this->upload->display_errors();
                exit;

            }

        }

        // Invoice Photo
        $this->upload->initialize($config);

        if (!empty($_FILES['invoice_photo']['name'])) {

            if ($this->upload->do_upload('invoice_photo')) {

                $upload = $this->upload->data();

                $invoice_photo = $upload['file_name'];

            } else {

                echo $this->upload->display_errors();
                exit;

            }

        }
        $item = [

            'report_id' => $report_id,

            'category_id' => 0,

            'subcategory_id' => $this->input->post('material_id'),

            'site_photo' => $site_photo,
            'site_quantity' => $this->input->post('site_quantity'),
            'site_unit' => $this->input->post('site_unit'),
            'site_size' => $this->input->post('site_size'),
            'site_remark' => $this->input->post('site_remark'),

            'invoice_photo' => $invoice_photo,
            'invoice_date' => $this->input->post('invoice_date'),
            'invoice_quantity' => $this->input->post('invoice_quantity'),
            'invoice_unit' => $this->input->post('invoice_unit'),
            'invoice_size' => $this->input->post('invoice_size'),

            'other_brand' => $this->input->post('other_brand'),
            'remarks' => $this->input->post('remarks'),

            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('material_report_items', $item);
        // Site Photo
        // if (!empty($_FILES['site_photo']['name'])) {

        //     if ($this->upload->do_upload('site_photo')) {

        //         $upload = $this->upload->data();

        //         $site_photo = $upload['file_name'];
        //     }
        // }

        // Invoice Photo
        $this->upload->initialize($config);

        // if (!empty($_FILES['invoice_photo']['name'])) {

        //     if ($this->upload->do_upload('invoice_photo')) {

        //         $upload = $this->upload->data();

        //         $invoice_photo = $upload['file_name'];
        //     }
        // }
        $this->session->set_flashdata(
            'success',
            'Material Report Saved Successfully.'
        );

        redirect('employee/materials_report/' . $this->input->post('project_id'));
    }






    public function manpower_report($project_id = null)
    {
        // Check Login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        // Project ID Required
        if (empty($project_id)) {
            show_404();
        }

        // Load Project
        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        if (!$data['project']) {
            show_404();
        }

        // Today's Date
        $data['today'] = date('Y-m-d');

        // Load Areas
        $data['areas'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_areas')
            ->result();




        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        $data['areas'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_areas')
            ->result();

        $data['categories'] = $this->db
            ->get('manpower_categories')
            ->result();

        $data['contractors'] = $this->db
            ->get('contractors')
            ->result();

        $data['activities'] = $this->db
            ->get('work_activities')
            ->result();

        // Load View
        $this->load->view('employee/header');
        $this->load->view('employee/manpower_report', $data);
        $this->load->view('employee/footer');
    }




    public function save_manpower_report()
    {
        $project_id = $this->input->post('project_id');


        //==============================
        // Upload Photo
        //==============================
        $photo = '';

        if (!empty($_FILES['photo']['name'])) {

            if (!is_dir('./uploads/manpower/')) {
                mkdir('./uploads/manpower/', 0777, true);
            }

            $config['upload_path'] = './uploads/manpower/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photo')) {

                $upload = $this->upload->data();
                $photo = $upload['file_name'];

            } else {

                echo $this->upload->display_errors();
                return;

            }
        }

        //==============================
        // Today's Attendance
        //==============================

        $attendance = $this->db
            ->where('project_id', $project_id)
            ->where('employee_id', $this->session->userdata('id'))
            ->where('attendance_date', date('Y-m-d'))
            ->get('attendance')
            ->row();

        $attendance_id = $attendance ? $attendance->id : 0;

        //==============================
        // Safe Arrays
        //==============================

        $workers = $this->input->post('workers') ?: [];
        $skilled = $this->input->post('skilled') ?: [];
        $unskilled = $this->input->post('unskilled') ?: [];

        //==============================
        // Main Report
        //==============================

        $report = [

            'project_id' => $project_id,
            'employee_id' => $this->session->userdata('id'),
            'attendance_id' => $attendance_id,
            'report_date' => $this->input->post('report_date'),

            'total_workers' => array_sum($workers),
            'skilled_workers' => array_sum($skilled),
            'unskilled_workers' => array_sum($unskilled),

            'photo' => $photo,
            'remarks' => $this->input->post('remarks'),
            'status' => 'Submitted',
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->db->insert('manpower_reports', $report);

        $report_id = $this->db->insert_id();

        //==============================
        // Detail Rows
        //==============================

        $categories = $this->input->post('category') ?: [];

        foreach ($categories as $i => $cat) {

            $detail = [

                'report_id' => $report_id,
                'category_name' => $cat,

                'contractor' => $this->input->post('contractor')[$i] ?? '',
                'work_area' => $this->input->post('work_area')[$i] ?? '',
                'activity' => $this->input->post('activity')[$i] ?? '',

                'skilled_workers' => $skilled[$i] ?? 0,
                'unskilled_workers' => $unskilled[$i] ?? 0,
                'workers' => $workers[$i] ?? 0,

                'remarks' => $this->input->post('remarks_detail')[$i] ?? '',
                'created_at' => date('Y-m-d H:i:s')

            ];

            $this->db->insert('manpower_report_details', $detail);
        }

        $this->session->set_flashdata('success', 'Manpower Report Saved Successfully.');

        redirect('employee/manpower_report/' . $project_id);
    }

    public function add_contractor()
    {

        $this->db->insert('contractors', [

            'contractor_name' => $this->input->post('contractor_name'),
            'created_at' => date('Y-m-d H:i:s')

        ]);

        echo json_encode([
            'status' => 1
        ]);

    }


    public function layout_plans()
    {
        if ($this->session->userdata('role') === 'customer') {
            $data['plans'] = $this->Employee_model->getCustomerLayouts($this->session->userdata('id'));
        } else {
            $data['plans'] = $this->Employee_model->getLayoutPlans();
        }

        $this->load->view('employee/header');
        $this->load->view('employee/layout_plan_list', $data);
        $this->load->view('employee/footer');
    }

    public function layout_process()
    {
        $role = $this->session->userdata('role');
        $layout_role = null;

        if ($role === 'customer') {
            $scope = 'customer';
            $data['layout_plans'] = $this->Employee_model->getCustomerLayouts($this->session->userdata('id'));
        } else {
            $layout_role = $this->Layout_member_model->getCurrentLayoutRole();
            $scope = ($layout_role && $layout_role->role === 'PMC') ? 'pmc' : 'architect';
            $data['layout_plans'] = $this->Employee_model->getLayoutPlans();
        }

        $data['layout_role'] = $layout_role;
        $reports = $this->Layout_member_model->getLayoutProcessReports($scope);

        // Optional "Plan Name" filter — narrows the list down to reports
        // submitted against one specific Layout Plan, useful when a client
        // has more than one project/plan running at once.
        $plan_filter = $this->input->get('plan');
        if ($plan_filter !== null && $plan_filter !== '') {
            $reports = array_values(array_filter($reports, function ($row) use ($plan_filter) {
                return $row->plan_title === $plan_filter;
            }));
        }

        $data['reports'] = $reports;
        $data['plan_filter'] = $plan_filter;

        $this->load->view('employee/header');
        $this->load->view('employee/layout_process_list', $data);
        $this->load->view('employee/footer');
    }

    // Card-wise view of the full flow (Architect -> Structural -> Interior
    // -> Electrical -> PHE -> Landscape -> HVAC -> Liasoning), one card per
    // stage, showing whether it's locked, awaiting review, needs revision,
    // or approved and passed on to the next stage.
    public function layout_process_flow($customer_id = 0)
    {
        $role = $this->session->userdata('role');
        $layout_role = null;

        if ($role === 'customer') {
            $customer = $this->Employee_model->getLoggedInCustomer($this->session->userdata('id'));
            $company_id = $customer ? $customer->company_id : 0;
            $customer_id = $customer ? $customer->id : 0;
        } else {
            $layout_role = $this->Layout_member_model->getCurrentLayoutRole();
            $company_id = $layout_role ? $layout_role->added_by_company_id : 0;

            if (!$customer_id) {
                $customer = $this->getAutoFetchClient($company_id);
                $customer_id = $customer ? $customer->id : 0;
            }
        }

        $data['role'] = $role;
        $data['layout_role'] = $layout_role;
        $data['customer_id'] = $customer_id;
        $data['scopes'] = $role === 'customer' ? [] : $this->Layout_member_model->getFlowScopes($company_id);
        $data['flow'] = ($company_id && $customer_id)
            ? $this->Layout_member_model->getLayoutFlow($company_id, $customer_id)
            : [];

        $this->load->view('employee/header');
        $this->load->view('employee/layout_process_flow', $data);
        $this->load->view('employee/footer');
    }

    // A layout company (added_by_company_id) is expected to have exactly one
    // client. Auto-fetch that client instead of showing a dropdown.
    private function getAutoFetchClient($company_id)
    {
        // The reliable signal for "which client is this layout company
        // actually working with" is the Layout Plan module — every plan
        // already ties company_id to a specific customer_id. Use the most
        // recent plan's client first.
        $latest_plan = $this->db
            ->where('company_id', $company_id)
            ->order_by('id', 'DESC')
            ->limit(1)
            ->get('layout_plans')
            ->row();

        if ($latest_plan) {
            $customer = $this->db->where('id', $latest_plan->customer_id)->get('customers')->row();
            if ($customer) {
                return $customer;
            }
        }

        // Fallback (no layout plans yet): most recently added Active
        // customer for this company.
        return $this->db
            ->where('company_id', $company_id)
            ->where('status', 'Active')
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get('customers')
            ->row();
    }

    public function layout_process_add($parent_id = 0)
    {
        $layout_role = $this->Layout_member_model->getCurrentLayoutRole();

        if (!$layout_role || !in_array($layout_role->role, Layout_member_model::$STAGE_ORDER)) {
            show_404();
        }

        $parent_report = $parent_id ? $this->Layout_member_model->getLayoutProcessReportById($parent_id) : null;

        // For a revision, keep the same client as the original report.
        // For a fresh submission, auto-fetch the company's client.
        if ($parent_report) {
            $customer = $this->db->where('id', $parent_report->customer_id)->get('customers')->row();
        } else {
            $customer = $this->getAutoFetchClient($layout_role->added_by_company_id);
        }

        if (!$customer) {
            $this->session->set_flashdata('error', 'No client found for your company. Contact your admin.');
            redirect('employee/layout_process');
        }

        // Make sure this stage is actually unlocked (previous stage
        // Approved) before letting this member submit.
        $flow_check = $this->Layout_member_model->getLayoutFlow($layout_role->added_by_company_id, $customer->id);
        $stage_card = null;
        foreach ($flow_check as $card) {
            if ($card->stage === $layout_role->role) {
                $stage_card = $card;
                break;
            }
        }

        if ($stage_card && !$stage_card->can_submit) {
            $this->session->set_flashdata('error', 'The previous stage has not been approved yet. This stage is locked.');
            redirect('employee/layout_process');
        }

        $data['layout_role'] = $layout_role;
        $data['parent_report'] = $parent_report;
        $data['customer'] = $customer;

        $this->load->view('employee/header');
        $this->load->view('employee/layout_process_form', $data);
        $this->load->view('employee/footer');
    }

    public function save_layout_process()
    {
        $layout_role = $this->Layout_member_model->getCurrentLayoutRole();

        if (!$layout_role || !in_array($layout_role->role, Layout_member_model::$STAGE_ORDER)) {
            show_404();
        }

        $parent_id = (int) $this->input->post('parent_report_id');
        $parent_report = $parent_id ? $this->Layout_member_model->getLayoutProcessReportById($parent_id) : null;

        // Client is never taken from the posted form — always resolved
        // server-side so it can't be tampered with.
        if ($parent_report) {
            $customer_id = (int) $parent_report->customer_id;
        } else {
            $customer = $this->getAutoFetchClient($layout_role->added_by_company_id);
            $customer_id = $customer ? (int) $customer->id : 0;
        }

        if (!$customer_id) {
            $this->session->set_flashdata('error', 'No client found for your company. Contact your admin.');
            redirect('employee/layout_process_add' . ($parent_id ? '/' . $parent_id : ''));
        }

        // ---------------- Layout Plan (PDF) ----------------
        $layout_doc = '';

        if (!empty($_FILES['layout_doc']['name'])) {
            if (!is_dir('./uploads/layout_process/')) {
                mkdir('./uploads/layout_process/', 0777, true);
            }

            $config['upload_path'] = './uploads/layout_process/';
            $config['allowed_types'] = 'pdf';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('layout_doc')) {
                $layout_doc = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('employee/layout_process_add' . ($parent_id ? '/' . $parent_id : ''));
            }
        } else {
            $this->session->set_flashdata('error', 'Please upload the layout plan as a PDF file.');
            redirect('employee/layout_process_add' . ($parent_id ? '/' . $parent_id : ''));
        }

        $this->Layout_member_model->insertLayoutProcessReport([
            'company_id' => $layout_role->added_by_company_id,
            'customer_id' => $customer_id,
            'architect_member_id' => $this->session->userdata('id'),
            'stage' => $layout_role->role,
            'parent_report_id' => $parent_id,
            'revision_no' => $parent_report ? ((int) $parent_report->revision_no + 1) : 1,
            'recipient_type' => 'both',
            'plan_title' => $this->input->post('layout_name'),
            'plan_doc' => $layout_doc,
            'remark' => null,
            'start_date' => $this->input->post('start_date') ?: null,
            'end_date' => $this->input->post('end_date') ?: null,
            'requirements' => null,
            'point_wise_report' => null,
            'status' => 'Pending Review',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        if ($parent_id) {
            $this->Layout_member_model->updateLayoutProcessReport($parent_id, [
                'status' => 'Revised',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }

        $this->session->set_flashdata('success', 'Layout process report submitted.');
        redirect('employee/layout_process');
    }

    public function layout_process_view($id)
    {
        $data['report'] = $this->Layout_member_model->getLayoutProcessReportById($id);

        if (!$data['report']) {
            show_404();
        }

        $data['layout_role'] = $this->Layout_member_model->getCurrentLayoutRole();

        $this->load->view('employee/header');
        $this->load->view('employee/layout_process_view', $data);
        $this->load->view('employee/footer');
    }

    public function approve_layout_process($id)
    {
        $is_client = $this->session->userdata('role') === 'customer';
        $layout_role = $is_client ? null : $this->Layout_member_model->getCurrentLayoutRole();

        if (!$is_client && (!$layout_role || $layout_role->role !== 'PMC')) {
            show_404();
        }

        $field_status = $is_client ? 'client_status' : 'pmc_status';
        $field_by = $is_client ? 'client_acted_by' : 'pmc_acted_by';
        $field_at = $is_client ? 'client_acted_at' : 'pmc_acted_at';

        $report = $this->Layout_member_model->getLayoutProcessReportById($id);

        if (!$report || $report->$field_status !== 'Pending') {
            $this->session->set_flashdata('error', 'You have already responded to this submission.');
            redirect('employee/layout_process');
        }

        $this->Layout_member_model->updateLayoutProcessReport($id, [
            $field_status => 'Approved',
            $field_by => $this->session->userdata('id'),
            $field_at => date('Y-m-d H:i:s'),
        ]);

        // Only resolves to a final Approved once the OTHER side has also
        // responded - see recomputeOverallStatus().
        $this->Layout_member_model->recomputeOverallStatus($id);

        $this->session->set_flashdata('success', 'Your approval has been recorded. It will move forward once the other reviewer also responds.');
        redirect('employee/layout_process');
    }

    public function remark_layout_process($id)
    {
        $is_client = $this->session->userdata('role') === 'customer';
        $layout_role = $is_client ? null : $this->Layout_member_model->getCurrentLayoutRole();

        if (!$is_client && (!$layout_role || $layout_role->role !== 'PMC')) {
            show_404();
        }

        $remark_field = $is_client ? 'client_remark' : 'pmc_remark';
        $status_field = $is_client ? 'client_status' : 'pmc_status';
        $field_by = $is_client ? 'client_acted_by' : 'pmc_acted_by';
        $field_at = $is_client ? 'client_acted_at' : 'pmc_acted_at';

        $report = $this->Layout_member_model->getLayoutProcessReportById($id);

        if (!$report || $report->$status_field !== 'Pending') {
            $this->session->set_flashdata('error', 'You have already responded to this submission.');
            redirect('employee/layout_process');
        }

        $this->Layout_member_model->updateLayoutProcessReport($id, [
            $remark_field => $this->input->post('review_remark'),
            $status_field => 'Remarked',
            $field_by => $this->session->userdata('id'),
            $field_at => date('Y-m-d H:i:s'),
        ]);

        // Only resolves to a final Remarked once the OTHER side has also
        // responded - see recomputeOverallStatus().
        $this->Layout_member_model->recomputeOverallStatus($id);

        $this->session->set_flashdata('success', 'Your remark has been recorded. It will be sent back once the other reviewer also responds.');
        redirect('employee/layout_process');
    }

    private function upload_layout_process_pdf()
    {
        if (empty($_FILES['plan_doc']['name'])) {
            return '';
        }

        if (!is_dir('./uploads/layout_process/')) {
            mkdir('./uploads/layout_process/', 0777, true);
        }

        $config['upload_path'] = './uploads/layout_process/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('plan_doc')) {
            return '';
        }

        return $this->upload->data('file_name');
    }

    public function layout_members()
    {
        $data['members'] = $this->Employee_model->getLayoutMembers();

        $this->load->view('employee/header');
        $this->load->view('employee/layout_members', $data);
        $this->load->view('employee/footer');
    }

    public function layout_member_details($id)
    {
        $data['member'] = $this->db
            ->where('id', $id)
            ->get('layout_members')
            ->row();

        $this->load->view('employee/header');
        $this->load->view('employee/layout_member_details', $data);
        $this->load->view('employee/footer');
    }
}