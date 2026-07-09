<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model
{
    public function getAll()
    {
        return $this->db
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->order_by('id', 'DESC')
            ->get('team_members')
            ->result();
    }

    public function getById($id)
    {
        return $this->db
            ->where('id', $id)
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->get('team_members')
            ->row();
    }

    public function insert($data)
    {
        return $this->db->insert('team_members', $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update('team_members', $data);
    }

    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->delete('team_members');
    }
}