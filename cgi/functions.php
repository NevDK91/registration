<?php

function getProfile($id, $mysqli){
	if( ( isset($_SESSION["signedUserId"]) ) && ( !empty($_SESSION["signedUserId"]) ) ) {

	if ($mysqli == false) { 
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

 function array_push_assoc($array, $subArray){
	 	array_push($array, $subArray);
	 	return $array;
	}

 function generateRandomString($length = 15){
    	return substr(sha1(rand()), 0, $length);
	}

function _getActionName(){
	$actionStartPos = stripos( $_SERVER["REQUEST_URI"], "=" ) + 1 ;
	$localeStartPos = stripos( $_SERVER["REQUEST_URI"], "&" );
	if( $localeStartPos !== false )
		$actionName = substr( $_SERVER["REQUEST_URI"], $actionStartPos, ( $localeStartPos - $actionStartPos ) );
	else
		$actionName = substr( $_SERVER["REQUEST_URI"], $actionStartPos );
	return $actionName;

}

function dbConnect(){
	return mysqli_connect( '54.158.247.34:3306','be46453c6afb01','39ac7007','heroku_85edc47e4ce03b1');
}


?>

