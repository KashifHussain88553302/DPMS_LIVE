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
  
}