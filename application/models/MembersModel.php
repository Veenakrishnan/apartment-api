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

    public function view($id){
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where("id",$id);
        $query=$this->db->get();
        $profile=$query->row();
        return $profile;
    }

}