<?php

class FlatModel extends CI_Model{

    public function insert_data($data){
            $this->db->insert('flat_details',$data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function available_flat(){
         $this->db->select('*');
         $this->db->from('flat_details');
         $this->db->where("status","0");
         $query=$this->db->get();
         $query->result_array();
         return $query->result_array();
    }

    public function filled_flat(){
          $this->db->select('flat_no,block_no,room_count');
          $this->db->from('flat_details');
          $this->db->where("status","1");
          $query=$this->db->get();
          $query->result_array();
          return $query->result_array(); 
     }

     public function total_flat(){
         $query=$this->db->get('flat_details');
         $query->result_array();
         return $query->result_array();
     }

     public function fetchData($data){
        $query=$this->db->get_where('flat_details',$data['condition']);
        return $query->row_array();
     }

     public function booking($data){
        return $this->db->insert('booking',$data);
     }

     public function member_details($id){
        $this->db->select('*');
        $this->db->from('booking');
        $this->db->where("member_id",$id);
        $query=$this->db->get();
        $user=$query->row();
        return $user;
     }

     public function rent_details($flant_no){
        $this->db->select('*');
        $this->db->from('flat_details');
        $this->db->where("flat_no",$flant_no);
        $query=$this->db->get();
        $rent=$query->row();
        return $rent;
     }

     public function payment($data){
        $this->db->insert('rent',$data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
     }
}