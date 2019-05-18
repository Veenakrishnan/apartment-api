<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller{

        public function __construct(){
            parent::__construct();
        }
    
        public function login(){
            if($this->isPost()){
                $email = $this->request('email');
                $password = $this->request('password');
                $this->load->model('AuthModel');
                $user = $this->AuthModel->validate($email);
                if($user){
                    if($this->verifyPassword($password,$user->password)){
                        echo $this->success($this->sign($user));
                        }else{
                        echo $this->failure("Invalid credentials");
                    }
                }else{
                        echo $this->failure("Invalid credentials");
                }           
            }
        }

        public function varify(){
            if($this->isPost()){
                $token = $this->request('token');      
                $user = $this->verify($token);
                var_dump($user["id"]);
            }   
        }
        
        private function verifyPassword($password,$hash){
            return password_verify($password,$hash);
        }

        public function resetlink(){
            if($this->isPost()){
                $email=$this->request('email');

                $this->load->model('AuthModel');
                $result=$this->AuthModel->reset($email);
                if(count($result)>0){
                   $token=md5(uniqid($result->name, true));
                   $this->load->model('AuthModel');
                   $res=$this->AuthModel->resetToken($result->email,$token);
                   if(count($res)>0){
                       $msg="Please click on password reset link <br> <a href=".site_url('resetpass?token=').$token.">Reset Password</a>";
                       $this->load->config('email');
                       $this->load->library('email');
                       $from = $this->config->item('smtp_user');
                       $message = $msg;
                       $this->email->set_newline("\r\n");
                       $this->email->from($from);
                       $this->email->to($email);
                       $this->email->subject('Reset your Password');
                       $this->email->message($message);

                    if ($this->email->send()) {
                        echo $this->success('Your Email has successfully been sent.');
                    } else {
                        show_error($this->email->print_debugger());
                    }
                  // $data=$this->email($result->email,'Reset Password Link',$msg);
                   }else{
                    $this->failure("failed");
                   }
                } else{
                    $this->failure("failed");
                }
            }
        }

        public function resetpass(){
            $token=$this->input->get('token');
            if($this->isPost()){
                $pass=$this->request("pass");
                $data=array(
                    $password=> password_hash($password, PASSWORD_BCRYPT)
                );
                $this->load->library('form_validation');
                $this->form_validation->set_data($data);
                $this->form_validation->set_rules("password","Password","required|trim|min_length[8]");
                if($this->form_validation->run() ){
                    $this->db->where("code",$token);
                    $update = $this->db->update("registration",$data);
                    if ($update == true) {
                        echo $this->success("Password Updated...");
                    } else {
                        echo $this->failure("Failed");
                    } 
                }else{
                        $error = $this->form_validation->error_array();
                        echo $this->failure($error);
                } 
            }
        }
}