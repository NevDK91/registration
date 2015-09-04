<?php
session_start();
include_once 'validate.php';
include_once 'mail.php';
include_once 'messages.php';
include_once 'functions.php';

$inputs = array(
		[ "fieldName" => "firstName", "fieldValue" => $_POST["firstName"], "regExp" => "/[a-zA-Zа-яА-я ]{2,100}$/", "required" => true, "fieldCaption" => $messages["fieldCaption"]["firstName"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["firstName"][ $_SESSION["locale"] ] ],
		[ "fieldName" => "lastName", "fieldValue" => $_POST["lastName"], "regExp" => "/[a-zA-Zа-яА-я ]{2,100}$/", "required" => true, "fieldCaption" => $messages["fieldCaption"]["lastName"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["lastName"][ $_SESSION["locale"] ]  ],
		[ "fieldName" => "email", "fieldValue" => $_POST["email"], "regExp" => "/^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$/", "required" => true, "fieldCaption" => $messages["fieldCaption"]["email"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["email"][ $_SESSION["locale"] ]  ],
		[ "fieldName" => "password", "fieldValue" => $_POST["password"], "regExp" => "/^[a-zA-Z0-9-_\.]{4,15}$/", "required" => true, "fieldCaption" => $messages["fieldCaption"]["password"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["password"][ $_SESSION["locale"] ] ],
		[ "fieldName" => "passConfirm", "fieldValue" => $_POST["passwordConfirmation"], "regExp" => "/^[a-zA-Z0-9-_\.]{4,15}$/", "required" => true, "fieldCaption" => $messages["fieldCaption"]["passConfirm"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["password"][ $_SESSION["locale"] ]  ],
		[ "fieldName" => "birthYear", "fieldValue" => $_POST["birthYear"], "regExp" => "/^[0-9]{0,4}$/", "required" => false, "fieldCaption" => $messages["fieldCaption"]["birthYear"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["birthYear"][ $_SESSION["locale"] ]  ],
		[ "fieldName" => "livingArea", "fieldValue" => $_POST["livingArea"], "regExp" => "/[a-zA-Zа-яА-Я0-9,. ]{0,100}$/", "required" => false, "fieldCaption" => $messages["fieldCaption"]["livingArea"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["livingArea"][ $_SESSION["locale"] ]  ],
		[ "fieldName" => "phoneNumber", "fieldValue" => $_POST["phoneNumber"], "regExp" => "/^[0-9-.()+ ]{0,20}$/", "required" => false, "fieldCaption" => $messages["fieldCaption"]["phoneNumber"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["phoneNumber"][ $_SESSION["locale"] ]  ],
		[ "fieldName" => "about", "fieldValue" => $_POST["about"], "regExp" => "/[a-zA-Zа-яА-Я0-9 ]{0,255}$/", "required" => false, "fieldCaption" => $messages["fieldCaption"]["about"][ $_SESSION["locale"] ], "validMsg" => $messages["validate"]["about"][ $_SESSION["locale"] ]  ],
		[ "fieldName" => "sex", "fieldValue" => $_POST["sex"], "regExp" => "/^[a-z]{0,6}$/", "required" => false, "fieldCaption" => "Пол", "validMsg" => ""  ] 
	);


$inputs = validate($inputs, "signUp", $messages);

if($inputs == false){// Если есть невалидные поля - вернуть в форму с ошибками
	echo header( 'Location: '.$_SERVER['HTTP_REFERER'], true, 301 );
}
else{// Если все поля валидны продолжить регистрацию

$mysqli = dbConnect();	
	
$fields = [];

	for ($i=0;$i < count($inputs); $i++){
		$fieldName = $inputs[$i]["fieldName"];
		$fields[$fieldName] = $inputs[$i]["fieldValue"];
	}


$imagePath = "";

   if( (isset( $_FILES['image'] )) && (!empty($_FILES['image']['name']) ) ) { // Загрузка файла если он существует

		$uploaddir = '../uploads/';
		$imagePath = $uploaddir . $_FILES['image']['name'];
		if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
			print "File is valid, and was successfully uploaded.";

		} 
		else {
			print "There some errors!";
		}

	}
	else{
		$imagePath = 'uploads/default.jpg';
	}
	

$confirmCode = generateRandomString(40);	
$passwordHashed = password_hash($fields['password'], PASSWORD_DEFAULT);
$confirmed = 0;

	 

	if (!$mysqli) { 
	   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
	   exit; 
	};

	$mysqli->query( "SET CHARSET 'utf8'" );

	$sql = "insert into users() values(null, '$fields[firstName]', '$fields[lastName]', '$fields[email]', '$passwordHashed', '$fields[birthYear]', '$fields[livingArea]', '$fields[phoneNumber]', '$fields[about]', '$imagePath', '$fields[sex]', '$confirmCode', $confirmed)";
	$res = $mysqli->query($sql);
	// Performs the $sql query on the server to create the database
	if ($res === TRUE) {
	  

	  $mailed = mailing($confirmCode, $fields["email"], $messages["mail"]);
	  var_dump($mailed);

	  if($mailed){

	  	$_SESSION["success"] = "<p class=successMsg>".$messages["signUp"]["successSignUp"][ $_SESSION["locale"] ]."</p>";
	  	echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	  }

	}
	else {
		var_dump($res);
	 	echo '<br>Error: '. $mysqli->error;

	}

	mysqli_close($mysqli);


}


 ?>