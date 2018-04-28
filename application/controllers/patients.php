<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class patients extends CI_Controller 
{

  public function __construct() {
    parent::__construct();

    if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
      header('Location:'. base_url());
    }
    
   }

  public function index()
  {

  }

	public function ViewProfile()
	{
    $data[] = "";
    $this->load->model('model_common');
    $this->load->model('model_patient');
    $this->load->model('model_doctor');
    $user_id = $this->session->userdata('user_id');
    $data['cities'] = $this->model_common->getCustomFieldValues($getCustomField=2); // 2 - cities

    if(isset($_POST['hdn_submit_button'])=="")
    {
      //die("hello");
    }
    else
    {
      //die("yello");
      $First_name = $this->input->post('first_name');
       $Last_name = $this->input->post('last_name');
       $Email = $this->input->post('email');
       $phoneNo = $this->input->post('phoneNo');
       //$country = $this->input->post('txt_ph_no');;
       $city =$this->input->post('sel_city');// echo $city;die("dafdda"); 
       $location =$this->input->post('location');
       $cnic = $this->input->post('cnic'); 

       $this->model_patient->updateUserProfile();
    }
    
    if($this->session->userdata('user_type') == 1) // 1- Doctor
    {
      $data['doctorDayPlan'] = $this->model_doctor->GetDoctorDayPlan($Doctor_id=$user_id);

    }
    
    $data['PatientInfo'] = $this->model_patient->GetpatientInfo($user_id);
//print_r($data);

		$this->load->view('user/ViewProfile',$data);
	} 


  public function ViewAppointment()
  {
    $data[] = "";
    //echo "controller Appointments";

    $this->load->model('model_appointment');
    $this->load->model('model_common');

    $data['Memberdoctors'] = $this->model_common->getAllDoctors();


    $data['AppointmentStatus'] = $this->model_common->getCustomFieldValues($getCustomField=4); // 2 - Appointment status

   

    $data['Appointments'] = $this->model_appointment->GetPatientAppointments();

    $this->load->view('user/ViewAppointment',$data);
  }
}