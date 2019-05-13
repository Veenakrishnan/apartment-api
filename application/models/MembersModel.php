<?php

class MembersModel extends CI_Model{

    public function member_request(){
        $this->db->select('name,email');
         $this->db->from('registration');
         $this->db->where("status","0");
         $query=$this->db->get();
         
        // $query->result_array();
         return $query->result_array();
    }

}