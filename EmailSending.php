<?php 
$ToEmail = "";
$EmailSubject="";
$EmailBody = "";

$ToEmail = $_POST['ToEmail'];
$EmailSubject = $_POST['EmailSubject'];
$EmailBody = $_POST['EmailBody'];

require_once ('PHPMailerAutoload.php');
		$mail = new PHPMailer;
		$mail->SMTPDebug = 0; 
		$mail->isSMTP();                                     
		$mail->Host = 'smtp.gmail.com'; 
		$mail->SMTPAuth = true;                               
		$mail->Username = "dpmsalert@gmail.com";                
		$mail->Password = "03414104237";                           
		$mail->SMTPSecure = 'tls';                            
		$mail->Port = 587;    
		$mail->setFrom('dpmsalert@gmail.com', 'Doctor Patient Management System');
		$mail->addAddress($ToEmail); 
		$mail->Subject = $EmailSubject;
		$mail->Body    = $EmailBody;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if(!$mail->send())
		{
			echo '<script>alert("Error in Registration! Please Check your internet connection and try again").mysqli_error();window.location="doctor_signup.php"</script>';
			//echo 'Mailer failed' . $mail->ErrorInfo;	 
		}

		?>