<?php
require '../vendor/autoload.php';
use Mailgun\Mailgun;
$mgClient = new Mailgun('key-4cacb41e03508007a4d2990e16ab5dd4');

function mailing($confirmCode, $recip, $messages, $mgClient){

        $subject = $messages["title"][ $_SESSION["locale"] ].$_SERVER['SERVER_NAME'];
        $text = $messages["body"][ $_SESSION["locale"] ]."http://".$_SERVER['SERVER_NAME']."/cgi/confirmation.php?code=".$confirmCode;
        
        $domain = 'sandbox3dd7c349f5714e2ab9f49d8998b5f809.mailgun.org';

        $result = $mgClient->sendMessage($domain, array(
                'from' => 'Administrator <mailgun@sandbox3dd7c349f5714e2ab9f49d8998b5f809.mailgun.org>',
                'to'   =>  'Baz '.$recip,
                'subject' => $subject,
                'text' => $text


        ));

        //echo $result->http_response_code;

        return true;
}


 ?>