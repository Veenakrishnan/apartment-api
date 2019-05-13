<?php
defined ('BASEPATH') OR exit('No direct access allowed');

class Amenities extends MY_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function amenities(){
        if($this->isPost()){
            $amenities_name = $this->request('amenities_name');
        }
        $data = array(
            "amenities_name" => $amenities_name
        ); 

        $this->load->library('form_validation');
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules("amenities_name","Amenities Name","required|trim|is_unique[amenities.amenities_name]");
        
        if($this->form_validation->run() ){
            $this->load->model('AmenitiesModel');
            $return = $this->AmenitiesModel->insert_data($data);
            if ($return == true) {
                echo $this->success("Insertion Completed...");
            } else {
                $data['result_msg'] = 'Please configure your database correctly';
            } 
        }
        else{
          $error = $this->form_validation->error_array();
          echo $this->failure($error);
        } 
    }
}