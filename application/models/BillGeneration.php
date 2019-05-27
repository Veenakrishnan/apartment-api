<?php

class BillGeneration extends CI_Model{

   public function getDetails(){
        $query=$this->db->get('apartment');
        $query->result_array();
        return $query->result_array();
   }
}