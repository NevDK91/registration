<?php
session_start();

if( (isset($_GET['code'])) && ($_GET['code'] !== "") ){

	$code = strip_tags( $_GET['code'] );

	$mysqli = mysqli_connect( 'localhost','root','','forms');

	if (!$mysqli) { 
	     printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
	     exit; 
	  };

	$sql = "select confirmed from users where confirmCode='$code'";

	$result = $mysqli->query($sql);
	while($row = $result->fetch_assoc()) {
		$confirmed = $row["confirmed"];
	}
	echo $confirmed;

	if($confirmed == 1){
		$_SESSION["error"] = "<p class=successMsg>Аккаунт уже подтвержден!</p>";
	  	echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	}
	else{
		$sql = "update users set confirmed = 1 where confirmCode='$code'";
		$result = $mysqli->query($sql);
		  // Performs the $sql query on the server to create the database
		if($result){
			$_SESSION["success"] = "<p class=successMsg>Ваш аккаунт успешно подтвержден! Теперь вы можете <a href=/index.php?action=signIn>авторизоваться</a> и посмотреть свой профиль</p>";
	  		echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	  	}	
		else{ 
			$_SESSION["error"] = "<p class=errorMsg>Ваш аккаунт не подтвержден вследствие программной ошибки, обратитесь к разработчику</p>";
	  		echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
		}	
	}  

	mysqli_close($mysqli); 

}

else{
		$_SESSION["error"] = "<p>Код не указан! Ссылка предназначена только для подтверждения почтового ящика!</p>";
	  	echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	}

 ?>