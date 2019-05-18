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

    public function reset($email){
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where("email",$email);
        $query=$this->db->get();
        $user=$query->row();
        return $user;
    }

    public function resetToken($email,$token){
        $postData = array(
            "code"=>$token
        );
        $this->db->where("email",$email);
        $update = $this->db->update("registration",$postData);
        return $update;
    }

}
