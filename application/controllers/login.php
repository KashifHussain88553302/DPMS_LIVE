<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
   }

  public function index()
  {

    $this->load->model('model_user');

    $data['error']="";
    $data['success']="";
    $txt_usename             = $this->input->post('txt_usename');
    $txt_password            = $this->input->post('txt_password');

    // if the user already login redirect to the home page.
    if($this->session->userdata('user_id') != '' && $this->session->userdata('user_id') != 0) 
    {
      header('Location:'. base_url().'/home');
    }

    // if the form is submitted
    if(isset($_REQUEST['btn_loginUser'])=="")
    {
    }
    else
    {   
       if($txt_usename == "")// if the user name is not provided then show error message.
        {
          $data['error'] = "Invalid User Name";
        }
        elseif($txt_password == "")// if the password is not provided then show error message
        {
          $data['error'] = "Invalid Password";
        }
        else
        {
        }

        if($data['error'] == "")
        { 
          $user_id = 0;
          $user_infos = $this->model_user->LoginUser(); // get the user info.

          foreach($user_infos as $user_info)
          {
            $user_id = $user_info['user_id'];
          }

          if($user_id != 0 && $user_id != '') // if the user succesfully login
          {

            foreach($user_infos as $user_info)
            {

              $user_id = $user_info['user_id'];
              $user_Type = $user_info['user_type'];
              $user_created_date = $user_info['user_created_date'];
              $user_type_name = $user_info['user_type_name'];
              $Formated_user_created_date = date('M, Y', strtotime($user_created_date));


              $user_name = $user_info['user_fname'] . ' '. $user_info['user_lname'];
              
              $user_data = array(
              'user_id' => $user_id,
              'user_type' => $user_Type,
              'user_is_active' => 1,
              'user_name' => $user_name,
              'user_type_name' => $user_type_name,
              'Formated_user_created_date' => $Formated_user_created_date,

              );
              $this->session->set_userdata($user_data);
            }

            $data['success'] = "You have succesfully signup";
            header('Location:'. base_url().'home');
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


  public function signout() // function to logout any user
  {
    if(!$this->session->userdata('user_id')){
       header('Location:'. base_url().'');
    }
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('user_type');
    $this->session->unset_userdata('user_is_active');
    $this->session->unset_userdata('user_name');
    
    $this->session->sess_destroy();

    header('Location:'. base_url().'');
  }

}