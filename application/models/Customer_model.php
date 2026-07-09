<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model
{
    private $table = 'customers';

    public function getAll()
    {
        return $this->db
            ->where(
                'company_id',
                $this->session->userdata('company_id')
            )
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
            ->get('customers')
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
    public function get_states()
    {
        return $this->db
            ->select('state')
            ->distinct()
            ->get('customers')
            ->result();
    }

    public function get_cities_by_state($state)
    {
        return $this->db
            ->select('city')
            ->distinct()
            ->where('state', $state)
            ->get('customers')
            ->result();
    }

    private function apply_filter($filter)
    {
        if (!empty($filter['search'])) {
            $this->db->group_start();
            $this->db->like('name', $filter['search']);
            $this->db->or_like('email', $filter['search']);
            $this->db->or_like('mobile', $filter['search']);
            $this->db->group_end();
        }

        if (!empty($filter['state'])) {
            $this->db->where('state', $filter['state']);
        }

        if (!empty($filter['city'])) {
            $this->db->where('city', $filter['city']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }
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