<?php 
date_default_timezone_set('Asia/Karachi');
class model_admin extends CI_Model {

	

	public function __construct()	

	{
		  $this->load->database();
	}

	public function LoginUser()
	{
		$txt_usename              = $this->input->post('txt_usename');
		$txt_password             = $this->input->post('txt_password');

		$ecryptedPassword = md5($txt_password); // Apply encryption;
		
	  	$query  = $this->db->query(" 	
	  									SELECT *
										FROM tbl_admin  ta
										WHERE ta.admin_uname = '$txt_usename'
										AND ta.admin_pass = '$ecryptedPassword'
									");
		
		$result = $query->result_array();			
		return $result;
	}

  
}