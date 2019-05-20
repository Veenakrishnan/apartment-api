<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillGeneration extends MY_Controller{

        public function __construct(){
            parent::__construct();
        }
        
        public function index(){
            if($this->isPost()){
                $id=$this->request('id');
            }  

            $this->load->model('BillGeneration');
            $query = $this->apartmentDetails->getDetails($id);

            var_dump($query);
            $this->load->view('Bill');
        }
}