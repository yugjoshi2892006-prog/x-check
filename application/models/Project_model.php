<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProjectProgress($project_id)
    {
        $total = $this->db
            ->select_sum('weighted_percent')
            ->where('project_id', $project_id)
            ->get('project_areas')
            ->row()
            ->weighted_percent;

        if (!$total) {
            return 0;
        }

        $completed = $this->db->query("
        SELECT SUM(pa.weighted_percent) progress
        FROM project_areas pa
        WHERE pa.project_id = $project_id
        AND pa.id IN (
            SELECT DISTINCT area_id
            FROM project_images
            WHERE project_id = $project_id
        )
    ")->row()->progress;

        return round(($completed / $total) * 100);
    }



  

}