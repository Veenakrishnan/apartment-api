<?php
use \Firebase\JWT\JWT;
use Restserver\Libraries\REST_Controller;

require APPPATH.'/libraries/ImplementJWT.php';
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->objOfJWT=new ImplementJWT();
        header('Content_Type:application/json');

        $this->load->helper('url');
        $this->load->database();
        $this->load->library('form_validation');  
    }

    public function success($data){
		  $response = new StdClass();
		  $response->code = 0;
		  $response->status = "success";
		  $response->body = $data;
		  return json_encode($response);
    }

    public function failure($message){
		  $response = new StdClass();
		  $response->code = -1;
		  $response->status = "failure";
		  $response->message = $message;
		  return json_encode($response);
    }

    public function sign($user){
       /* $key = PRIVATE_KEY;
        $token = array(
        "iss" => site_url(),
        "sub" => "auth",
        "iat" => time(),
        "exp" => time() + (7 * 24 * 60 * 60), // 7 days; 24 hours; 60 mins; 60 secs
        "userId" => $user->id,
        "role" => $user->status
        );
        return JWT::encode($token, $key, 'RS256');
        */
        
        $token_data['iss']=site_url();
        $token_data['sub']="auth";
        $token_data['timestamp']=time();
        $token_data['exp']=time() + (7 * 24 * 60 * 60); // 7 days; 24 hours; 60 mins; 60 secs
        $token_data['id']=$user->id;
        $jwtToken=$this->objOfJWT->GenerateToken($token_data);
        return json_encode(array('Token'=>$jwtToken));      
    }

    public function verify($received_token){
      //var_dump($received_token);
       // $received_token=$this->input->request_headers('Authorization');
        try{
          $jwtData=$this->objOfJWT->DecodeToken($received_token);
          return $jwtData;
        }
        catch(Exception $e){
          http_response_code('401');
          echo json_encode(array("status"=>false,"message"=>$e->getMessage()));
          exit;
        }
        /*$publicKey = PUBLIC_KEY;
        return JWT::decode($jwt, $publicKey, array('RS256'));*/
    }

    public function request($param){
      $data = json_decode(file_get_contents('php://input'), true);
      if(isset($data[$param])) { 
        return $data[$param]; 
      }
        return null;
    }
    public function isPost(){
      if($_SERVER['REQUEST_METHOD'] === "POST"){
        return true;
      }
        return false;
    }
}