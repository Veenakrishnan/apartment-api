<?php

class RegistrationModel extends CI_Model{

    public function insert_data($data) {
            $this->db->insert('registration', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}