<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materials_model extends CI_Model
{

    public function getCategories($company_id)
    {
        return $this->db
            ->where('company_id', $company_id)
            ->order_by('id', 'DESC')
            ->get('material_categories')
            ->result();
    }


    public function getSubCategories($company_id)
    {
        return $this->db
            ->select('material_subcategories.*, material_categories.category_name')
            ->from('material_subcategories')
            ->join(
                'material_categories',
                'material_categories.id = material_subcategories.category_id',
                'left'
            )
            ->where('material_subcategories.company_id', $company_id)
            ->order_by('material_subcategories.id', 'DESC')
            ->get()
            ->result();
    }

}