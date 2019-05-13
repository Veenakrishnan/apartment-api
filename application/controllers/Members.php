<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends MY_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function member_request(){
        $this->load->model('MembersModel');
        $data['guestDetails'] = $this->MembersModel->member_request();
        if ($data['guestDetails']) {
            echo json_encode($data);
            echo $this->success("Member request details...");
        } else {
            echo $this->failure("No member requests..");
        } 
    }

    public function confirm_member($id){
        if($this->isPost()){
            $status=$this->request('status');
        }
            $postData = array(
                "status"=>$status
            );
            $data = array();
            $this->db->where("id",$id);
            $update = $this->db->update("registration",$postData);
            var_dump($update);
        if ($update == true){
            echo $this->success("Member Request Accepted...");
        } else {
            echo $this->failure("No Data Found..");
        }
    }
}

