<?php

/*	ВЫХОД ИЗ УЧЕТНОЙ ЗАПИСИ	*/

session_start();
include_once "messages.php";
include_once "functions.php";

$locale = _getLocale();

unset($_SESSION["signedUserId"]); // удаление переменной с id пользователя. Выход пользователя из учетной записи

$_SESSION["success"] = "<p class=successMsg>".$messages["signOut"]["successSignOut"][$locale]."</p>";

echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );

 ?>