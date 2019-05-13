<?php

class AuthModel extends CI_Model{

    public function validate($email){
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where("email",$email);
        $query=$this->db->get();
        $user=$query->row();
        return $user;
    }
}
