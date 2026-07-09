<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function checkLogin($email, $password)
    {
        // Admin Login

        $user = $this->db
            ->where('email', $email)
            ->where('password', $password)
            ->where('status', 1)
            ->get('users')
            ->row();

        if ($user) {
            return $user;
        }

        // Employee Login

        $employee = $this->db
            ->where('email', $email)
            ->where('password', $password)
            ->where('status', 'Active')
            ->get('team_members')
            ->row();

        if ($employee) {

            $employee->role = 'employee';

            return $employee;
        }

        return false;
    }
}