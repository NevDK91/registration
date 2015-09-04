<?php

function mailing($confirmCode, $recip, $messages){

        $title = $messages["title"][ $_SESSION["locale"] ].$_SERVER['SERVER_NAME'];
        $from='admin@forms.earth';
        $to = $recip;
        $mess = $messages["body"][ $_SESSION["locale"] ]."http://".$_SERVER['SERVER_NAME']."/cgi/confirmation.php?code=".$confirmCode;
        $mailed = mail($to, $title, $mess, "From:".$from); 
        if($mailed)
        	return true;
        else
        	return false;
}

/*require_once "Mail.php";
 
$from = "Web Master <webmaster@example.com>";
$to = "Nobody <nobody@example.com>";
$subject = "Test email using PHP SMTP\r\n\r\n";
$body = "This is a test email message";
 
$host = "mail.emailsrvr.com";
$username = "webmaster@example.com";
$password = "yourPassword";
 
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
*/

 ?>