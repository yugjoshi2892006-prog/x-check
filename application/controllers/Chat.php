<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function project($project_id)
    {
        $data['project'] = $this->db
            ->where('id', $project_id)
            ->get('projects')
            ->row();

        $data['messages'] = $this->db
            ->where('project_id', $project_id)
            ->order_by('id', 'ASC')
            ->get('project_chat_messages')
            ->result();
        $this->load->view('admin/header');
        $this->load->view('chat/project_chat', $data);
        $this->load->view('admin/footer');

    }



    public function send_message()
    {
        $data = [

            'project_id' => $this->input->post('project_id'),

            'sender_id' => $this->session->userdata('id'),

            'sender_role' => $this->session->userdata('role'),

            'message' => $this->input->post('message'),

            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert(
            'project_chat_messages',
            $data
        );

        echo json_encode([
            'status' => 'success'
        ]);
    }
    public function load_messages($project_id)
    {
        $messages = $this->db
            ->where('project_id', $project_id)
            ->order_by('id', 'ASC')
            ->get('project_chat_messages')
            ->result();

        foreach ($messages as $msg) {
            echo '<div class="mb-2">';

            echo '<b>'
                . $msg->sender_role .
                '</b> : ';

            echo $msg->message;

            echo '</div>';
        }
    }

}