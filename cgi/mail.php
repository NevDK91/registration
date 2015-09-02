<?php

function mailing($confirmCode, $recip){
// $to - кому отправляем
        $to = 'test@test.ru';
        $title = "Подтверждение аккаунта на ".$_SERVER['SERVER_NAME'];
        $from='admin@forms.earth';
        $to = $recip;
        $mess = "Подтвердите, пожалуйста, аккаунт, перейдя по ссылке: http://".$_SERVER['SERVER_NAME']."/cgi/confirmation.php?code=".$confirmCode;
        $mailed = mail($to, $title, $mess, "From:".$from); 
        if($mailed)
        	return true;
        else
        	return false;
}

 ?>