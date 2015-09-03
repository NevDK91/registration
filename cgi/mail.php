<?php

function mailing($confirmCode, $recip, $messages){
// $to - кому отправляем
        $to = 'test@test.ru';
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

 ?>