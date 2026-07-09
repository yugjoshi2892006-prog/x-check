<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder_model extends CI_Model
{
    private $table = 'folders';

    public function getAll()
    {
        return $this->db
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->order_by('id', 'DESC')
            ->get($this->table)
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
            ->get($this->table)
            ->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->update($this->table, $data);
    }
    public function delete($id)
    {
        return $this->db
            ->where('id', $id)
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
            ->delete($this->table);
    }
}