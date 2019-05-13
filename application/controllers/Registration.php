<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller{

    public function __construct(){
        parent::__construct();
    }   
    public function register(){
        if($this->isPost()){
            $name = $this->request('name');
            $mobile = $this->request('mobile');
            $email = $this->request('email');
            $password = $this->request('password'); 
            $address = $this->request('address');
            $status = $this->request('status');

            $data = array(
                "name" => $name,
                "mobile" => $mobile,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_BCRYPT),
                "address" => $address,
                "status"=>$status
            ); 

           // $json_data= json_encode($data);

            $this->load->library('form_validation');
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules("name","Name","required|trim|min_length[3]|alpha");
            $this->form_validation->set_rules("mobile","Mobile","required|trim|max_length[10]|is_unique[registration.mobile]");
            $this->form_validation->set_rules("email","Email","required|trim|valid_email|is_unique[registration.email]");
            $this->form_validation->set_rules("password","Password","required|trim|min_length[5]");
            $this->form_validation->set_rules("address","Address","required|trim");

            if($this->form_validation->run() ){
                $this->load->model('RegistrationModel');
                $return = $this->RegistrationModel->insert_data($data);
                if ($return == true) {
                    echo $this->success("Registration Completed...");
                } else {
                    echo $this->failure("Please configure your database correctly");
                } 
            }
            else{
                    $error = $this->form_validation->error_array();
                    echo $this->failure($error);
            } 
        }
    } 
	
	 public function sign($user){       
        $token_data['iss']=site_url();
        $token_data['sub']="auth";
        $token_data['timestamp']=time();
        $token_data['exp']=time() + (7 * 24 * 60 * 60); // 7 days; 24 hours; 60 mins; 60 secs
        $token_data['id']=$user->id;
        $jwtToken=$this->objOfJWT->GenerateToken($token_data);
        return json_encode(array('Token'=>$jwtToken));      
    }
}