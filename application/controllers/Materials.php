<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
class Materials extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }

        $this->load->model('Materials_model');
    }

    public function add_category()
    {
        $company_id = $this->session->userdata('company_id');

        $category_name = trim($this->input->post('category_name'));

        $exists = $this->db
            ->where('company_id', $company_id)
            ->where('LOWER(category_name)', strtolower($category_name))
            ->get('material_categories')
            ->row();

        if ($exists) {

            $this->session->set_flashdata('error', 'Category already exists.');

            redirect('materials/categories');
        }

        $data = [
            'company_id' => $company_id,
            'category_name' => $category_name,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('material_categories', $data);

        $this->session->set_flashdata('success', 'Category added successfully.');

        redirect('materials/categories');
    }
    public function categories()
    {
        $company_id = $this->session->userdata('company_id');

        $data['categories'] =
            $this->Materials_model->getCategories($company_id);

        $this->load->view('admin/header');
        $this->load->view('admin/materials/category_list', $data);
        $this->load->view('admin/footer');
    }

    public function add_subcategory()
    {
        $company_id = $this->session->userdata('company_id');

        $data = [
            'company_id' => $company_id,
            'category_id' => $this->input->post('category_id'),
            'subcategory_name' => $this->input->post('subcategory_name')
        ];

        $this->db->insert('material_subcategories', $data);

        redirect('materials/subcategories');
    }


    public function subcategories()
    {
        $company_id = $this->session->userdata('company_id');

        $data['categories'] = $this->db
            ->where('company_id', $company_id)
            ->order_by('category_name', 'ASC')
            ->get('material_categories')
            ->result();

        $data['subcategories'] =
            $this->Materials_model->getSubCategories($company_id);

        $this->load->view('admin/header');
        $this->load->view('admin/materials/subcategory_list', $data);
        $this->load->view('admin/footer');
    }




    public function material_requests()
    {
        $company_id = $this->session->userdata('company_id');

        $data['requests'] = $this->db
            ->select('
            material_requests.*,
            projects.project_name,
            team_members.name AS employee_name,
            material_categories.category_name,
            material_subcategories.subcategory_name
        ')
            ->from('material_requests')

            ->join('projects', 'projects.id=material_requests.project_id', 'left')

            ->join('team_members', 'team_members.id=material_requests.employee_id', 'left')

            ->join('material_categories', 'material_categories.id=material_requests.category_id', 'left')

            ->join('material_subcategories', 'material_subcategories.id=material_requests.subcategory_id', 'left')

            ->where('material_requests.admin_id', $company_id)

            ->order_by('material_requests.id', 'DESC')

            ->get()
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/materials/material_request_list', $data);
        $this->load->view('admin/footer');
    }

    public function approve_request($id)
    {
        $this->db->where('id', $id);

        $this->db->update('material_requests', array(

            'status' => 'Approved',

            'approved_by' => $this->session->userdata('id'),

            'approved_at' => date('Y-m-d H:i:s')

        ));

        redirect('materials/material_requests');
    }

    public function reject_request($id)
    {
        $this->db->where('id', $id);

        $this->db->update('material_requests', array(

            'status' => 'Rejected',

            'approved_by' => $this->session->userdata('id'),

            'approved_at' => date('Y-m-d H:i:s')

        ));

        redirect('materials/material_requests');
    }


    public function project_reports($project_id)
    {

        $company_id = $this->session->userdata('company_id');
        $cycle_date = $this->input->get('cycle_date');
        $category_id = $this->input->get('category_id');
        $subcategory_id = $this->input->get('subcategory_id');


        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();
        $data['categories'] = $this->db
            ->where('company_id', $company_id)
            ->order_by('category_name', 'ASC')
            ->get('material_categories')
            ->result();

        $data['subcategories'] = $this->db
            ->where('company_id', $company_id)
            ->order_by('subcategory_name', 'ASC')
            ->get('material_subcategories')
            ->result();

        $this->db
            ->select("
        material_report_items.*,

        material_reports.project_id,
        material_reports.employee_id,
        material_reports.cycle_id,
        material_reports.report_date,

        attendance.attendance_date,

        projects.project_name,

        team_members.name AS employee_name,

        material_categories.category_name,
        material_subcategories.subcategory_name
    ")
            ->from('material_report_items')

            ->join(
                'material_reports',
                'material_reports.id = material_report_items.report_id'
            )

            ->join(
                'projects',
                'projects.id = material_reports.project_id',
                'left'
            )

            ->join(
                'team_members',
                'team_members.id = material_reports.employee_id',
                'left'
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

            ->where('material_reports.admin_id', $company_id)

        ;
        if (!empty($cycle_date)) {

            $this->db->where('attendance.attendance_date', $cycle_date);

        }

        if (!empty($category_id)) {

            $this->db->where('material_report_items.category_id', $category_id);

        }

        if (!empty($subcategory_id)) {

            $this->db->where('material_report_items.subcategory_id', $subcategory_id);

        }
        $data['reports'] = $this->db
            ->order_by('material_report_items.subcategory_id', 'ASC')
            ->order_by('material_reports.cycle_id', 'ASC')
            ->order_by('material_reports.report_date', 'ASC')
            ->get()
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/materials/project_material_report_excel', $data);
        $this->load->view('admin/footer');
    }

    public function export_invoice($project_id)
    {
        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        $data['reports'] = $this->db
            ->select("
            material_report_items.*,
            material_reports.project_id,
            material_reports.employee_id,
            material_reports.report_date,
            attendance.attendance_date,
            team_members.name AS employee_name,
            material_subcategories.subcategory_name
        ")
            ->from('material_report_items')
            ->join('material_reports', 'material_reports.id=material_report_items.report_id')
            ->join('attendance', 'attendance.project_id=material_reports.project_id
            AND attendance.employee_id=material_reports.employee_id
            AND attendance.attendance_date=material_reports.report_date', 'left')
            ->join('team_members', 'team_members.id=material_reports.employee_id', 'left')
            ->join('material_subcategories', 'material_subcategories.id=material_report_items.subcategory_id', 'left')
            ->where('material_reports.project_id', $project_id)
            ->get()
            ->result();

        $html = $this->load->view(
            'admin/materials/invoice_pdf',
            $data,
            TRUE
        );
        echo FCPATH . 'vendor/autoload.php';
        // echo "<br>";

        // var_dump(file_exists(FCPATH . 'vendor/autoload.php'));

        // exit;
        $dompdf = new \Dompdf\Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream("Material_Report.pdf", array("Attachment" => false));
    }

}
