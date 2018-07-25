<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class doctor extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
     if(($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0) && $this->session->userdata('admin_id') == ''){
      header('Location:'. base_url());
    }
   }

  public function index()
  {

  }


  public function griddoctor()
  {
    $data[] = "";
    $this->load->model('model_doctor');
    $this->load->model('model_common');
    
    /**

    **/
    if(!isset($_POST['btn_search'] ))
    {
      $_POST['sel_isactive'] = 1;
    }

    $data['doctors'] = $this->model_doctor->GetListDoctors();

    $data['Memberdoctors'] = $this->model_common->getAllDoctors();

    $data['Doctorscategories'] = $this->model_common->getCustomFieldValues($getCustomField=3); // 3 - Doctor category

    $data['cities'] = $this->model_common->getCustomFieldValues($getCustomField=2); // 2 - cities

    
    $this->load->view('Doctor/griddoctors',$data);
  }

  public function DoctorDetail()
  {
    //echo "Docotor Detail";
     $data[] = "";
     $this->load->model('model_doctor');
     $Doctor_id = $this->uri->segment(3) ;

     if($Doctor_id == '' || $Doctor_id == 0){
      header('Location:'. base_url());
    }
    
    $data['Doctor_id'] = $Doctor_id;
    $data['doctorDayPlan'] = $this->model_doctor->GetDoctorDayPlan($Doctor_id);
    $data['DoctorInfo'] = $this->model_doctor->GetDoctorInfo($Doctor_id);
    
    $this->load->view('Doctor/DoctorDetail',$data);
  }
  
  public function ViewAppointment()
  {
    $data[] = "";
    //echo "controller Appointments";

    $this->load->model('model_appointment');
    $this->load->model('model_common');

    $data['Memberpatients'] = $this->model_common->getAllPatient();
    $data['Memberdoctors'] = $this->model_common->getAllDoctors();
    


    $data['AppointmentStatus'] = $this->model_common->getCustomFieldValues($getCustomField=4); // 2 - Appointment status

   

    $data['Appointments'] = $this->model_appointment->GetDoctorAppointments();

    $this->load->view('Doctor/ViewAppointment',$data);
  }

  public function UpdateDoctorDayPlan()
  {
    $this->load->model('model_doctor');
    $doctor_day_plan_id   = $this->input->post('doctor_day_plan_id');
    $day_status           = $this->input->post('day_status');
    $DoctorDayStartTime   = $this->input->post('DoctorDayStartTime');
    $DoctorDayEndTime  = $this->input->post('DoctorDayEndTime');
    $Temp_day_status = "";
    

    if($doctor_day_plan_id !='' && $doctor_day_plan_id != 0)
    {
        if($day_status == 1 )
        {
          $Temp_day_status = 1;

        }
        else
        {
          $Temp_day_status = 0;
        }

        $this->model_doctor->UpdateDoctorDayPlan($doctor_day_plan_id , $Temp_day_status , $DoctorDayStartTime ,$DoctorDayEndTime );
    }

  }

  public function ViewDoctorProfile()
  {
    $data[] = "";
    $this->load->model('model_common');
    $this->load->model('model_patient');
    $this->load->model('model_doctor');
    $user_id = $this->session->userdata('user_id');
    $data['cities'] = $this->model_common->getCustomFieldValues($getCustomField=2); // 2 - cities
   $data['Doctorscategories'] = $this->model_common->getCustomFieldValues($getCustomField=3); // 3 - Doctor category

    if(isset($_POST['hdn_submit_button'])=="")
    {
      //die("hello");
    }
    else
    {
      $First_name = $this->input->post('first_name');
       $Last_name = $this->input->post('last_name');
       $Email = $this->input->post('email');
       $phoneNo = $this->input->post('phoneNo');
       //$country = $this->input->post('txt_ph_no');;
       $city =$this->input->post('sel_city');// echo $city;die("dafdda"); 
       $location =$this->input->post('location');
       $cnic = $this->input->post('cnic'); 

       $this->model_doctor->updatedoctorProfile();
    }
    
    if($this->session->userdata('user_type') == 1) // 1- Doctor
    {
      $data['doctorDayPlan'] = $this->model_doctor->GetDoctorDayPlan($Doctor_id=$user_id);

    }
    
    $data['DoctorInfo'] = $this->model_doctor->GetDoctorInfo($user_id);
//print_r($data);

    $this->load->view('doctor/viewDoctorProfile',$data);
  } 

  public function getDoctorDayPlanDetailInfo()
  {
    $this->load->model('model_appointment');
    $datepicker = $this->input->post('datepicker');
    $Doctor_id = $this->input->post('Doctor_id');

    $AppointmentDeetails = $this->model_appointment->getDoctorDayPlanDetailInfo($Doctor_id , $datepicker);
    if(count($AppointmentDeetails) == 0 )
    {
      echo "Doctor has no appointment booked this day.";
    }
    else
    {
      ?>
      <table class="table table-striped">
                                <tbody>
                                Doctor Day Detail
                                <tr>
                                  <th style="width: 10px">#</th>
                                  <th>Date</th>
                                  <th>Time</th>
                                  <th style="width: 40px">status</th>
                                </tr>
                                <?php 
                                $i=0;
                              foreach($AppointmentDeetails as $AppointmentDeetail)
                              {   
                                $i++;
                              ?>
                                <tr>
                                  <td><?=$i?></td>
                                  <td><?=$AppointmentDeetail['appointment_date']?></td>
                                  <td>
                                    <?=$AppointmentDeetail['appointment_time']?>
                                  </td>
                                  <td><?=$AppointmentDeetail['appointment_status_name']?></td>
                                </tr>
                                <?php
                                } 
                                ?>
                               
                              </tbody>
                              </table>
      <?php 

    }
    //echo $datepicker."<br>";
    //echo $Doctor_id."<br>";
  }
  public function Patient_guideline()
  {
    $data[] = "";
      $this->load->view('Doctor/user_guideline',$data);
  }
  

}