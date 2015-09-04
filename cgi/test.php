<?php

require_once "Mail.php";
 
$from = "Web Master <webmaster@example.com>";
$to = "nevdk@hotmail.com";
$subject = "Test email using PHP SMTP\r\n\r\n";
$body = "This is a test email message";
 
$host = "smtp.mailgun.org";
$username = "postmaster@sandbox3dd7c349f5714e2ab9f49d8998b5f809.mailgun.org";
$password = "568425a8079a926e57fd3f226bb547ee";
 
$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'auth' => true,
    'username' => $username,
    'password' => $password));
 
$mail = $smtp->send($to, $headers, $body);
 
if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
} else {
  echo("<p>Message successfully sent!</p>");
}


 ?>