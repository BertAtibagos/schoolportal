<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if(isset($_POST['send']))
{     
            $name=$_POST['name'];
            $email=$_POST['email'];
            $msg=$_POST['message'];
            $subject=$_POST['subject'];
    
            $mail = new PHPMailer(true); 

    		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'mail.fcpc-inc.com ';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'reset.password@fcpc-inc.com';                     //SMTP username
			$mail->Password   = 'yP2CLCW_i=ET';                               //SMTP password
			$mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`  
        
        	$mail->IsSendmail();  
        
        	$mail->From       = "reset.password@fcpc-inc.com";
        	$mail->FromName   = "FCPC School Portal";
        
        	$mail->AddAddress($email);
            $mail->Subject  = $subject;
        	$mail->WordWrap   = 80; 
        
            $mail->MsgHTML($msg);
        	$mail->IsHTML(true); 
                 
            if(!$mail->Send())
            {
                   echo "Mail Not Sent";
            }
            else
            {
               	echo '<script language="javascript">';
    	        echo 'alert("Thank You Contacting Us We Will Response You As Early Possible")';
    	        echo '</script>';
         
            } 
        	
}        	    
        