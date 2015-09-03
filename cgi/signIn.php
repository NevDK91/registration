<?php 
session_start();
include_once 'validate.php';
include_once "messages.php";
include_once "functions.php";

$locale = _getLocale();

if(!empty( $_POST["csrf_token"] )){
	if( hash_equals($_POST["csrf_token"], $_SESSION["token"]) )
	{



$inputs = array(
		[ "fieldName" => "email", "fieldValue" => $_POST["email"], "regExp" => "/^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$/", "required" => true, "fieldCaption" => "Пароль", "validMsg" => "Должно содержать только английские буквы, символы @ . "  ],
		[ "fieldName" => "password", "fieldValue" => $_POST["password"], "regExp" => "/^[a-zA-Z0-9-_\.]{4,15}$/", "required" => true, "fieldCaption" => "Подтв. пароля", "validMsg" => "Должно иметь длину от 5 символов, начинаться с английской буквы и содержать только английские буквы!" ],
	);

$inputs = validate($inputs, "signIn");

$email = $inputs[0]["fieldValue"];

$password = $inputs[1]["fieldValue"];

$mysqli = dbConnect();

	if (!$mysqli) { 
	   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
	   exit; 
	};

	$mysqli->query( "SET CHARSET 'utf8'" );

	$sql = "select id,password,confirmed from users where email='$email' ";

	$res = $mysqli->query($sql);

	while($row = $res->fetch_assoc()) {
		$password_hash = $row["password"];
		$userId = $row["id"];
		$confirmed = $row["confirmed"];
	}
/* Закрываем соединение */ 
	mysqli_close($mysqli);

	if( password_verify($password, $password_hash) ){
		if($confirmed == 0){
				$_SESSION["errors"] = "<p class=errorMsg>".$messages["signIn"]["notConfirmed"][ $_SESSION["locale"] ]."</p>";
				echo header( 'Location: '.$_SERVER['HTTP_REFERER'], true, 301 );
		}
		else{
				$_SESSION["signedUserId"] = $userId;
				$_SESSION["success"] = "<p class=successMsg>".$messages["signIn"]["successSignIn"][$locale]."</p>";
				echo header( 'Location: http://'.$_SERVER['SERVER_NAME']."/index.php?action=profile", true, 301 );
			
		}
			
	}
	else{
			$_SESSION["errors"] = "<p class=errorMsg>".$messages["signIn"]["wrongEmailOrPass"][ $_SESSION["locale"] ]."</p>";
			echo header( 'Location: '.$_SERVER['HTTP_REFERER'], true, 301 );
	};


	}
	else{
		echo "Попытка взлома!";
		exit;
	}
}

?>