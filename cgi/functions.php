<?php

function getProfile($id){
	if( ( isset($_SESSION["signedUserId"]) ) && ( !empty($_SESSION["signedUserId"]) ) ) {

	$mysqli = mysqli_connect( 'localhost','root','','forms');     /* (server, user, password, databaseName) База данных для запросов по умолчанию */

	if (!$mysqli) { 
	   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
	   exit; 
	};

	$mysqli->query( "SET CHARSET 'utf8'" );

	$sql = "select * from users where id=$id ";

	$res = $mysqli->query($sql);

	$profile = [];

	while($row = $res->fetch_assoc()) {
		$profile["firstName"] = $row["firstName"];
		$profile["lastName"] = $row["lastName"];
		$profile["email"] = $row["email"];
		$profile["birthYear"] = $row["birthYear"];
		$profile["livingArea"] = $row["livingArea"];
		$profile["phoneNumber"] = $row["phoneNumber"];
		$profile["about"] = $row["about"];
		$profile["imagePath"] = $row["imagePath"];
		$profile["sex"] = $row["sex"];
	}
	/* Закрываем соединение */ 
	mysqli_close($mysqli);

		return $profile;
	}
	else{
		return "<p>
			Вы не авторизованы.<br><br>
			<a href= '/index.php?action=signIn' >Войти</a></p>";
	}

}

function _getLocale(){

	if(!empty( $_GET["locale"] )){
		$_SESSION["locale"] = $_GET["locale"];
	}
	elseif(( empty($_GET["locale"])) && (empty( $_SESSION["locale"] )) ){
		$_SESSION["locale"] = "ru";			
	}
	return $_SESSION["locale"];
 }


 ?>
