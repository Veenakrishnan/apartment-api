<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillGeneration extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->library('pdf');
    }
    
    public function index(){
      //  if($this->isPost()){
            // $id=$this->request('flat_no');             
            $id='102';
            //var_dump($id);
            $this->load->model('BillGenerator');
            //$query = $this->BillGenerator->getDetails($id);
            $query["apartment"] = $this->BillGenerator->getDetails($id);
           // var_dump($query["apartment"]);
            $this->load->view('Bill',$query);
            
               
       /*     $html_content = '<h3 align="center">Monthly Bill</h3>';
			$html_content .=  $id;
			$this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("".$id.".pdf");*/
            
       // }
    } 
    public function details()
	{
		if($this->uri->segment(3))
		{
            $id = $this->uri->segment(3);
            $this->load->model('BillGenerator');
			$data['apartment'] = $this->BillGenerator->fetch_single_details(102);
			$this->load->view('bill', $data);
		}
	}

	public function pdfdetails()
	{
		if($this->uri->segment(3))
		{
            $this->load->model('BillGenerator');
			$id = $this->uri->segment(3);
			$html_content = '<h3 align="center">Paid Bill Details</h3>';
			$html_content .= $this->BillGenerator->fetch_single_details(102);
            $this->pdf->loadHtml($html_content);
			$this->pdf->render();
			$this->pdf->stream("".$id.".pdf", array("Attachment"=>0));
		}
    } 
    
    public function paymentDate(){
        $this->load->model('BillGenerator');
       $date = $this->BillGenerator->nextPaymentDate();
       if($date){
        echo $this->success($date);
       }
       else{
        echo $this->success("Insertion not Completed...");
       }

    }
}