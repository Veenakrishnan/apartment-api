<?php
defined ('BASEPATH') OR exit('No direct access allowed');

class Apartment extends MY_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function apartment(){
        if($this->isPost()){
            $apartment_name = $this->request('apartment_name');
            $blocks = $this->request('blocks');
            $flat_count = $this->request('flat_count');
            $address = $this->request('address'); 
        }
        $data = array(
            "apartment_name" => $apartment_name,
            "blocks" => $blocks,
            "flat_count" => $flat_count,
            "address" => $address
        ); 

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules("apartment_name","Apartment Name","required|trim|min_length[3]|alpha");
        $this->form_validation->set_rules("blocks","No of Blocks","required|trim");
        $this->form_validation->set_rules("flat_count","No of flats available","required|trim");
        $this->form_validation->set_rules("address","Address","required|trim");

        if($this->form_validation->run() ){
            $this->load->model('ApartmentModel');
            $return = $this->ApartmentModel->insert_data($data);
            if ($return == true) {
                echo $this->success("Insertion Completed...");
            } else {
                $data['result_msg'] = 'Please configure your database correctly';
            } 
        }
        else{
          $error = $this->form_validation->error_array();
          echo $this->failure($error);
          //echo $this->failure("Registration Failed");
        } 
    }
}