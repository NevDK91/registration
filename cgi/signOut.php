<?php
session_start();
include_once "messages.php";
include_once "functions.php";

$locale = _getLocale();

unset($_SESSION["signedUserId"]);
$_SESSION["success"] = "<p class=successMsg>".$messages["signOut"]["successSignOut"][$locale]."</p>";
echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
/*echo "http://".$_SERVER['SERVER_NAME'];*/
 ?>