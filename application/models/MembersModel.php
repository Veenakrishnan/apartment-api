<?php

class MembersModel extends CI_Model{

    public function member_request(){
        $this->db->select('name,email');
         $this->db->from('registration');
         $this->db->where("status","0");
         $query=$this->db->get();
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

    function fetch_pass($id)
	{
	$fetch_pass=$this->db->query("select * from registration where id='$id'");
	$res=$fetch_pass->result();
	}
	function change_pass($id,$new_pass)
	{
	$update_pass=$this->db->query("UPDATE registration set password='$new_pass'  where id='$id'");
	}

}