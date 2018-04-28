<?php 
date_default_timezone_set('Asia/Karachi');
class model_appointment extends CI_Model 
{
	public function __construct()	
	{
		  $this->load->database();
	}

	public function GetPatientAppointments()
	{	
		$WhereCondition = "";
		$user_id = $this->session->userdata('user_id');

		$sel_status     = $this->input->post('sel_status');
		$sel_doctor     = $this->input->post('sel_doctor');

		$appointment_date_from     = $this->input->post('appointment_date_from');
		$appointment_date_to     = $this->input->post('appointment_date_to');

		$appointment_Time_start     = $this->input->post('appointment_Time_start');
		$appointment_Time_to     = $this->input->post('appointment_Time_to');

		if($sel_status != '' && $sel_status != 0)
		{
			$WhereCondition .= "AND UDA.appointment_status_id = '$sel_status'";
		} 

		if($sel_doctor != '' && $sel_doctor != 0)
		{
			$WhereCondition .= "AND UDA.doctor_id = '$sel_doctor'";
		}

		if(($appointment_date_from != "" && $appointment_date_to !="" && $appointment_date_from <= $appointment_date_to) )
		{	
			$Formated_appointment_date_from = date('Y-m-d', strtotime($appointment_date_from));
			$Formated_appointment_date_to = date('Y-m-d', strtotime($appointment_date_to));

			$WhereCondition .= "AND UDA.appointment_date BETWEEN '$Formated_appointment_date_from' AND '$Formated_appointment_date_to' ";
		}

		if(($appointment_Time_start != "" && $appointment_Time_to !="" && $appointment_Time_start < $appointment_Time_to) )
		{	
			$Formated_appointment_Time_start = date('h:i:s', strtotime($appointment_Time_start));
			$Formated_appointment_Time_to = date('h:i:s', strtotime($appointment_Time_to));

			$WhereCondition .= "AND UDA.appointment_time BETWEEN '$Formated_appointment_Time_start' AND '$Formated_appointment_Time_to' ";
		}
		$query  = $this->db->query(" 	
										SELECT *,
										(
											SELECT CONCAT(tu.user_fname, ' ', tu.user_lname)
											FROM tbl_users tu
											WHERE tu.user_id = UDA.doctor_id
										) As Appointment_doctor_name,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = UDA.appointment_status_id
										) AS appointment_status_name
										FROM 
										tbl_user_doctor_appointment UDA
										WHERE user_id = '$user_id'
										$WhereCondition
										ORDER BY appointment_date DESC, appointment_status_id  
									");
		
		$result = $query->result_array();			
		return $result;
	}


	public function GetDoctorAppointments()
	{	
		$WhereCondition = "";
		$user_id = $this->session->userdata('user_id');

		$sel_status     = $this->input->post('sel_status');
		$sel_patient     = $this->input->post('sel_patient');

		

		$appointment_date_from     = $this->input->post('appointment_date_from');
		$appointment_date_to     = $this->input->post('appointment_date_to');

		$appointment_Time_start     = $this->input->post('appointment_Time_start');
		$appointment_Time_to     = $this->input->post('appointment_Time_to');

		if($sel_status != '' && $sel_status != 0)
		{
			$WhereCondition .= "AND UDA.appointment_status_id = '$sel_status'";
		} 

		if($sel_patient != '' && $sel_patient != 0)
		{
			$WhereCondition .= "AND UDA.user_id = '$sel_patient'";
		} 

		if(($appointment_date_from != "" && $appointment_date_to !="" && $appointment_date_from <= $appointment_date_to) )
		{	
			$Formated_appointment_date_from = date('Y-m-d', strtotime($appointment_date_from));
			$Formated_appointment_date_to = date('Y-m-d', strtotime($appointment_date_to));

			$WhereCondition .= "AND UDA.appointment_date BETWEEN '$Formated_appointment_date_from' AND '$Formated_appointment_date_to' ";
		}

		if(($appointment_Time_start != "" && $appointment_Time_to !="" && $appointment_Time_start < $appointment_Time_to) )
		{	
			$Formated_appointment_Time_start = date('h:i:s', strtotime($appointment_Time_start));
			$Formated_appointment_Time_to = date('h:i:s', strtotime($appointment_Time_to));

			$WhereCondition .= "AND UDA.appointment_time BETWEEN '$Formated_appointment_Time_start' AND '$Formated_appointment_Time_to' ";
		}

		$query  = $this->db->query(" 	
										SELECT * ,
										(
											SELECT CONCAT(tu.user_fname, ' ', tu.user_lname)
											FROM tbl_users tu
											WHERE tu.user_id = UDA.doctor_id
										) As Appointment_doctor_name,
										(
											SELECT CONCAT(tu.user_fname, ' ', tu.user_lname)
											FROM tbl_users tu
											WHERE tu.user_id = UDA.user_id
										) As Appointment_patient_name,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = UDA.appointment_status_id
										) AS appointment_status_name
										FROM 
										tbl_user_doctor_appointment  UDA
										WHERE doctor_id = '$user_id'
										$WhereCondition
									");
		
		$result = $query->result_array();			
		return $result;
	}
	// functio to update the Appointment Status.
	public function UpdateAppointmentStatus($appointment_id , $appointment_status_id)
	{
		
		 $query  = $this->db->query(" 	
										UPDATE tbl_user_doctor_appointment
										SET 
										appointment_status_id = '$appointment_status_id'
										WHERE appointment_id = '$appointment_id'
									");
	}

	public function GetAppointments($isGetCount=0)
	{	
		$WhereCondition = "";

		
		$Doctor_id         		= $this->input->post('Doctor_id');
		$AppointmentDate         = $this->input->post('AppointmentDate');
	    $AppointmentTime         = $this->input->post('AppointmentTime');
	    $AppointmentDescription  = $this->input->post('AppointmentDescription');

		$SELECT = "";

		if($isGetCount == 1 )
		{
			$SELECT = "count(*) As count ";
		}
		else
		{
			$SELECT = " *,
										(
											SELECT CONCAT(tu.user_fname, ' ', tu.user_lname)
											FROM tbl_users tu
											WHERE tu.user_id = UDA.doctor_id
										) As Appointment_doctor_name,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = UDA.appointment_status_id
										) AS appointment_status_name";
		}

		$user_id = $this->session->userdata('user_id');

		if($Doctor_id != 0 && $Doctor_id != '' )
		{
			$WhereCondition .= "AND UDA.doctor_id = '$Doctor_id' ";
		}

		if($AppointmentDate != "")
		{	
			$Formated_AppointmentDates = date('Y-m-d', strtotime($AppointmentDate));

			$WhereCondition .= "AND UDA.appointment_date = '$Formated_AppointmentDates' ";
		}

		if($AppointmentTime != "" )
		{	
			$Formated_AppointmentTime = date('h:i:s', strtotime($AppointmentTime));

			$WhereCondition .= "AND UDA.appointment_time = '$Formated_AppointmentTime' ";
		}
		
		$query  = $this->db->query(" 	
										SELECT 
										$SELECT
										FROM 
										tbl_user_doctor_appointment UDA
										WHERE 1 = 1 
										$WhereCondition
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function insertNewAppointments($Doctor_id='', $AppointmentDate='' , $AppointmentTime='' , $AppointmentDescription='')
	{
		$user_id = $this->session->userdata('user_id');

		$Formated_AppointmentDates = date('Y-m-d', strtotime($AppointmentDate));

		$Formated_AppointmentTime = date('h:i:s', strtotime($AppointmentTime));

		$timedate = date('Y-m-d H:i:s');




		$query = $this->db->query("
									INSERT iNTO tbl_user_doctor_appointment
									(
									    doctor_id,
									    user_id,
									    appointment_date,
									    appointment_created_date,
									    appointment_status_id,
									    appointment_time,
									    appointment_description,
									    appointment_modified_date,
									    appointment_modified_user_id
									)
									VALUES 
									(
									'$Doctor_id',
									'$user_id',
									'$Formated_AppointmentDates',
									'$timedate',
									'13 '/*Requested*/,
									'$Formated_AppointmentTime',
									'$AppointmentDescription',
									'$timedate',
									'$user_id'
									)	
								");
	}

	public function AddAppointmentVitals()
	{
		$hdn_appointment  = $this->input->post('hdn_appointment');
		$temp_value  = $this->input->post('temp_value');
		$temp_point  = $this->input->post('temp_point');
		$pulse  = $this->input->post('pulse');
		$height  = $this->input->post('height');
		$weight  = $this->input->post('weight');

		$bmi  = $this->input->post('bmi');
		$left_eye_upper  = $this->input->post('left_eye_upper');
		$left_eye_lower  = $this->input->post('left_eye_lower');
		$right_eye_upper  = $this->input->post('right_eye_upper');
		$right_eye_lower  = $this->input->post('right_eye_lower');
		$color_vision  = $this->input->post('color_vision');
		$bp_standing_upper  = $this->input->post('bp_standing_upper');
		$bp_standing_lower  = $this->input->post('bp_standing_lower');
		$blood_sugar_value  = $this->input->post('blood_sugar_value');

		$user_id = $this->session->userdata('user_id');

		$timedate = date('Y-m-d H:i:s');

		if($hdn_appointment != 0 && $hdn_appointment != '')
		{

			//$this->checkVitalAlredyexist();

			$query = $this->db->query("
									INSERT iNTO tbl_appointment_vitals
									(
									    fk_appointment_id,
									    temperature_value,
									    temperature_point,
									    pulse,
									    height,
									    Weight,
									    bmi,
									    left_eye_up,
									    left_eye_lower,
									    right_eye_up,
									    right_eye_lower,
									     color_vision,
									     blood_pressure_upper,
									     blood_pressure_lower,
									     blood_sugar,
									     appointment_vital_created_date,
									    appointment_vital_creator_user_id
									)
									VALUES 
									(
									'$hdn_appointment',
									'$temp_value',
									'$temp_point',
									'$pulse',
									'$height ',
									'$weight',
									'$bmi',
									'$left_eye_upper',
									'$left_eye_lower',
									'$right_eye_upper',
									'$right_eye_lower',
									'$color_vision',
									'$bp_standing_upper',
									'$bp_standing_lower',

									'$blood_sugar_value',
									'$timedate',
									'$user_id'
									)	
								");
		
		}
	}


	public function checkVitalAlredyexist()
	{

	}


	public function AddAppointmentDiseases($Appointment_id , $disease_1 , $diseases_note_1)
	{

		$user_id = $this->session->userdata('user_id');

		$timedate = date('Y-m-d H:i:s');

		$query = $this->db->query("
									INSERT iNTO tbl_appointment_disease
									(
										fk_appointment_id,
									    appointment_disease_name,
									    appintment_disease_note,
									    appointment_disease_created_date,
									    appointment_disease_creator_user_id
									)
									VALUES 
									(
									'$Appointment_id',
									'$disease_1',
									'$user_id',
									'$timedate',
									'$user_id'
									)	
								");
	}

	public function AddAppointmentMedicines($Appointment_id ,$medicine_1 , $dose_1 ,$frequency_1 , $duration_1 ,$root_1 , $qty_1 )
	{
			$user_id = $this->session->userdata('user_id');

		$timedate = date('Y-m-d H:i:s');

		$query = $this->db->query("
									INSERT iNTO tbl_appointment_medicines
									(
									    fk_appointment_id,
									    appointment_medicine_name,
									    appointment_medicine_dose_unit,
									    appointment_medicine_frequency,
									    appointment_medicine_duration,
									    appointment_medicine_route,
									    appointment_medicine_quantity,
									    appointment_medicine_created_date,
									    appointment_medicine_creator_user_id
									)
									VALUES 
									(
									'$Appointment_id',
									'$medicine_1',
									'$dose_1',
									'$frequency_1',
									'$duration_1',
									'$root_1',
									'$qty_1',
									'$timedate',
									'$user_id'
									)	
								");
	}

	public function AddAppointmentPrescription($Appointment_id)
	{
		$complaints  = $this->input->post('complaints');
      	$doctor_notes  = $this->input->post('doctor_notes');

      		$user_id = $this->session->userdata('user_id');

		$timedate = date('Y-m-d H:i:s');

		$query = $this->db->query("
									INSERT iNTO tbl_appintment_prescription
									(
									    fk_appointment_id,
									    appintment_prescription_complaint,
									    appintment_prescription_doctor_notes,
									    appintment_prescription_diet_instruction_name,
									    appintment_prescription_diet_instruction_description,
									    appintment_prescription_created_date,
									    appintment_prescription_creator_user_id
									)
									VALUES 
									(
									'$Appointment_id',
									'$complaints',
									'$doctor_notes',
									'',
									'',
									'$timedate',
									'$user_id'
									)	
								");
	}

	public function GetDetail($Appointment_id)
	{
		$query  = $this->db->query(" 	
										SELECT *
										FROM tbl_user_doctor_appointment
										WHERE appointment_id = '$Appointment_id'
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function GetAppointmentVitals($Appointment_id )
	{
		$query  = $this->db->query(" 	
										SELECT *
										FROM tbl_appointment_vitals
										WHERE fk_appointment_id = '$Appointment_id'
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function GetAppointmentDiseases($Appointment_id )
	{
		$query  = $this->db->query(" 	
										SELECT *
										FROM tbl_appointment_disease
										WHERE fk_appointment_id = '$Appointment_id'
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function GetAppointmentMedicines($Appointment_id )
	{
		$query  = $this->db->query(" 	
										SELECT *
										FROM tbl_appointment_medicines
										WHERE fk_appointment_id = '$Appointment_id'
									");
		
		$result = $query->result_array();			
		return $result;
	}

	public function GetAppointmentprescription($Appointment_id )
	{
		$query  = $this->db->query(" 	
										SELECT *
										FROM tbl_appintment_prescription
										WHERE fk_appointment_id = '$Appointment_id'
									");
		
		$result = $query->result_array();			
		return $result;
	}


	public function getDoctorDayPlanDetailInfo($Doctor_id , $datepicker)
	{
		$Formateddatepicker  = date('Y-m-d', strtotime($datepicker));
		$query  = $this->db->query(" 	
										SELECT 
										 *,
										(
											SELECT CONCAT(tu.user_fname, ' ', tu.user_lname)
											FROM tbl_users tu
											WHERE tu.user_id = UDA.doctor_id
										) As Appointment_doctor_name,
										(
											SELECT tcfv.Custom_Field_value_name
											FROM tbl_custom_field_values tcfv
											WHERE tcfv.Custom_Field_Value_ID = UDA.appointment_status_id
										) AS appointment_status_name
										FROM 
										tbl_user_doctor_appointment UDA
										WHERE 1 = 1 
										AND UDA.doctor_id = '$Doctor_id' 
										AND UDA.appointment_date = '$Formateddatepicker'
									");
		
		$result = $query->result_array();			
		return $result;
	}


	public function validateAppointmentsTiming($isGetCount=0)
	{	
		$WhereCondition = "";

		
		$Doctor_id         		= $this->input->post('Doctor_id');
		$AppointmentDate         = $this->input->post('AppointmentDate');
	    $AppointmentTime         = $this->input->post('AppointmentTime');
	    $AppointmentDescription  = $this->input->post('AppointmentDescription');


		$dayofweek = date('w', strtotime($AppointmentDate));

		$Formated_AppointmentTime = date('H:i:s', strtotime($AppointmentTime));
		
	
		$query  = $this->db->query(" 	
										SELECT 
										count(*) As count
										FROM 
										tbl_doctor_day_plan DDP
										WHERE 1 = 1 
										AND DDP.fk_doctor_id = '$Doctor_id' 
										AND DDP.availability_day_no = '$dayofweek' 
										AND '$Formated_AppointmentTime'  BETWEEN DDP.availability_time_start AND DDP.availability_time_end 
										AND DDP.Is_active = 1
									");
		
		$result = $query->result_array();			
		return $result;
	}


	

}