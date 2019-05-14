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
    public function varify(){ 
        $token=$this->input->request_headers();   
        $user = $this->verify($token['Authorization']);
        return $member_id=$user["id"];
    }

    public function profile(){
        $id=$this->varify();
        $this->load->model('MembersModel');
        $profile=$this->MembersModel->view($id);
        if($profile){
            var_dump($profile);
        }
        else{
            echo $this->failure("No Data Found..");
        }
    }

    public function editProfile(){
        if($this->isPost()){
            $mobile=$this->request('mobile');
            $email=$this->request('email');
            $address=$this->request('address');
            $id=$this->varify();
            $postData=array(
                "mobile"=>$mobile,
                "email"=>$email,
                "address"=>$address
            );
            $this->db->where("id",$id);
            $update = $this->db->update("registration",$postData);
            var_dump($update);
            if ($update == true){
                echo $this->success("Profile updated...");
            } else {
                echo $this->failure("Updation Failed..");
            }
        }
        
    }
}


