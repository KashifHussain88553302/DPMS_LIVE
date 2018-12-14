<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class signup extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
       
    $this->load->helper("url");

    date_default_timezone_set('Asia/Karachi');
    
   }

  /**
    This Function will validate and insert the data of the user when he register.Also and notification will be sent to the user to varify the Email address he has provided
  **/
  public function index()
  {

    //$this->load->model('model_user');
    $this->load->model('model_user');
    $this->load->model('model_common');
      $data['error']="";
      $data['success']="";
      $txt_first_name             = $this->input->post('txt_first_name');
      $txt_last_name              = $this->input->post('txt_last_name');
      $txt_user_name              = $this->input->post('txt_user_name');
      $txt_password               = $this->input->post('txt_password');
      $txt_retype_password        = $this->input->post('txt_retype_password');
      $phoneNo                    = $this->input->post('phoneNo');
      $txt_cnic                   = $this->input->post('txt_cnic');

      $sel_city                  = $this->input->post('sel_city');
      $user_type                  = $this->input->post('user_type');
      $txt_email                  = $this->input->post('txt_email');
      $sel_doctor_category        = $this->input->post('sel_doctor_category');

      if(isset($_POST['hdn_btn_createUser'])=="")
      {
      }
      else
      {
        if($txt_first_name == "")
        {
          $data['error'] = "Invalid first name";
        }
        elseif($txt_last_name == "")
        {
          $data['error'] = "Invalid last name";
        }
        elseif($txt_user_name == "")
        {
          $data['error'] = "Invalid user name";
        }
        elseif($txt_user_name != "")
        {

          $user_id =  $this->IsUserNameAlreadyExist(); // Validate if the user email already exist.

          if($user_id == 0)
          {}
          else
          {
            $data['error'] = "This user name already exist. Try another one";
          }
        }
        
        if($txt_email == "" )
        {
          $data['error'] = "Invalid email";
        }
        elseif($phoneNo == "")
        {
          $data['error'] = "Invalid Phone no";
        }
        elseif($txt_cnic == "")
        {
          $data['error'] = "Invalid cnic";
        }
        elseif($sel_city == "" || $sel_city == 0)
        {
          $data['error'] = "Invalid city";
        }
        elseif($user_type == "" || $user_type == 0)
        {
          $data['error'] = "Invalid user type";
        }
        elseif($user_type == 1 && ($sel_doctor_category == 0 || $sel_doctor_category == '')) /* 1- doctor*/
        {
          $data['error'] = "Invalid doctor category";
        }
        elseif($txt_password == "")
        {
          $data['error'] = "Please provide password";
        }
        elseif($txt_retype_password == "")
        {
          $data['error'] = "Please provide Re-password";
        }
        elseif($txt_password != $txt_retype_password)
        {
          $data['error'] = "Password not match";
        }
        else{}
        if($data['error'] == "")
        {
          $LatestUserId = $this->model_user->AddNewuser(); //Call the model function to Add new user

          if($user_type == 1) // 1- Docotor
          {   
              $this->model_user->InsertDoctorCategory($DocotorId = $LatestUserId);
              // enter the defult Day plan entry for the doctors.
              for($i=1; $i<=7;$i++)
              {
                $this->model_user->IsertDoctorDayPlan($DocotorId = $LatestUserId ,$DayNo = $i  );
              }
          }
          $data['success'] == "You have succesfully signup";
          
          // Set flash data 
          $this->session->set_flashdata('success_signup', 'You have successfully signup !! Please varify your account bu clicking on link send in the email & login to continue.');

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
                        <th colspan='3' align='center'><b>User Info</b></th>
                      </tr>
                      <tr>
                        <td><b>User first name: </b>".$txt_first_name."</td>
                        <td><b>User Last Name: ".$txt_last_name."</b></td>
                        <td><b>User Email: ".$txt_email."</b></td>
                      </tr>
                      <tr>
                        <td><b>User Name: </b>".$txt_user_name."</td>
                        <td><b>Password: </b>".$txt_password."</td>
                        <td><b>Phone No: </b>".$phoneNo."</td>
                      </tr>
                    </table>
                  </body>
                </html>
                ";


          $SENDINGEMAILADDRESS = $txt_email;

          $SENDINGEMAILADDRESS = "kashifhussain0066@gmail.com";

           // init the resource
         $ch = curl_init();

        $postData = array(
            'ToEmail' => $SENDINGEMAILADDRESS,
            'EmailSubject' => 'DPMS Official Notification',
            'EmailBody' => 'Dear user! You have successfully signup for the DPMS<br>
            <br>To start a new journey please varify your account by click on the link below and then login
            <br><a href="'. base_url().'common/VarifyUserAccount/'.$LatestUserId.'"> click here to verify your account </a>
            <br>
            <br> 
            '.$message
        );


        $URL = base_url().'EmailSending.php'; // URL to send the curl call
        // Send to curl call to end the email.
          curl_setopt_array($ch, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_FOLLOWLOCATION => true
        ));

        $output = curl_exec($ch);
        //echo $output;
          
          
          header('Location:'. base_url().'');
        }
        else
        {

        }

      }
      $data['cities'] = $this->model_common->getCustomFieldValues($getCustomField=2); // 2 - cities
 
      $data['UserTypes'] = $this->model_common->getCustomFieldValues($getCustomField=1); // 1 - User type
      $data['DoctorCategories'] = $this->model_common->getCustomFieldValues($getCustomField=3); // 3 -  Doctor categories.
      

      $this->load->view('user/signup',$data);
  	
  }

  public function IsUserNameAlreadyExist($Isajaxcall='')
  {
    $this->load->model('model_user');
    $Isajaxcall               = $this->input->post('Isajaxcall');
    $user_id= 0;
    $user_infos = $this->model_user->IsUserNameAlreadyExist();
    foreach($user_infos as $user_info)
    {
      $user_id = $user_info['user_id'];
    }
    if($user_id != 0 && $user_id != '')
    {
      if($Isajaxcall == 1)
      {
        echo "Already Exist";
      }
      else
      {
        return $user_id;
      }
    }
    else
    {
      if($Isajaxcall == 1)
      {
        echo "Already Not Exist";
      }
      else
      {
        return 0;
      }
      
    }
  }
  
}