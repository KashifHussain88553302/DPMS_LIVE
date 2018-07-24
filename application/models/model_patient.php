<?php 
date_default_timezone_set('Asia/Karachi');
class model_patient extends CI_Model 
{
	public function __construct()	

	{
		  $this->load->database();
	}

	public function GetpatientInfo($user_id)
	{
		
		if($user_id != 0 && $user_id != '')
		{
			$query  = $this->db->query(" 	
										SELECT *,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = tu.user_city
										) AS user_city_name
										FROM tbl_users tu
										WHERE tu.user_id = '$user_id'
										AND user_is_active = 1
									");
		
			$result = $query->result_array();			
			return $result;
		}else
		{
			return 0;
		}
	  	
	}

	public function updateUserProfile()
	{

		$user_id = $this->session->userdata('user_id');

		$First_name = $this->input->post('first_name');
       $Last_name = $this->input->post('last_name');
       $Email = $this->input->post('email');
       $phoneNo = $this->input->post('phoneNo');
      	// echo $phoneNo; die();
       //$country = $this->input->post('txt_ph_no');;
       $city =$this->input->post('sel_city');
       $location =$this->input->post('location');
       $cnic = $this->input->post('cnic');


       $query  = $this->db->query(" 	
										UPDATE tbl_users
										SET 
										user_fname = '$First_name' , 
										user_lname = '$Last_name' ,
										user_email = '$Email' ,
										user_ph_no = '$phoneNo' ,
										user_cnic = '$cnic' ,
										user_city = '$city' ,
										user_location = '$location' 
										WHERE user_id = '$user_id'
									");
		

	}

	public function Getpatientlist()
	{
		

		$WhereCondition = "";
		//$txt_name              	= $this->input->post('txt_name');
		$sel_patient              = $this->input->post('sel_patient');
		$sel_patient_city     = $this->input->post('sel_patient_city');
		$selIsActive 			= $this->input->post('sel_isactive');

		if($selIsActive != '' )
        { 	
        	$WhereCondition = "
										AND tu.user_is_active = $selIsActive ";
        }

		if($this->session->userdata('user_type') == 1) // 1- Doctor
		{ 
			$WhereCondition .= "AND user_id != '".$this->session->userdata('user_id')."'";
		}


		if(isset($_POST['btn_search'] ))
		{
			/*if($txt_name != '')
			{
				$WhereCondition .= "AND user_fname like '%$txt_name%'";
			}*/


			if($sel_patient != '' && $sel_patient != 0)
			{
				$WhereCondition .= "AND user_id = '$sel_patient'";
			} 

			

			if($sel_patient_city != '' && $sel_patient_city != 0 )
			{
				$WhereCondition .= "AND user_city like '$sel_patient_city'";
			} 

			
		}	
		
	  	$query  = $this->db->query(" 	
										SELECT *,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = tu.user_city
										) AS user_city_name
										FROM `tbl_users` tu 
										WHERE 1= 1 
										AND tu.user_type = 2
										$WhereCondition
										ORDER BY user_fname , user_lname
									");
		
		$result = $query->result_array();			
		return $result;
	}
	  
}