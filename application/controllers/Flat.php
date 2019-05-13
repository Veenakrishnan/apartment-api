<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flat extends MY_Controller{

    public function __construct(){
        parent::__construct();
    }   

    public function flat(){
        if($this->isPost()){
            $flat_no = $this->request('flat_no');
            $block_no = $this->request('block_no');
            $bedroom_count = $this->request('bedroom_count');
            $bathroom_count = $this->request('bathroom_count'); 
            $room_count = $this->request('room_count');
            $amenities = $this->request('amenities');
            $rent = $this->request('rent');
            $advance = $this->request('advance');
            $status = $this->request('status');

            $data = array(
                "flat_no" => $flat_no,
                "block_no" => $block_no,
                "bedroom_count" => $bedroom_count,
                "bathroom_count" => $bathroom_count,
                "room_count" => $room_count,
                "amenities" => $amenities,
                "rent" => $rent,
                "advance" => $advance,
                "status" => $status
            ); 

           // $json_data= json_encode($data);

            $this->load->library('form_validation');
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules("flat_no","Flat Number","required|trim|is_unique[flat_details.flat_no]");
            $this->form_validation->set_rules("block_no","Block Number","required|trim");
            $this->form_validation->set_rules("bedroom_count","TotalBedroom","required|trim");
            $this->form_validation->set_rules("bathroom_count","TotalBathroom","required|trim");
            $this->form_validation->set_rules("room_count","Totalrooms","required|trim");
            $this->form_validation->set_rules("amenities","Amenities","required|trim");
            $this->form_validation->set_rules("rent","Rent","required|trim");
            $this->form_validation->set_rules("advance","AdvancePayment","required|trim");
            $this->form_validation->set_rules("status","Flat Status","required|trim");

            if($this->form_validation->run()){
                $this->load->model('FlatModel');
                $return = $this->FlatModel->insert_data($data);
                if ($return == true) {
                    echo $this->success("Data Inserted...");
                } else {
                    echo $this->failure("Insertion failed..");
                } 
            }
            else{
                    $error = $this->form_validation->error_array();
                    echo $this->failure($error);
            } 
        }
    }   

    public function available_list(){
        $this->load->model('FlatModel');
        $data = $this->FlatModel->available_flat();
        if ($data) {       
            //echo json_encode($data);
            echo $this->success("Flat available...");
        } else {
            echo $this->failure("No Data Found..");
        } 
    }

    public function filled_list(){
        $this->load->model('FlatModel');
        $data['flatDetails'] = $this->FlatModel->filled_flat();
        if ($data['flatDetails']) {
            echo json_encode($data);
            echo $this->success("Flat are filled...");
        } else {
            echo $this->failure("No Data Found..");
        } 
    }

    public function flatDetails(){
        $this->load->model('FlatModel');
        $data['flatDetails'] = $this->FlatModel->total_flat();
        if ($data['flatDetails']) {
            echo json_encode($data);
            echo $this->success("Flat details...");
        } else {
            echo $this->failure("No Data Found..");
        } 
    }

    public function singleData($id=''){
        $data['condition']=array('id'=>$id);
        $this->load->model('FlatModel');
        $result=$this->FlatModel->fetchData($data);
        // echo json_encode($data);
        if ($result == true) {
           // var_dump($result["id"]);
            echo $this->success($result);
        } else {
            echo $this->failure("No Data Found..");
        } 
    }

    public function varify(){ 
        $token=$this->input->request_headers();   
        $user = $this->verify($token['Authorization']);
        return $member_id=$user["id"];
    }

    public function flat_booking(){
        if(isset($_POST)){
            $flat_id=$this->request('flat_id');
            $booking_end_date=$this->request('booking_end_date');          
            $status=$this->request('status');
            $member_id=$this->varify();
            $this->load->model('FlatModel');
            $advance_payment=$this->FlatModel->rent_details($flat_id);
            var_dump($advance_payment);
            $data=array(
                "member_id"=>$member_id,
                "flat_id"=>$flat_id,
                "booking_start_date"=>date('y-m-d'),
                "booking_end_date"=>$booking_end_date,
                "advance_payment"=>$advance_payment->advance,
                "booking_status"=>$status
            );
            
            $this->load->library('form_validation');
            $this->form_validation->set_data($data);

            $this->form_validation->set_rules("flat_id","Flat No","required|trim|is_unique[booking.flat_id]");
            $this->form_validation->set_rules("booking_end_date","Booking end date","required|trim");
            
            if($this->form_validation->run()){
                $this->load->model('FlatModel');
                var_dump($data);
                $result=$this->FlatModel->booking($data);
                if($result){
                   // var_dump($data);
                   // echo json_encode($data);
                   $postData = array(
                    "status"=>"1"
                   );
                $data = array();
                $this->db->where("flat_no",$flat_id);
                $update = $this->db->update("flat_details",$postData);
                if($update)
                    echo $this->success("Flat booked successfully...");
                }
                else{
                    echo $this->failure("Insertion failed...");
                }
            }
            echo $this->failure("error...");
        }
    }

    public function rent(){
        if($this->isPost()){
            $member_id=$this->varify();
            var_dump($member_id);
            $this->load->model('FlatModel');
            $user=$this->FlatModel->member_details($member_id);
            $this->load->model('FlatModel');
            $rent=$this->FlatModel->rent_details($user->flat_id);
            $data=array(
                "member_id"=>$user->member_id,
                "flat_no"=>$user->flat_id,
                "due_amount"=>$rent->rent,
                "paid_date"=>date('y-m-d')
            );
           // var_dump($data);
                $this->load->model('FlatModel');
                $result=$this->FlatModel->payment($data);
                if($result){
                    var_dump($data);
                    echo json_encode($data);
                    echo $this->success("Paid rent successfully...");
                }
                else{
                    echo $this->failure("Payment failed...");
                }
            }
        }

    public function edit($id){       
        if($this->isPost()){
        //get post data
              $amenities=$this->request("amenities");
              $rent=$this->request('rent');
              $advance=$this->request('advance');
              $status=$this->request('status');
       
            $postData = array(
                "amenities"=>$amenities,
                "rent"=>$rent,
                "advance"=>$advance,
                "status"=>$status
            );

            $data = array();
            var_dump($postData);
            $this->db->where("id",$id);
             //$this->db->get('flat_details');
            $update = $this->db->update("flat_details",$postData);
            var_dump($update);

            if ($update == true) {
                echo $this->success($update);
            } else {
                echo $this->failure("No Data Found..");
            }
        }
     }
}