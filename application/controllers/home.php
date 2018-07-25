<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
     if($this->session->userdata('user_id') == '' || $this->session->userdata('user_id') == 0){
      header('Location:'. base_url());
    }
   }

  public function index()
  {
  	$this->load->helper('url'); // load helper fuction

      $this->load->model('model_common');

    if($this->session->userdata('user_id') != '' || $this->session->userdata('user_id') != 0){
      //echo "hello";
    }
    else
    {
    }

    $Tempis_firstTime = $this->model_common->is_firstTime();
    foreach($Tempis_firstTime as $Tempis_first)
    {
      $is_firstTime = $Tempis_first['user_is_first_time'];
    }
    
    if($is_firstTime == 1)
    {
       $this->model_common->updateis_firstTime();
    } 
    else
    {
      $is_firstTime = 0;
    }

    $data["is_firstTime"] = $is_firstTime;

    if($this->session->userdata('user_type') == 1) // 1 - Doctor
    {
      $data[] = "";

      $data["commonCounts"] = $this->model_common->getcommonInfoCounts();
      $data["commonDoctorCounts"] = $this->model_common->getcommonDoctorCounts();

      
      $this->load->view('Doctor/home',$data);
    }else
    {
      $data[] = "";

      $data["commonCounts"] = $this->model_common->getcommonInfoCounts();
      $data["commonPatientCounts"] = $this->model_common->getcommonpatientCounts();
      

      $this->load->view('user/home',$data);
    }
    
  	
    //redirect(base_url().'home/login');
  }
  public function login()
  { 
    $this->load->view('user/login');
  }
  public function Signup()
  { 
    $this->load->view('user/register');
  }

  public function GetuserInfo($user_id)
  {
    $this->load->model('model_user');
    $user_info =  $this->model_user->LoginUser();
    return $user_info; 
  }

 
}