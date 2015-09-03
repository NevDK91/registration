<?php
session_start();
require_once "messages.php";

if( (isset($_GET['code'])) && ( !empty($_GET['code'])) ){

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
	if($confirmed == 1){
		$_SESSION["success"] = "<p class=successMsg>".$messages["confirm"]["already"][ $_SESSION["locale"] ]."</p>";
	  	echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	}
	else{
		$sql = "update users set confirmed = 1 where confirmCode='$code'";
		$result = $mysqli->query($sql);
		  // Performs the $sql query on the server to create the database
		if($result){
			$_SESSION["success"] = "<p class=successMsg>".$messages["confirm"]["success"][ $_SESSION["locale"] ]."</p>";
	  		echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	  	}	
		else{ 
			$_SESSION["errors"] = "<p class=errorMsg>".$messages["confirm"]["error"][ $_SESSION["locale"] ]."</p>";
	  		echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
		}	
	}  

	mysqli_close($mysqli); 

}

else{
		$_SESSION["error"] = "<p class=errorMsg>".$messages["confirm"]["emptyCode"][ $_SESSION["locale"] ]."</p>";
	  	echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	}

 ?>