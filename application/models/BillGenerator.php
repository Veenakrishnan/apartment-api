<?php

class BillGenerator extends CI_Model{

   public function getDetails($id){
      $this->db->select('*');    
      $this->db->from('flat_details');
      $this->db->join('apartment', 'flat_details.apartment_id = apartment.id ');
      $this->db->join('rent', 'flat_details.flat_no = rent.flat_no');
      $this->db->join('registration', 'registration.id = rent.member_id', 'left');
      $query = $this->db->get();      
      return $query; 
       /*$query->result_array();
         return $query->result_array();*/
	}
	
   function fetch_single_details($id)
	{
		$this->db->select('*');    
		$this->db->from('flat_details');
		$this->db->join('apartment', 'flat_details.apartment_id = apartment.id ');
		$this->db->join('rent', 'flat_details.flat_no = rent.flat_no');
		$this->db->join('registration', 'registration.id = rent.member_id','left');
		$this->db->where('flat_details.flat_no', $id);
		$data = $this->db->get(); 
     /* $this->db->where('flat_no', $id);
		$data = $this->db->get('rent');*/
		$output = '<table width="100%" cellspacing="5" cellpadding="5">';
		foreach($data->result() as $row)
		{
			$output .= '
			<tr>			
				<td width="100%">
					<p>Bill ID : '.$row->bill_id.'<label style="margin-left:75%">Block No :'.$row->block_no.'</label></p>
					<p style="margin-left:84%">Flat No : '.$row->flat_no.'</p>
					
					<p style="text-align:center"><b>'.$row->apartment_name.'</b></p><hr>
					<p><b>'.$row->adrs.'<label style="margin-left:80%">Member Details</label></b></p>
					<p style="margin-left:82%" >Member Id:'.$row->member_id.'</p>
					<p style="margin-left:82%">'.$row->name.'</p>
					<p style="margin-left:82%">'.$row->address.'</p><hr>
					<p style="text-align:center"><b>'.date('M-Y').'</b></p><hr>
					<p><b>Rent : </b><label style="margin-left:80%">'.$row->due_amount.'</label></p><hr>
					<p style="margin-left:47%"><b>Total : </b><label style="margin-left:61%">'.$row->due_amount.'</label></p><hr>

					<p><b>Paid Date : </b> '.$row->paid_date.' </p>
				</td>
			</tr>';
		}
		$output .= '
		<tr>
			<td colspan="2" align="center"><a href="'.base_url().'billgeneration/index" class="btn btn-primary">Back</a></td>
		</tr>';
		$output .= '</table>';
		return $output;
	}
}