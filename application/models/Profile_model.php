<?php
class Profile_model extends CI_Model
{
    private $table = 'company_profile';

    public function getProfile()
    {
        $company_id =
            $this->session->userdata('company_id');

        return $this->db
            ->where('company_id', $company_id)
            ->get($this->table)
            ->row();
    }

    public function insert($data)
    {
        return $this->db
            ->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }
}