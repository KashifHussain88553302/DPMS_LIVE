<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class appointment extends CI_Controller 
{

  public function __construct() {
    parent::__construct();

    if(($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0) && $this->session->userdata('admin_id') == ''){
      header('Location:'. base_url());
    }
   }

  public function index()
  {

  }
  public function UpdateAppointmentStatus()
  {
  	$this->load->model('model_appointment');
  	$appointment_id              = $this->input->post('appointment_id');
    $appointment_status_id       = $this->input->post('appointment_status_id');
    $CancelAppointment           = $this->input->post('CancelAppointment');
   	 
  	$Temp_appointment_status_id = 0;
  	if($appointment_id != "" && $appointment_id != 0 && $appointment_status_id != '' && $appointment_status_id != 0)
  	{	
  		if($CancelAppointment == 1)
  		{
  			$Temp_appointment_status_id = 15; // 15 cancel;
  		}
  		elseif($appointment_status_id == 13 && $CancelAppointment != 1) // Requested
  		{
  			$Temp_appointment_status_id = 14; // 14 Approve;
  		}
  		$this->model_appointment->UpdateAppointmentStatus($appointment_id , $Temp_appointment_status_id);
  	}
  }

  public function ValidateAndBookAppointment()
  {
    $this->load->model('model_appointment');
    $Doctor_id               = $this->input->post('Doctor_id');
    $AppointmentDate         = $this->input->post('AppointmentDate');
    $AppointmentTime         = $this->input->post('AppointmentTime');
    $AppointmentDescription  = $this->input->post('AppointmentDescription');

    if($Doctor_id == "" || $Doctor_id == 0)
    {
      echo "Invalid Doctor selected";
    }
    else if ($AppointmentDate == "")
    {
      echo "Invalid Doctor selected";
    }
    else
    {
       $IsvalidAppointment = $this->model_appointment->validateAppointmentsTiming($isGetCount=1);

       if($IsvalidAppointment[0]['count'] > 0) 
      {
           $IsAppointment = $this->model_appointment->GetAppointments($isGetCount=1);
         
          if($IsAppointment[0]['count'] > 0)
          {
            echo "Appointment is already marked for this date and Time with this doctor";
          }
          else
          {
              $IsAppointment = $this->model_appointment->insertNewAppointments($Doctor_id, $AppointmentDate , $AppointmentTime , $AppointmentDescription);

               echo "Success";
          }
      }
      else
      {
        echo "Doctor is not Available at this date and Time";
      }


      
    }
   
    
  }

  public function AppointmentPrescription()
  {
    $data[] = "";
    $this->load->model('model_appointment');
    $this->load->model('model_user');
    $this->load->model('model_doctor');
    $Appointment_id = $this->uri->segment(3) ;
    $data['Appointment_id'] = $Appointment_id;
    if($Appointment_id == '' || $Appointment_id == 0){
      header('Location:'. base_url());
    }

    $Details = $this->model_appointment->GetDetail($Appointment_id);

    $Patient_id = '';
    $Doctor_id = '';
    foreach($Details as $Detail)
    {
      $Patient_id = $Detail['user_id'];
      $Doctor_id = $Detail['doctor_id'];
    }
    $data['Patient_Details']  = $this->model_user->GetPatientInfo($Patient_id);
    $data['Doctor_Details']  = $this->model_doctor->GetDoctorInfo($Doctor_id);



    if(isset($_REQUEST['btn_save_prescription'])=="")
    {
     // echo "Not submitted"; 
    }
    else
    {
      //echo "submitted";
      $complaints  = $this->input->post('complaints');
      $doctor_notes  = $this->input->post('doctor_notes');

      echo "Complaints: ".$complaints.'<br>';
      //echo "doctor_notes: ".$doctor_notes.'<br>';

      $hdnDisRow  = $this->input->post('hdnDisRow');
      //echo "hdnDisRow: ".$hdnDisRow.'<br>';

      for($i=1;$i<=$hdnDisRow ; $i++)
      {
        
        ${"disease_" . $i}  = $this->input->post('disease_'. $i);
        ${"diseases_note_" . $i}  = $this->input->post('diseases_note_'. $i);
       /* echo "disease_1: ".${"disease_" . $i}.'<br>';
        echo "diseases_note_1: ".${"diseases_note_" . $i}.'<br><br>';*/
        if(${"disease_" . $i} != '')
        {
          $this->model_appointment->AddAppointmentDiseases($Appointment_id , ${"disease_" . $i} , ${"diseases_note_" . $i});
        }
      }

      $hdnMdcrow = $this->input->post('hdnMdcrow');echo"hdn:". $hdnMdcrow;
     
      for($j=1;$j<=$hdnMdcrow ; $j++)
      {
        ${"medicine_" . $j} = $this->input->post('medicine_'. $j);
        ${"dose_" . $j}      = $this->input->post('dose_'. $j);
        ${"frequency_" . $j}   = $this->input->post('frequency_'. $j);
        ${"duration_" . $j}      = $this->input->post('duration_'. $j);
        ${"root_" . $j}  = $this->input->post('root_'. $j);
        ${"qty_" . $j}      = $this->input->post('qty_'. $j);

       /* echo "medicine_1: ".${"medicine_" . $j}.'<br>';
        echo "dose_1: ".${"dose_" . $j}  .'<br>';
        echo "frequency_1: ".${"frequency_" . $j}.'<br>';
        echo "duration_1: ". ${"duration_" . $j} .'<br>';
        echo "root_1: ".${"root_" . $j}.'<br>';
        echo "qty_1: ".${"qty_" . $j}.'<br><br>';*/

        if(${"medicine_" . $j} != '')
        {
          $this->model_appointment->AddAppointmentMedicines($Appointment_id ,${"medicine_" . $j} , ${"dose_" . $j} ,${"frequency_" . $j} , ${"duration_" . $j} ,${"root_" . $j} , ${"qty_" . $j} );
        }

      }

      $this->model_appointment->AddAppointmentPrescription($Appointment_id);
      $this->model_appointment->UpdateAppointmentStatus($Appointment_id , $Temp_appointment_status_id = 16); // update the appointment status .
     header('Location:'. base_url().'Appointment/AppointmentPrescription/'.$Appointment_id.'');
     // die();
      
    }
    //die();
     $this->load->view('Appointment/addAppointmentPrescription',$data);
  }

  public function AddAppointmentVitals()
  {
    $this->load->model('model_appointment');
    $this->model_appointment->AddAppointmentVitals();
  }

  public function AppointmentPrescriptionDetail()
  {
    $data[] = "";
    $this->load->model('model_appointment');
    $this->load->model('model_user');
    $this->load->model('model_doctor');
    $Appointment_id = $this->uri->segment(3) ;
    $data['Appointment_id'] = $Appointment_id;

    if($Appointment_id == '' || $Appointment_id == 0){
      header('Location:'. base_url().'Patients/ViewAppointment');
    }

    $Details = $this->model_appointment->GetDetail($Appointment_id);

    $Patient_id = '';
    $Doctor_id = '';
    foreach($Details as $Detail)
    {
      $Patient_id = $Detail['user_id'];
      $Doctor_id = $Detail['doctor_id'];
    }
    $data['Patient_Details']  = $this->model_user->GetPatientInfo($Patient_id);
    $data['Doctor_Details']  = $this->model_doctor->GetDoctorInfo($Doctor_id);

    //if the not a vaild request than redirect to the view Appointment dashoboard
    if($this->session->userdata('user_id') != $Patient_id &&  $this->session->userdata('user_id') != $Doctor_id && $this->session->userdata('admin_id') == '' )
    {
      header('Location:'. base_url().'Patients/ViewAppointment'); 
    }
    
    $data['Vitals'] = $this->model_appointment->GetAppointmentVitals($Appointment_id);
    $data['Diseases'] = $this->model_appointment->GetAppointmentDiseases($Appointment_id);
    $data['Prescriptions'] = $this->model_appointment->GetAppointmentprescription($Appointment_id);
    $data['Medicines'] = $this->model_appointment->GetAppointmentMedicines($Appointment_id);
    $this->load->view('Appointment/AppointmentPrescriptionDetail',$data);
  }
}