<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


function sendThankYou($toMail, $prefix, $name) {
    header("Location: confirmation.html");

    $mail = new PHPMailer;
    $mail->IsSMTP();

    $mail->SMTPDebug = 3;
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Host = "smtp.gmail.com";
    $mail->Username = /* Your GMail Account*/
    $mail->Password = /* Youur Gmail Password */

    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false, /* delete this section of code before deployment */
                            'allow_self_signed' => true
                        )
                    );

    $mail->IsHTML(TRUE);
    $mail->AddAddress($toMail, $name);
    $mail->SetFrom("/*Your From Email*/", "/*Your Name*/");
    $mail->Subject = "Thank you for your payment!";
    $content = "Hello ".$prefix.". ".$name.",<br>Thank you for paying off your bill with us. We hope to hear from you again soon!";

    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
    } else {
    echo "Email sent successfully";
    
    }
}
?>
