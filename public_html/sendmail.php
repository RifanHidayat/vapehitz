<?php
require_once("../share/_lib/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();  // telling the class to use SMTP
//$mail->Host     = "monas.indosite.com"; // SMTP server
$mail->Host     = "10.1.0.6"; // SMTP server
$mail->Port = 25; 	
/* $mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = "smtpa@indonesian-aerospace.com";                 // SMTP username
$mail->Password = "[YxuB[UXU9Qx";  
$mail->SMTPSecure = "tls";  // SMTP password
 */
//$emailBy= "irwans17@yahoo.com";
//$emailBy= "rusman@indonesian-aerospace.com";
$mail->ContentType        = 'text/html';

$mail->From     = "irwans17@yahoo.com";
$mail->FromName = "Irwan";	
$mail->Subject  = "Approval Lembur";	
$nama1="Ricky";
$nama2="Irwan";
$nama3="Puty";
$emailsentto2="irwans@indonesian-aerospace.com";	
$emailsentto1="ricky_l@indonesian-aerospace.com";	
$emailsentto3="puty.andini@indonesian-aerospace.com";	
//$emailsentto="rusman@indonesian-aerospace.com";
$mail->AddAddress($emailsentto1,$nama1);	
$mail->AddAddress($emailsentto2,$nama2);	
$mail->AddAddress($emailsentto3,$nama3);	
$body="<b>TEST EMAIL LOKAL</b>"; 
$body.="test test test : \r\n";
$body.="test test.\r\n";
$body.="Terima Kasih\r\n";
$mail->Body     = trim($body);
if(!$mail->Send()) {
$emailnya= 'Email tidak terkirim : ' . $mail->ErrorInfo;
}
?>