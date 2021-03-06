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
  /**

  **/
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
      
      if($Temp_appointment_status_id == 14 ) // !4 Approved
      {
        $this->SendApprovedAppointmentNotification($appointment_id);
      }
  	}
  }

  // Function to send the notification to the user.
  public function SendApprovedAppointmentNotification($Appointment_id)
  {
    $this->load->model('model_appointment');
    $this->load->model('model_doctor');
    $this->load->model('model_user');
    if($Appointment_id != 0 && $Appointment_id != '')
    {

       $Details = $this->model_appointment->GetDetail($Appointment_id);

    $Patient_id = '';
    $Doctor_id = '';

    $PatientName = "";
    $AppointmentID = "";
    $Patient_Email = "";
    $patient_Cnic = "";
    $Patient_phone_no = "";

    $Doctor_name = "";
    $Doctor_Discription = "";
    $DoctorCategory = "";
    $DoctorEmail = "";
    $Doctor_location = "";
    $Doctor_city="";

    $AppointmentDate = "";
    $AppointmentTime="";

    $SENDINGEMAILADDRESS = "";
    foreach($Details as $Detail)
    {
      $Patient_id = $Detail['user_id'];
      $Doctor_id = $Detail['doctor_id'];
      $AppointmentDate = $Detail['appointment_date'];
      $AppointmentTime= $Detail['appointment_time'];
    }

    $Formated_appointment_date = date('D d M, Y ', strtotime($AppointmentDate));

    $Formated_appointment_Time = date('H:i A', strtotime($AppointmentTime));


    $Patient_Details  = $this->model_user->GetPatientInfo($Patient_id);
    $Doctor_Details  = $this->model_doctor->GetDoctorInfo($Doctor_id);

    foreach($Patient_Details as $Patient_Detail)
    {
      $PatientName    =  $Patient_Detail['user_fname'].' '.$Patient_Detail['user_lname'];
      $AppointmentID  = $Appointment_id;
      $Patient_Email  = $Patient_Detail['user_email'];
      $patient_Cnic   = $Patient_Detail['user_cnic'];
      $Patient_phone_no = $Patient_Detail['user_ph_no'];

    }

    foreach($Doctor_Details as $Doctor_Detail)
    {
      $Doctor_name        = $Doctor_Detail['user_fname'].' '.$Doctor_Detail['user_lname']; 
      $Doctor_Discription = $Doctor_Detail['doctor_description'];
      $DoctorCategory     = $Doctor_Detail['user_category_name'];
      $DoctorEmail        = $Doctor_Detail['user_email'];
      $Doctor_location    = $Doctor_Detail['user_location'];
       $Doctor_city    = $Doctor_Detail['user_city_name'];

    }

    $SENDINGEMAILADDRESS = $Patient_Email;
    $SENDINGEMAILADDRESS ="kashifhussain0066@gmail.com";
      $message = "
                <html>
                  <head>
                    <title>HTML email</title>
                  </head>
                  <body>
                    <table border='1'>
                      <tr>
                        <th colspan='3' align='center'><b>DPMS</b></th>
                      </tr>
                      <tr>
                        <th colspan='3' align='center'><b>Appointment Info</b></th>
                      </tr>
                      <tr>
                        <td><b>Appointment ID: </b>".$AppointmentID."</td>
                        <td><b>Appointment Date: ".$Formated_appointment_date."</b></td>
                        <td><b>Appointment Time: ".$Formated_appointment_Time."</b></td>
                      </tr>
                      <tr>
                        <td><b>Doctor Name: </b>".$Doctor_name."</td>
                        <td><b>City: </b>".$Doctor_city."</td>
                        <td><b>Category: </b>".$DoctorCategory."</td>
                      </tr>
                      <tr>
                        <td><b>Email: </b>".$DoctorEmail."</td>
                        <td colspan='2'><b>Location: </b>".$Doctor_location."</td>
                      </tr>
                      <tr>
                        <th colspan='3' align='center'><b>Patient Info</></th>
                      </tr>
                      <tr>
                        <td><b>Patient Name: </b>".$PatientName."</td>
                        <td><b>Email: </b>".$Patient_Email."</td>
                        <td><b>CNIC: </b>".$patient_Cnic."</td>
                      </tr>
                    </table>
                  </body>
                </html>
                ";
      // init the resource
      $ch = curl_init();

      $postData = array(
          'ToEmail' => $SENDINGEMAILADDRESS,
          'EmailSubject' => 'DPMS Official Notification',
          'EmailBody' => 'Dear Patient! You Appointment has been approved by respective Doctor<br>
          <br>Please visit the doctor according to the approved Timming.
          <br> If you have any queries feel free to contact us.
          <br>
          <br> 
          '.$message
      );


      $URL = base_url().'EmailSending.php'; // URL to send the curl call

        curl_setopt_array($ch, array(
          CURLOPT_URL => $URL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => $postData,
          CURLOPT_FOLLOWLOCATION => true
      ));

      $output = curl_exec($ch);
      //echo $output;
    }

    
    }

  /**
    this Function will validate the Appointment Date and Time that the Doctor doesnot have any
    appointment book against the date and time. If the Doctor has already booked an appointment
    then show error message otherwise Book appointment against the date  and time.
  **/
  public function ValidateAndBookAppointment()
  {
    $this->load->model('model_appointment');
    $Doctor_id               = $this->input->post('Doctor_id');
    $AppointmentDate         = $this->input->post('AppointmentDate');
    $AppointmentTime         = $this->input->post('AppointmentTime');
    $AppointmentDescription  = $this->input->post('AppointmentDescription');

    if($Doctor_id == "" || $Doctor_id == 0) // if invlalid Doctoer
    {
      echo "Invalid Doctor selected";
    }
    else if ($AppointmentDate == "") // if Appointment Date is invalid.
    {
      echo "Invalid Date selected";
    }
    else
    {
      $IsvalidAppointment = $this->model_appointment->validateAppointmentsTiming($isGetCount=1);// Validate the appointment.

      if($IsvalidAppointment[0]['count'] > 0) 
      {
          $IsAppointment = $this->model_appointment->GetAppointments($isGetCount=1); // Check for Doctor Already book appointment.
         
          if($IsAppointment[0]['count'] > 0)// if Doctor already have appointment then show error message.
          {
            echo "Appointment is already marked for this date and Time with this doctor";
          }
          else
          {

           $IsPatientAppointment = $this->model_appointment->validatePatientAppointment(); // Check for patient already book appointment.
            
            if($IsPatientAppointment[0]['count'] > 0) // if patient already book and Appointment then show error message.
            {

              echo "You have already marked for this date and time please another time.";
            }
            else // If there is no appointment book against the doctor or the patient.
            {
              $LastAppointmentId = $this->model_appointment->insertNewAppointments($Doctor_id, $AppointmentDate , $AppointmentTime , $AppointmentDescription); // Book the Appointment Agaist the  doctor

              $this->model_appointment->AddAppointmentVitalsNew($LastAppointmentId);
              $this->model_appointment->AddAppointmentPrescriptionNew($LastAppointmentId);
              echo "Success";
            }
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
      $txt_diet_instruction  = $this->input->post('txt_diet_instruction');

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

      $this->model_appointment->UpdateAppointmentPrescription($Appointment_id);
      $this->model_appointment->UpdateAppointmentStatus($Appointment_id , $Temp_appointment_status_id = 16); // update the appointment status .
     header('Location:'. base_url().'Appointment/AppointmentPrescriptionDetail/'.$Appointment_id.'');
     // die();
      
    }

    $data['Vitals'] = $this->model_appointment->GetAppointmentVitals($Appointment_id);
    $data['Prescriptions'] = $this->model_appointment->GetAppointmentprescription($Appointment_id);    
    //die();
     $this->load->view('Appointment/addAppointmentPrescription',$data);
  }

  public function AddAppointmentVitals()
  {
    $this->load->model('model_appointment');
    $this->model_appointment->AddAppointmentVitals();
  }

  public function UpdateAppointmentVitals()
  {
    $this->load->model('model_appointment');
    $this->model_appointment->UpdateAppointmentVitals();
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