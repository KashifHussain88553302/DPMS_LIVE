<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
       
    $this->load->helper("url");

    date_default_timezone_set('Asia/Karachi');
    global $objControllerCommon;

    $objControllerCommon =& get_instance();
      //$objControllerCommon = new common();
    /*if($this->session->userdata('admin_id') == '' || $this->session->userdata('admin_id') == 0){
      header('Location:'. base_url().'admin/login');
    }*/
   }

  public function index()
  {
     if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0)
     {
       header('Location:'. base_url().'admin/home');
      }
      else
      {
       header('Location:'. base_url().'admin/login');
      }
  }

  public function login()
  { 
      $this->load->model('model_admin');

    $data['error']="";
    $data['success']="";
    $txt_usename             = $this->input->post('txt_usename');
    $txt_password            = $this->input->post('txt_password');

    if($this->session->userdata('admin_id') != '' && $this->session->userdata('admin_id') != 0){
      header('Location:'. base_url().'admin/home');
    }

    if(isset($_REQUEST['btn_loginUser'])=="")
    {
    }
    else
    {
       if($txt_usename == "")
        {
          $data['error'] = "Invalid Admin Name";
        }
        elseif($txt_password == "")
        {
          $data['error'] = "Invalid Password";
        }
        else
        {
        }

        if($data['error'] == "")
        { 
          $user_id = 0;
          $user_infos = $this->model_admin->LoginUser(); //Call the model function to Add new user

          foreach($user_infos as $user_info)
          {
            $user_id = $user_info['admin_id'];
          }

          if($user_id != 0 && $user_id != '')
          {

            foreach($user_infos as $user_info)
            {

              $user_id = $user_info['admin_id'];
              $user_Type = 'Admin';
              $user_created_date = $user_info['admin_created_date'];
              $user_type_name = 'Admin';
              $Formated_user_created_date = date('M, Y', strtotime($user_created_date));


              $user_name = $user_info['admin_fname'] . ' '. $user_info['admin_lname'];
              
              $user_data = array(
              'admin_id' => $user_id,
              'user_type' => $user_Type,
              'user_is_active' => 1,
              'user_name' => $user_name,
              'user_type_name' => $user_type_name,
              'Formated_user_created_date' => $Formated_user_created_date,

              );
              $this->session->set_userdata($user_data);
            }


            $data['success'] = "You have succesfully signup";
            header('Location:'. base_url().'admin/home');
          }
          else
          {
            $data['error'] = "Invalid User Name or Password";
          }

        }
        else
        {

        }

    }

    $this->load->view('user/login', $data);
  }

  public function signout()
  {
    if(!$this->session->userdata('admin_id')){
       header('Location:'. base_url().'admin/login');
    }
    $this->session->unset_userdata('admin_id');
    $this->session->unset_userdata('user_type');
    $this->session->unset_userdata('user_is_active');
    $this->session->unset_userdata('user_name');
    
    $this->session->sess_destroy();

    header('Location:'. base_url().'admin/login');
  }

  public function home()
  {
    $this->load->helper('url'); // load helper fuction

      $data[] = "";

      if($this->session->userdata('admin_id') == '' || $this->session->userdata('admin_id') == 0){
        header('Location:'. base_url().'admin/login');
      }
      $this->load->model('model_common');
      $data["commonCounts"] = $this->model_common->getcommonInfoCounts();
      $data["commonAdminCounts"] = $this->model_common->getcommonadminCounts();
      

      $this->load->view('admin/home',$data);

  }


  public function ViewAppointment()
  {
    $data[] = "";
    //echo "controller Appointments";
    if($this->session->userdata('admin_id') == '' || $this->session->userdata('admin_id') == 0){
        header('Location:'. base_url().'admin/login');
      }
    $this->load->model('model_appointment');
    $this->load->model('model_common');

    $data['Memberpatients'] = $this->model_common->getAllPatient();
    $data['Memberdoctors'] = $this->model_common->getAllDoctors();
    
    $data['AppointmentStatus'] = $this->model_common->getCustomFieldValues($getCustomField=4); // 2 - Appointment status

    $data['Appointments'] = $this->model_appointment->GetAllAppointments();

    $this->load->view('Admin/ViewAppointment',$data);
  }

  public function viewAllPatients()
  {
    die("View all patinet");
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

    $data['Memberpatients'] = $this->model_common->getAllPatient();

    $data['Doctorscategories'] = $this->model_common->getCustomFieldValues($getCustomField=3); // 3 - Doctor category

    $data['cities'] = $this->model_common->getCustomFieldValues($getCustomField=2); // 2 - cities

    
    $this->load->view('Doctor/griddoctors',$data);
  }


  
}