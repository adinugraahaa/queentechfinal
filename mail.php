<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

function sendEmail($address, $code){

$mail = new PHPMailer(true);

//Enable SMTP debugging.
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "adinugraha9393@gmail.com";                 
$mail->Password = "eubhkpltrcytgvon";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to
$mail->Port = 587;                                   

$mail->From = "adinugraha9393@gmail.com";
$mail->FromName = "QueenTech";

// $mail->addAddress("ucihaadi7573@yahoo.com", "Adi Nugraha");
$mail->addAddress($address);

$mail->isHTML(true);

$mail->Subject = "OTP";
$mail->Body = "<i>Your OTP: " . $code . "</i>";
$mail->AltBody = "OTP Verification";

try {
    $mail->send();
    // echo "Message has been sent successfully";
} catch (Exception $e) {
    // echo "Mailer Error: " . $mail->ErrorInfo;
}

}
 ?>