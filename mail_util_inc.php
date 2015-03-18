<?php

function send_mail($email, $recipient_name, $message='')
{
	// here we use the php mail function
	// to send an email to:
	// you@yourdomain.com
	//mail( "bradm@inmotiontesting.com", "Feedback Form Results",$message, "From: $email" );
	require("phpmailer/class.phpmailer.php");

	$mail = new PHPMailer();
	
	$mail->CharSet="utf-8";
	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->Host = "mail.ripeconcepts.com";  // specify main and backup server
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = "daisy.sia@ripeconcepts.com";  // SMTP username
	$mail->Password = "ripe1234"; // SMTP password
	
	$mail->From = "daisy@walalang.com";
	$mail->FromName = "daisy_trial_and_error";
	$mail->AddAddress($email, $recipient_name);
	$mail->addCC("daisy_jane_ph5@gmail.com");
	//$mail->AddAddress("ellen@example.com");                  // name is optional
	//$mail->AddReplyTo("info@example.com", "Information");
	
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
	//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
	$mail->IsHTML(true);                                  // set email format to HTML (true) or plain text (false)
	
	$mail->Subject = "This is a Sample Email";
	$mail->Body    = $message;
	$mail->AltBody = "This is the body in plain text for non-HTML mail clients";	
	$mail->AddEmbeddedImage('images/lit_logo.png', 'lit_logo', 'lit_logo.png');
	$mail->addAttachment('files/LWIT Walk-Through.xlsx');
	
	if(!$mail->Send())
	{
	   echo "Message could not be sent. <p>";
	   echo "Mailer Error: " . $mail->ErrorInfo;
	   exit;
	}
	
	echo "Message has been sent";
}
?>