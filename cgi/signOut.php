<?php
session_start();

unset($_SESSION["signedUserId"]);
$_SESSION["success"] = "<p class=successMsg>Вы успешно вышли из своей учетной записи!</p>";
echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
/*echo "http://".$_SERVER['SERVER_NAME'];*/
 ?>