<?php 
date_default_timezone_set('Asia/Karachi');
class model_common extends CI_Model 
{
	public function __construct()	

	{
		  $this->load->database();
	}

	public function getAllDoctors()
	{
		$WhereCondition = "";
		if($this->session->userdata('user_type') == 1) // 1- Doctor
		{ 
			$WhereCondition .= "AND tu.user_id != '".$this->session->userdata('user_id')."'";
		}
		$query  = $this->db->query(" 	
										SELECT *
										FROM `tbl_users` tu 
										WHERE 1= 1 
										AND tu.user_type = 1
										AND tu.user_is_active = 1
										$WhereCondition
										ORDER BY user_fname , user_lname
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function getAllPatient()
	{
		$query  = $this->db->query(" 	
										SELECT *
										FROM `tbl_users` tu 
										WHERE 1= 1 
										AND tu.user_type = 2
										ORDER BY user_fname , user_lname
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function getCustomFieldValues($CustomFieldValue='')
	{
		$query  = $this->db->query(" 	
										SELECT * 
										FROM tbl_custom_field_values
										WHERE Custom_Field_ID = '$CustomFieldValue'
										ORDER BY Custom_Field_Value_Order
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function getcommonInfoCounts()
	{

		$query  = $this->db->query(" 	
										SELECT 
										(
										    SELECT count(*)
										    FROM tbl_users
										    WHERE user_type = 1
										) AS total_doctors,
										(
										    SELECT count(*)
										    FROM tbl_users
										    WHERE user_type = 2
										) AS total_patients,
										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE appointment_status_id = 16
										) As successfull_appointments,
										(
										    SELECT count(*)
										    FROM tbl_users
										) AS total_members
									");
		
		$result = $query->result_array();			
		return $result;

		
	}

	public function getcommonDoctorCounts()
	{
		$currentdate = date('Y-m-d');
		$sessionuser_id = $this->session->userdata('user_id');
		$query  = $this->db->query(" 	
										SELECT 

										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE doctor_id = '$sessionuser_id'
										    AND appointment_status_id = 13
										) As requested_appointments,
										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE doctor_id = '$sessionuser_id'
										    AND appointment_status_id = 14
										) As approved_appointments,
										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE doctor_id = '$sessionuser_id'
										    AND appointment_status_id = 16
										) As finished_appointments,
										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE doctor_id = '$sessionuser_id'
										    AND appointment_status_id = 14
										    AND appointment_date = '$currentdate'
										) As Today_appointments
									");
		
		$result = $query->result_array();			
		return $result;

		
	}

	public function getcommonpatientCounts()
	{
		$currentdate = date('Y-m-d');
		$sessionuser_id = $this->session->userdata('user_id');
		$query  = $this->db->query(" 	
										SELECT 

										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE user_id = '$sessionuser_id'
										    AND appointment_status_id = 13
										) As requested_appointments,
										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE user_id = '$sessionuser_id'
										    AND appointment_status_id = 14
										) As approved_appointments,
										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE user_id = '$sessionuser_id'
										    AND appointment_status_id = 16
										) As finished_appointments,
										(
										    SELECT count(*)
										    from tbl_user_doctor_appointment
										    WHERE user_id = '$sessionuser_id'
										    AND appointment_status_id = 14
										    AND appointment_date = '$currentdate'
										) As Today_appointments
									");
		
		$result = $query->result_array();			
		return $result;

		
	}



}