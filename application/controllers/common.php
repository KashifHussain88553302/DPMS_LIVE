<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class common extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('session');
       
    $this->load->helper("url");

    date_default_timezone_set('Asia/Karachi');
    global $objControllerCommon;

    $objControllerCommon =& get_instance();
      //$objControllerCommon = new common();
    
   }

  public function index()
  {

  	
  }

  public function IsUserNameAlreadyExist()
  {
    die('asdfasd');
  }
  
  public function ChangePassowrd()
  {
    $this->load->model('model_user');
      $old_Password = $this->input->post('old_Password');
       $new_Password = $this->input->post('new_Password');
       $confirm_Password = $this->input->post('confirm_Password');
       $hdn_user_id = $this->input->post('hdn_user_id');
       $user_id = "";
      /* echo '<br/>'.$old_Password;
       echo '<br/>'.$new_Password;
       echo '<br/>'.$confirm_Password;
       echo '<br/>'.$hdn_user_id;
  */
       $ecryptedOldPassword = md5($old_Password); // Apply encryption;
    
       $user_infos = $this->model_user->isValidOldPassword($hdn_user_id ,$ecryptedOldPassword); 
       foreach($user_infos as $user_info)
        {
          $user_id = $user_info['user_id'];
        }

        if($user_id != 0 && $user_id != '')
        {
            $ecryptedNewPassword = md5($new_Password); // Apply encryption;
            $this->model_user->updateUserPassword($hdn_user_id ,$ecryptedNewPassword);
            echo "success" ;
        }
        else
        {
          echo "Invalid Old Password";
        }

  }
}