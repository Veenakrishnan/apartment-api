<?php

class AmenitiesModel extends CI_Model{

    public function insert_data($json_data) {
            $this->db->insert('amenities', $json_data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        //$this->db->insert("registration",$data);
    }
}