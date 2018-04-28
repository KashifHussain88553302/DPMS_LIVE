<?php 
date_default_timezone_set('Asia/Karachi');
class model_user extends CI_Model {

	

	public function __construct()	

	{
		  $this->load->database();
	}

	public function AddNewuser()
	{
		$txt_first_name             = $this->input->post('txt_first_name');
        $txt_last_name              = $this->input->post('txt_last_name');
        $txt_user_name              = $this->input->post('txt_user_name');
        $txt_password               = $this->input->post('txt_password');
        $txt_retype_password        = $this->input->post('txt_retype_password');
        //$txt_ph_no                  = $this->input->post('txt_ph_no');
        $phoneNo                    = $this->input->post('phoneNo');
      	$txt_cnic                   = $this->input->post('txt_cnic');

      	$user_type                  = $this->input->post('user_type');
      	$txt_email                  = $this->input->post('txt_email');
      	$sel_city                 	= $this->input->post('sel_city');
      	$sel_doctor_category        = $this->input->post('sel_doctor_category');
      	
	      

        $ecryptedPassword = md5($txt_password); // Apply encryption;

		$query = $this->db->query("
									INSERT iNTO tbl_users
									(
									    user_fname,
									    user_lname,
									    user_uname,
									    user_email,
									    user_pass,
									    user_ph_no,
									    user_cnic,
									    user_type,
									    user_city
									)
									VALUES 
									(
									'$txt_first_name',
									'$txt_last_name',
									'$txt_user_name',
									'$txt_email',
									'$ecryptedPassword ',
									'$phoneNo',
									'$txt_cnic',
									'$user_type',
									'$sel_city'
									)	
								");

		$result = $this->db->insert_id();
		return $result;
		
	}  

	public function InsertDoctorCategory($DocotorId='')
	{
		$sel_doctor_category        = $this->input->post('sel_doctor_category');
		if($sel_doctor_category != '' && $sel_doctor_category != 0 && $DocotorId != '' && $DocotorId != 0)
		{
			$query = $this->db->query("
									INSERT iNTO tbl_doctor
									(
									    fk_user_id,
									    doctor_category_id
									)
									VALUES 
									(
									'$DocotorId',
									'$sel_doctor_category'
									)	
								");
		}

	}

	public function IsertDoctorDayPlan($DocotorId = '' ,$DayNo = '' )
	{
		$timedate = date('Y-m-d H:i:s');
		if($DocotorId != '' && $DocotorId != 0 && $DayNo != '' && $DayNo != 0)
		{
			$query = $this->db->query("
									INSERT iNTO tbl_doctor_day_plan
									(
									    fk_doctor_id,
									    availability_day_no,
									    doctor_day_plan_created_date,
									    doctor_day_plan_modified_date
									)
									VALUES 
									(
									'$DocotorId',
									'$DayNo',
									'$timedate',
									'$timedate'

									)	
								");
		}	
	}

	public function IsUserNameAlreadyExist()
	{
		$txt_user_name              = $this->input->post('txt_user_name');
	  	$query  = $this->db->query(" 	
										SELECT tu.user_id
										FROM tbl_users tu
										WHERE tu.user_uname = '$txt_user_name'
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function LoginUser()
	{
		$txt_usename              = $this->input->post('txt_usename');
		$txt_password              = $this->input->post('txt_password');

		$ecryptedPassword = md5($txt_password); // Apply encryption;
		
	  	$query  = $this->db->query(" 	
										SELECT *,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = tu.user_type
										) AS user_type_name
										FROM tbl_users tu
										WHERE tu.user_uname = '$txt_usename'
										AND tu.user_pass = '$ecryptedPassword'
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function GetuserInfo($user_id)
	{
		$txt_usename              = $this->input->post('txt_usename');
		
		if($txt_usename != 0 && $txt_usename != '')
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

	public function GetPatientInfo($user_id)
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
	  	
	}
  
}