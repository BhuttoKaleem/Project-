<?php 

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();



//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'dumpmail.650@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'Dummy650@@';




//Set who the message is to be sent from
$mail->setFrom('dumpmail.650@gmail.com');
//Set an alternative reply-to address
$mail->addReplyTo('dumpmail.650@gmail.com');
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'disapprove'){
require('../database/database_library.php');
$dobj = new database_library();
$result =  $dobj->disapprove($_REQUEST['user_id'],$updated_at);
if ($result){
    header("location:approve_users.php?class=success&msg= Disappoved ");
}
// $query = "UPDATE users SET is_approve = 'Rejected' WHERE user_id = '".$_REQUEST['user_id']."' ";
// $result = mysqli_query($connection,$query);
//cc
$mail->addCC('');
//bcc
$mail->addBCC('');
//Set who the message is to be sent to
$mail->addAddress($_REQUEST['user_email']);
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
//Read an HTML message body
$message = wordwrap('Your account has been de-activated because of any suspicious activity',70);
$mail->msgHTML($message);
//Attach an image file (optional)
// $mail->addAttachment('images/img.jpg');
//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    header("location:approve_users.php?class=danger?msg=Failed to send mail invalid email address");
} else{
    header("location:approve_users.php?class=success&msg=Disapproved and mail sent at user ID".$_REQUEST['user_id']);
}

}
 ?>