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

    if($this->session->userdata('user_id') != '' || $this->session->userdata('user_id') != 0){
      //echo "hello";
    }
    else
    {
    }

    if($this->session->userdata('user_type') == 1) // 1 - Doctor
    {
      $data[] = "";

      $this->load->model('model_common');
      $data["commonCounts"] = $this->model_common->getcommonInfoCounts();
      $data["commonDoctorCounts"] = $this->model_common->getcommonDoctorCounts();
      
      $this->load->view('Doctor/home',$data);
    }else
    {
      $data[] = "";

      $this->load->model('model_common');
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