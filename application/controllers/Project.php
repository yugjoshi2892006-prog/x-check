<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }




        $this->load->model('Project_model');
        $this->company_id = $this->session->userdata('company_id');

        $this->load->model('Project_model');
    }




    public function add()
    {
        $data['customers'] = $this->db
            ->where('company_id', $this->company_id)
            ->get('customers')
            ->result();

        $data['teams'] = $this->db
            ->where('company_id', $this->company_id)
            ->get('team_members')
            ->result();

        $data['folders'] = $this->db
            ->where('company_id', $this->company_id)
            ->get('folders')
            ->result();

        $data['priority_categories'] = $this->db
            ->where('company_id', $this->company_id)
            ->get('material_categories')
            ->result();

        // Agar normal page load hai toh initial ID 0 ya null rahegi
        $data['project_id'] = $this->session->flashdata('project_id') ? $this->session->flashdata('project_id') : 0;

        $this->load->view('admin/header');
        $this->load->view('admin/project_add', $data);
        $this->load->view('admin/footer');
    }
    /**
     * AJAX SAVE PROJECT
     */
    public function save_step1()
    {
        $draft_token = uniqid('draft_');

        $project_data = [
            'category_id' => $this->input->post('category_id'),
            'subcategory_id' => $this->input->post('subcategory_id'),
            'customer_id' => $this->input->post('customer_id'),
            'customer_user_id' => $this->input->post('customer_user_id'),
            'project_name' => $this->input->post('project_name'),
            'mobile' => $this->input->post('mobile'),

            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),

            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city_id' => $this->input->post('city_id'),

            'address' => $this->input->post('address'),

            'engineer_ids' => $this->input->post('engineer_ids'),
            'project_manager_ids' => $this->input->post('project_manager_ids'),

            'monitoring_cycle' => $this->input->post('monitoring_cycle'),
            'status' => $this->input->post('status')
        ];


        $insert = [

            'draft_token' => $draft_token,

            'basic_data' => json_encode($project_data),

            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->db->insert(
            'project_drafts',
            $insert
        );

        echo json_encode([

            'status' => 'success',

            'draft_token' => $draft_token

        ]);
    }
    /**
     * ADD FLOOR VIA AJAX
     */
    public function add_floor()
    {
        $project_id = $this->input->post('project_id');

        if (empty($project_id)) {

            echo json_encode([
                'status' => 'error',
                'message' => 'Project ID missing'
            ]);

            return;
        }

        $file_name = '';

        if (!empty($_FILES['floor_plan']['name'])) {

            if (!is_dir('./uploads/floor_plan/')) {
                mkdir('./uploads/floor_plan/', 0777, true);
            }

            $config['upload_path'] = './uploads/floor_plan/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('floor_plan')) {

                $upload_data = $this->upload->data();

                $file_name = $upload_data['file_name'];

            } else {

                echo json_encode([
                    'status' => 'error',
                    'message' => $this->upload->display_errors()
                ]);

                return;
            }
        }

        $data = array(

            'project_id' => $project_id,

            'floor_name' => $this->input->post('floor_name'),

            'floor_image' => $file_name,

            'created_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('project_floors', $data);

        echo json_encode([
            'status' => 'success',
            'floor_id' => $this->db->insert_id()
        ]);
    }

    /**
     * GET FLOOR LIST (OPTIONAL AJAX)
     */
    public function get_floors($project_id)
    {
        $floors = $this->db
            ->where('project_id', $project_id)
            ->get('project_floors')
            ->result();

        echo json_encode($floors);
    }

    /**
     * DELETE FLOOR (OPTIONAL)
     */
    public function delete_floor($floor_id)
    {
        $this->db->where('id', $floor_id);
        $this->db->delete('project_floors');

        echo json_encode([
            'status' => 'success'
        ]);
    }

    public function get_customer()
    {
        $id = $this->input->post('customer_id');

        $customer = $this->db
            ->where('id', $id)
            ->where('company_id', $this->company_id)
            ->get('customers')
            ->row();

        echo json_encode($customer);
    }


    public function get_customer_users()
    {
        $customer_id = $this->input->post('customer_id');

        $users = $this->db
            ->where('customer_id', $customer_id)
            ->get('customer_users')
            ->result();

        echo json_encode($users);
    }

    public function floors($draft_token)
    {
        $data['draft_token'] = $draft_token;

        $data['floors'] = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_floors')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_floor', $data);
        $this->load->view('admin/footer');
    }
    public function save_floor()
    {
        $draft_token = $this->input->post('draft_token');

        $file_name = '';

        if (!empty($_FILES['floor_plan']['name'])) {
            $config['upload_path'] =
                './uploads/floor_plan/';

            $config['allowed_types'] =
                'jpg|jpeg|png|pdf';

            $config['encrypt_name'] = TRUE;

            $this->load->library(
                'upload',
                $config
            );

            if (
                $this->upload->do_upload(
                    'floor_plan'
                )
            ) {
                $upload =
                    $this->upload->data();

                $file_name =
                    $upload['file_name'];
            }
        }

        $this->db->insert(
            'draft_floors',
            [

                'draft_token' => $draft_token,

                'floor_name' =>
                    $this->input->post('floor_name'),

                'floor_image' => $file_name

            ]
        );

        redirect(
            'project/floors/' . $draft_token
        );
    }

    public function areas($draft_token)
    {
        $data['draft_token'] = $draft_token;

        $data['floors'] = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_floors')
            ->result();

        $data['areas'] = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_areas')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_area', $data);
        $this->load->view('admin/footer');
    }

    public function save_area()
    {
        $draft_token = $this->input->post('draft_token');

        $width = (float) $this->input->post('width');
        $length = (float) $this->input->post('length');

        $data = [

            'draft_token' => $draft_token,

            'floor_temp_id' => $this->input->post('floor_id'),

            'area_name' => $this->input->post('area_name'),

            'width' => $width,

            'length' => $length,

            'sq_ft' => ($width * $length),

            'weighted_percent' => $this->input->post('weighted_percent'),

            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->db->insert('draft_areas', $data);

        redirect('project/areas/' . $draft_token);
    }

    public function camera($draft_token)
    {
        $data['draft_token'] = $draft_token;
        $data['floors'] = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_floors')
            ->result();

        $data['selected_floor'] = null;

        if (!empty($data['floors'])) {
            $data['selected_floor'] = $data['floors'][0];
        }

        $data['cameras'] = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_cameras')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_camera', $data);
        $this->load->view('admin/footer');
    }

    public function save_camera()
    {
        $data = [

            'draft_token' => $this->input->post('draft_token'),
            'floor_temp_id' => $this->input->post('floor_id'),
            'camera_no' => $this->input->post('camera_name'),
            'view_angle' => 90,
            'image_path' => '',
            'x_position' => $this->input->post('x'),
            'y_position' => $this->input->post('y'),
            'created_at' => date('Y-m-d H:i:s')

        ];

        $this->db->insert('draft_cameras', $data);

        echo json_encode([
            'status' => 'success'
        ]);
    }
    public function finish()
    {
        $draft_token = $this->input->post('draft_token');

        if (empty($draft_token)) {

            echo json_encode([
                'status' => 'error',
                'message' => 'Draft token missing'
            ]);
            return;
        }

        $draft = $this->db
            ->where('draft_token', $draft_token)
            ->get('project_drafts')
            ->row();

        if (!$draft) {

            echo json_encode([
                'status' => 'error',
                'message' => 'Draft not found'
            ]);
            return;
        }

        // Duplicate Project Stop
        if (!empty($draft->is_completed) && $draft->is_completed == 1) {

            echo json_encode([
                'status' => 'error',
                'message' => 'Project already created'
            ]);
            return;
        }

        $basic = json_decode($draft->basic_data, true);

        $project = [
            'company_id' => $this->company_id,
            'customer_id' => $basic['customer_id'] ?? 0,
            'customer_user_id' => $basic['customer_user_id'] ?? 0,
            'project_name' => $basic['project_name'] ?? '',
            'mobile' => $basic['mobile'] ?? '',

            'country_id' => $basic['country_id'] ?? 0,
            'state_id' => $basic['state_id'] ?? 0,
            'city_id' => $basic['city_id'] ?? 0,

            'address' => $basic['address'] ?? '',

            'start_date' => $basic['start_date'] ?? NULL,
            'end_date' => $basic['end_date'] ?? NULL,

            'engineer_id' => !empty($basic['engineer_ids'])
                ? $basic['engineer_ids'][0]
                : 0,

            'project_manager_id' => !empty($basic['project_manager_ids'])
                ? $basic['project_manager_ids'][0]
                : 0,

            'monitoring_cycle' => $basic['monitoring_cycle'] ?? 0,
            'status' => $basic['status'] ?? 'Pending',

            'created_at' => date('Y-m-d H:i:s')
        ];

        // PROJECT INSERT
        $this->db->insert('projects', $project);

        $project_id = $this->db->insert_id();
        $this->db->insert('project_chat_rooms', [
            'project_id' => $project_id
        ]);
        if (!empty($basic['category_id'])) {

            foreach ($basic['category_id'] as $k => $cat) {

                if (empty($cat))
                    continue;

                $this->db->insert('project_priority_materials', [

                    'project_id' => $project_id,

                    'category_id' => $cat,

                    'subcategory_id' => $basic['subcategory_id'][$k],

                    'created_at' => date('Y-m-d H:i:s')

                ]);

            }

        }
        // echo "<pre>";
        // print_r($basic);
        // exit;
        if (!empty($basic['engineer_ids'])) {

            foreach ($basic['engineer_ids'] as $eng) {

                $this->db->insert('project_team', [
                    'project_id' => $project_id,
                    'team_member_id' => $eng,
                    'role' => 'engineer'
                ]);

            }

        }

        foreach ($basic['project_manager_ids'] as $mgr) {
            $this->db->insert('project_team', [
                'project_id' => $project_id,
                'team_member_id' => $mgr,
                'role' => 'manager'
            ]);
        }
        // FLOORS
        $floors = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_floors')
            ->result();

        $floor_map = [];

        foreach ($floors as $floor) {

            $this->db->insert('project_floors', [
                'company_id' => $this->company_id,

                'project_id' => $project_id,
                'floor_name' => $floor->floor_name,
                'floor_image' => $floor->floor_image,
                'created_at' => date('Y-m-d H:i:s')

            ]);

            $floor_map[$floor->id] = $this->db->insert_id();
        }

        // AREAS
        $areas = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_areas')
            ->result();

        foreach ($areas as $area) {

            $this->db->insert('project_areas', [
                'company_id' => $this->company_id,

                'project_id' => $project_id,
                'floor_id' => $floor_map[$area->floor_temp_id] ?? 0,
                'area_name' => $area->area_name,
                'sq_ft' => $area->sq_ft,
                'width' => $area->width,
                'length' => $area->length,
                'weighted_percent' => $area->weighted_percent,
                'created_at' => date('Y-m-d H:i:s')

            ]);
        }

        // CAMERAS
        $cams = $this->db
            ->where('draft_token', $draft_token)
            ->get('draft_cameras')
            ->result();

        $camera_no = 1;

        foreach ($cams as $cam) {

            $this->db->insert('project_cameras', [
                'company_id' => $this->company_id,
                'project_id' => $project_id,
                'floor_id' => $floor_map[$cam->floor_temp_id] ?? 0,
                'camera_no' => $camera_no++,
                'x_position' => $cam->x_position,
                'y_position' => $cam->y_position,
                'created_at' => date('Y-m-d H:i:s')

            ]);
        }

        // Draft Complete Mark
        $this->db->where('id', $draft->id);
        $this->db->update('project_drafts', [
            'is_completed' => 1
        ]);

        echo json_encode([
            'status' => 'success',
            'project_id' => $project_id
        ]);
    }

    public function project_list()
    {
        $data['projects'] = $this->db
            ->select("
                        p.*,
                        c.name as customer_name,
                        eng.name as engineer_name,
                        pm.name as manager_name
                    ")
            ->from('projects p')
            ->where('p.company_id', $this->company_id)
            ->join('customers c', 'c.id=p.customer_id', 'left')
            ->join('team_members eng', 'eng.id=p.engineer_id', 'left')
            ->join('team_members pm', 'pm.id=p.project_manager_id', 'left')
            ->order_by('p.id', 'DESC')
            ->get()
            ->result();
        foreach ($data['projects'] as $key => $project) {
            $data['projects'][$key]->progress =
                $this->Project_model->getProjectProgress($project->id);
        }
        foreach ($data['projects'] as $key => $project) {
            // Engineers

            $engineers = $this->db
                ->select('team_members.name')
                ->from('project_team')
                ->join(
                    'team_members',
                    'team_members.id = project_team.team_member_id'
                )
                ->where('project_team.project_id', $project->id)
                ->where('project_team.role', 'engineer')
                ->get()
                ->result();

            $data['projects'][$key]->engineers =
                implode(', ', array_column($engineers, 'name'));



            // Managers

            $managers = $this->db
                ->select('team_members.name')
                ->from('project_team')
                ->join(
                    'team_members',
                    'team_members.id = project_team.team_member_id'
                )
                ->where('project_team.project_id', $project->id)
                ->where('project_team.role', 'manager')
                ->get()
                ->result();

            $data['projects'][$key]->managers =
                implode(', ', array_column($managers, 'name'));
        }

        $data['customers'] = $this->db->get('customers')->result();
        $data['engineers'] = $this->db->get('team_members')->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_list', $data);
        $this->load->view('admin/footer');
    }



    public function update($id)
    {

        $data = [

            'customer_id' => $this->input->post('customer_id'),
            'customer_user_id' => $this->input->post('customer_user_id'),
            'project_name' => $this->input->post('project_name'),
            'mobile' => $this->input->post('mobile'),
            'address' => $this->input->post('address'),
            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city_id' => $this->input->post('city_id'),
            'engineer_ids' => $this->input->post('engineer_ids'),
            'project_manager_ids' => $this->input->post('project_manager_ids'),
            'monitoring_cycle' => $this->input->post('monitoring_cycle'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'status' => $this->input->post('status')
        ];

        $this->db->where('id', $id);
        $this->db->update('projects', $data);

        redirect('project/project_list');
    }

    public function add_project_floor()
    {
        $project_id = $this->input->post('project_id');

        $file_name = '';

        if (!empty($_FILES['floor_plan']['name'])) {
            $config['upload_path'] = './uploads/floor_plan/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf';
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('floor_plan')) {
                $upload = $this->upload->data();
                $file_name = $upload['file_name'];
            }
        }

        $this->db->insert('project_floors', [

            'company_id' => $this->company_id,
            'project_id' => $project_id,
            'floor_name' => $this->input->post('floor_name'),
            'floor_image' => $file_name,
            'created_at' => date('Y-m-d H:i:s')

        ]);

        redirect('project/edit_floors/' . $project_id);
    }




    public function add_project_area()
    {
        $project_id = $this->input->post('project_id');

        $data = [

            'project_id' => $project_id,
            'floor_id' => $this->input->post('floor_id'),
            'area_name' => $this->input->post('area_name'),
            'width' => $this->input->post('width'),
            'length' => $this->input->post('length'),
            'sq_ft' => $this->input->post('width') * $this->input->post('length')

        ];

        $this->db->insert('project_areas', $data);

        redirect('project/edit_areas/' . $project_id);
    }




    public function update_camera_position()
    {
        $project_id = $this->input->post('project_id');
        $floor_id = $this->input->post('floor_id');
        $camera_no = $this->input->post('camera_name');

        $data = [

            'project_id' => $project_id,
            'floor_id' => $floor_id,
            'camera_no' => $camera_no,
            'x_position' => $this->input->post('x'),
            'y_position' => $this->input->post('y')

        ];

        $exist = $this->db
            ->where('project_id', $project_id)
            ->where('camera_no', $camera_no)
            ->get('project_cameras')
            ->row();

        if ($exist) {

            $this->db
                ->where('id', $exist->id)
                ->update('project_cameras', $data);

        } else {

            $data['created_at'] = date('Y-m-d H:i:s');

            $this->db->insert(
                'project_cameras',
                $data
            );
        }

        echo json_encode([
            'status' => 'success'
        ]);
    }
    public function update_step1($project_id)
    {
        $engineers = $this->input->post('engineer_ids');
        $managers = $this->input->post('project_manager_ids');

        $data = [

            'customer_id' => $this->input->post('customer_id'),
            'customer_user_id' => $this->input->post('customer_user_id'),
            'project_name' => $this->input->post('project_name'),
            'mobile' => $this->input->post('mobile'),

            'country_id' => $this->input->post('country_id'),
            'state_id' => $this->input->post('state_id'),
            'city_id' => $this->input->post('city_id'),

            'address' => $this->input->post('address'),

            'monitoring_cycle' => $this->input->post('monitoring_cycle'),

            'engineer_id' => !empty($engineers) ? $engineers[0] : 0,
            'project_manager_id' => !empty($managers) ? $managers[0] : 0,

            'status' => $this->input->post('status'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date')
        ];
        $this->db->where('id', $project_id);
        $this->db->update('projects', $data);
        // old team remove
        $categories = $this->input->post('category_id');
        $this->db->where('project_id', $project_id);
        $this->db->delete('project_team');

        // engineers save
        $engineers = $this->input->post('engineer_ids');

        if (!empty($engineers)) {
            foreach ($engineers as $eng) {
                $this->db->insert('project_team', [
                    'project_id' => $project_id,
                    'team_member_id' => $eng,
                    'role' => 'engineer'
                ]);
            }
        }

        // managers save
        $managers = $this->input->post('project_manager_ids');

        if (!empty($managers)) {
            foreach ($managers as $mgr) {
                $this->db->insert('project_team', [
                    'project_id' => $project_id,
                    'team_member_id' => $mgr,
                    'role' => 'manager'
                ]);
            }
        }// Delete old materials
        $this->db->where('project_id', $project_id);
        $this->db->delete('project_priority_materials');

        // Save new materials
        $categories = $this->input->post('category_id');
        $subcategories = $this->input->post('subcategory_id');

        if (!empty($categories)) {

            foreach ($categories as $key => $cat) {

                if (empty($cat)) {
                    continue;
                }

                $this->db->insert('project_priority_materials', [

                    'project_id' => $project_id,
                    'category_id' => $cat,
                    'subcategory_id' => $subcategories[$key],
                    'created_at' => date('Y-m-d H:i:s')

                ]);
            }
        }

        redirect('project/edit_floors/' . $project_id);
    }
    public function edit_floors($project_id)
    {
        $data['project_id'] = $project_id;

        $data['floors'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_floors')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_floor_edit', $data);
        $this->load->view('admin/footer');
    }
    public function edit_areas($project_id = 0)
    {
        if (!$project_id) {
            redirect('project/project_list');
        }

        $data['project_id'] = $project_id;

        $data['floors'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_floors')
            ->result();

        $data['areas'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_areas')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_area_edit', $data);
        $this->load->view('admin/footer');
    }
    public function edit_camera($project_id)
    {
        $data['project_id'] = $project_id;

        $data['floors'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_floors')
            ->result();

        $data['selected_floor'] = null;

        if (!empty($data['floors'])) {
            $data['selected_floor'] = $data['floors'][0];
        }

        $data['cameras'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_cameras')
            ->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_camera_edit', $data);
        $this->load->view('admin/footer');
    }
    public function edit($project_id)
    {


        $data['project'] = $this->db
            ->where('id', $project_id)
            ->where('company_id', $this->company_id)
            ->get('projects')
            ->row();

        $data['priority_categories'] = $this->db
            ->where('company_id', $this->company_id)
            ->get('material_categories')
            ->result();
        // echo "<pre>";
        // print_r($data['project']);
        // exit;
        $engineers = $this->db
            ->where('project_id', $project_id)
            ->where('role', 'engineer')
            ->get('project_team')
            ->result();

        $data['selected_engineers'] = array_column(
            $engineers,
            'team_member_id'
        );

        $data['priority_materials'] = $this->db
            ->where('project_id', $project_id)
            ->get('project_priority_materials')
            ->result();


        $managers = $this->db
            ->where('project_id', $project_id)
            ->where('role', 'manager')
            ->get('project_team')
            ->result();

        $data['selected_managers'] = array_column(
            $managers,
            'team_member_id'
        );
        $data['customers'] = $this->db->get('customers')->result();
        $data['teams'] = $this->db
            ->where('company_id', $this->company_id)
            ->get('team_members')
            ->result();
        $data['folders'] = $this->db->get('folders')->result();

        $this->load->view('admin/header');
        $this->load->view('admin/project_edit', $data);
        $this->load->view('admin/footer');
    }

    // public function edit($project_id)
    // {
    //     echo "Project ID : " . $project_id . "<br>";
    //     echo "Company ID : " . $this->company_id . "<br><br>";

    //     $data['project'] = $this->db
    //         ->where('id', $project_id)
    //         ->where('company_id', $this->company_id)
    //         ->get('projects')
    //         ->row();

    //     echo "<pre>";
    //     var_dump($data['project']);
    //     exit;
    // }


    // public function update_step1($id)
    // {
    //     $data = [

    //         'customer_id' => $this->input->post('customer_id'),
    //         'customer_user_id' => $this->input->post('customer_user_id'),
    //         'project_name' => $this->input->post('project_name'),
    //         'mobile' => $this->input->post('mobile'),
    //         'country_id' => $this->input->post('country_id'),
    //         'state_id' => $this->input->post('state_id'),
    //         'city_id' => $this->input->post('city_id'),
    //         'address' => $this->input->post('address'),
    //         'start_date' => $this->input->post('start_date'),
    //         'end_date' => $this->input->post('end_date'),
    //         'engineer_id' => $this->input->post('engineer_id'),
    //         'project_manager_id' => $this->input->post('project_manager_id'),
    //         'monitoring_cycle' => $this->input->post('monitoring_cycle'),
    //         'status' => $this->input->post('status')
    //     ];

    //     $this->db->where('id', $id);
    //     $this->db->update('projects', $data);

    //     redirect('project/edit_floors/' . $id);
    // }



    public function delete($project_id)
    {
        // Project check with company security
        $project = $this->db
            ->where('id', $project_id)
            ->where('company_id', $this->company_id)
            ->get('projects')
            ->row();

        if (!$project) {
            $this->session->set_flashdata('error', 'Project not found');
            redirect('project/project_list');
        }

        // Delete Cameras
        $this->db->where('project_id', $project_id);
        $this->db->delete('project_cameras');

        // Delete Areas
        $this->db->where('project_id', $project_id);
        $this->db->delete('project_areas');

        // Delete Floors
        $this->db->where('project_id', $project_id);
        $this->db->delete('project_floors');

        // Delete Main Project
        $this->db->where('id', $project_id);
        $this->db->where('company_id', $this->company_id);
        $this->db->delete('projects');

        $this->session->set_flashdata('success', 'Project deleted successfully');

        redirect('project/project_list');
    }

    public function project_monitoring()
    {
        $company_id = $this->session->userdata('company_id');

        $data['projects'] = $this->db
            ->where('company_id', $company_id)
            ->get('projects')
            ->result();

        foreach ($data['projects'] as $key => $project) {
            $data['projects'][$key]->progress =
                $this->Project_model->getProjectProgress($project->id);
        }

        $this->load->view('admin/header');
        $this->load->view('admin/project_monitoring', $data);
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

        $data['progress'] =
            $this->Project_model->getProjectProgress($project_id);

        $this->load->view('admin/header');
        $this->load->view('admin/project_dashboard', $data);
        $this->load->view('admin/footer');
    }

    // public function monitoring_images($project_id)
    // {
    //     $data['project'] = $this->db
    //         ->where('id', $project_id)
    //         ->get('projects')
    //         ->row();

    //     $data['cycles'] = $this->db
    //         ->select('cycle_id')
    //         ->from('project_images')
    //         ->where('project_id', $project_id)
    //         ->group_by('cycle_id')
    //         ->order_by('cycle_id', 'ASC')
    //         ->get()
    //         ->result();

    //     $this->load->view('admin/header');
    //     $this->load->view('admin/monitoring_images', $data);
    //     $this->load->view('admin/footer');
    // }

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


    public function get_priority_subcategories()
    {
        $category_id = $this->input->post('category_id');

        $data = $this->db
            ->where('category_id', $category_id)
            ->get('material_subcategories')
            ->result();

        echo json_encode($data);
    }


}