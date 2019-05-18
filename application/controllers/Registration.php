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
            $code=md5(uniqid($name, true));
            $data = array(
                "name" => $name,
                "mobile" => $mobile,
                "email" => $email,
                "password" => $password,
                "address" => $address,
                "code" => $code
            ); 
            $postData = array(
                "name" => $name,
                "mobile" => $mobile,
                "email" => $email,
                "password" => password_hash($password, PASSWORD_BCRYPT),
                "address" => $address,
                "code" => $code
            );
        
            $this->load->library('form_validation');
            $this->form_validation->set_data($data);
            $this->form_validation->error_array();
            if($this->form_validation->run('register') ){
                $this->load->model('RegistrationModel');
                $return = $this->RegistrationModel->insert_data($postData);
                if ($return == true) {
                    echo $this->success(array("message"=> "Registration success"));
                    $message = 	"Thank you for Registering...Your activation code is ".$code." ";
                    $this->load->config('email');
                    $this->load->library('email');

                    $from = $this->config->item('smtp_user'); 
                    $this->email->set_newline("\r\n");
                    $this->email->from($from);
                    $this->email->to($email);
                    $this->email->subject('Signup Verification Email');
                    $this->email->message($message);
		                if($this->email->send()){
		    	            $this->session->set_flashdata('message','Activation code sent to email');
		                }else{
                            echo $this->failure(array("message"=> "Please enter valid mailid"));
		                }
                }else{
                    echo $this->failure(array("message" => "Registration failed"));
                } 
            }
            else{
                echo $this->failure($this->form_validation->error_array());
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