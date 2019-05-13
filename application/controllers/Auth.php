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
                //$user= json_encode($user);
                if($user){
                    if($this->verifyPassword($password,$user->password)){
                        echo $this->success($this->sign($user));
                        } else{
                        echo $this->failure("Invalid credentials");
                    }
                } else {
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
}