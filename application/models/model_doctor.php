<?php 
date_default_timezone_set('Asia/Karachi');
class model_doctor extends CI_Model {

	

	public function __construct()	

	{
		  $this->load->database();
	}
	/**
		kashif hussain on 17 March 2018 
		Comment: function to get list of doctors
	**/
	public function GetListDoctors()
	{
		$WhereCondition = "";
		//$txt_name              	= $this->input->post('txt_name');
		$sel_doctor              = $this->input->post('sel_doctor');
		$sel_doctor_category     = $this->input->post('sel_doctor_category');
		$sel_doctor_city         = $this->input->post('sel_doctor_city');
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


			if($sel_doctor != '' && $sel_doctor != 0)
			{
				$WhereCondition .= "AND user_id = '$sel_doctor'";
			} 

			if($sel_doctor_category != '' && $sel_doctor_category != 0)
			{
				$WhereCondition .= "AND 
									(
										SELECT count(*)
										FROM tbl_doctor td
										WHERE td.fk_user_id = tu.user_id
										AND doctor_category_id = '$sel_doctor_category'
									)>0
									";
			} 

			if($sel_doctor_city != '' && $sel_doctor_city != 0 )
			{
				$WhereCondition .= "AND user_city like '$sel_doctor_city'";
			} 

			
		}	

	  	$query  = $this->db->query(" 	
										SELECT *,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = tu.user_city
										) AS user_city_name,
										(	
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = 
											(	
												SELECT doctor_category_id
												FROM tbl_doctor td
												WHERE td.fk_user_id = tu.user_id
												Limit 1
											)
										) AS user_category_name

										FROM `tbl_users` tu 
										WHERE 1= 1 
										AND tu.user_type = 1
										$WhereCondition
										ORDER BY user_fname , user_lname
									");
		
		$result = $query->result_array();			
		return $result;
	}


	public function GetDoctorDayPlan($Doctor_id="")
	{
		
		$query  = $this->db->query(" 	
										SELECT *
										FROM tbl_doctor_day_plan DDP 
										WHERE DDP.fk_doctor_id = '$Doctor_id'
										ORDER BY DDP.availability_day_no
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function UpdateDoctorDayPlan($doctor_day_plan_id='' , $Temp_day_status='' , $DoctorDayStartTime ='' ,$DoctorDayEndTime='' )
	{
		$timedate = date('Y-m-d H:i:s');
    $FormatedDocotorDayStartTime = date('H:i:s', strtotime($DoctorDayStartTime));
    $FormatedDocotorDayStartTime = date('H:i:s', strtotime($DoctorDayEndTime));
	    if($doctor_day_plan_id != '' && $doctor_day_plan_id != 0)
	    {
	    	$query  = $this->db->query(" 	
										UPDATE tbl_doctor_day_plan
										SET 
										availability_time_start = '$FormatedDocotorDayStartTime' , 
										availability_time_end = '$FormatedDocotorDayStartTime' ,
										Is_active = '$Temp_day_status' ,
										doctor_day_plan_modified_date = '$timedate' 
										WHERE doctor_day_plan_id = '$doctor_day_plan_id'
									");
	    }
	}

	public function GetDoctorInfo($user_id)
  {
    
    if($user_id != 0 && $user_id != '')
    {
      $query  = $this->db->query("  
                    SELECT *,
                    (
						SELECT tcfv.Custom_Field_value_name
						FROM tbl_custom_field_values tcfv
						WHERE tcfv.Custom_Field_Value_ID = tu.user_city
					) AS user_city_name,
					(
						SELECT tcfv.Custom_Field_value_name
						FROM tbl_custom_field_values tcfv
						WHERE tcfv.Custom_Field_Value_ID = tu.user_type
					) AS user_type_name,
					(	
						SELECT doctor_category_id
						FROM tbl_doctor td
						WHERE td.fk_user_id = tu.user_id
						Limit 1
					) As user_category_id,
                    (	
						SELECT tcfv.Custom_Field_value_name
						FROM tbl_custom_field_values tcfv
						WHERE tcfv.Custom_Field_Value_ID = 
						(	
							SELECT doctor_category_id
							FROM tbl_doctor td
							WHERE td.fk_user_id = tu.user_id
							Limit 1
						)
					) AS user_category_name,
					(	
						SELECT doctor_description
						FROM tbl_doctor td
						WHERE td.fk_user_id = tu.user_id
						Limit 1
					) As doctor_description
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

  public function GetDoctorDayPlanDetail ($Doctor_id="")
	{
		
		$query  = $this->db->query(" 	
										SELECT *
										FROM tbl_doctor_day_plan DDP 
										WHERE DDP.fk_doctor_id = '$Doctor_id'
										ORDER BY DDP.availability_day_no
									");
		
		$result = $query->result_array();			
		return $result;
	}


	public function updatedoctorProfile()
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
       $sel_category = $this->input->post('sel_category');
       $txt_description = $this->input->post('txt_description');


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

       $Docquery  = $this->db->query(" 	
										UPDATE tbl_doctor
										SET 
										doctor_category_id = '$sel_category' ,
										doctor_description = '$txt_description' 
										WHERE fk_user_id = '$user_id'
									");
		

	}



  
}