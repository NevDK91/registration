<?php
session_start();
include_once 'validate.php';
include_once 'mail.php';

$inputs = array(
		[ "fieldName" => "firstName", "fieldValue" => $_POST["firstName"], "regExp" => "/[a-zA-Zа-яА-я ]{2,100}$/", "required" => true, "fieldCaption" => "Имя", "validMsg" => "Должно иметь длину больше 2 символов, содержать только русские и английские буквы!" ],
		[ "fieldName" => "lastName", "fieldValue" => $_POST["lastName"], "regExp" => "/[a-zA-Zа-яА-я ]{2,100}$/", "required" => true, "fieldCaption" => "Фамилия", "validMsg" => "Должно иметь длину больше 2 символов, содержать только русские и английские буквы!"  ],
		[ "fieldName" => "email", "fieldValue" => $_POST["email"], "regExp" => "/^[A-z0-9._-]+@[A-z0-9.-]+\.[A-z]{2,4}$/", "required" => true, "fieldCaption" => "Пароль", "validMsg" => "Должно содержать только английские буквы, символы @ . "  ],
		[ "fieldName" => "password", "fieldValue" => $_POST["password"], "regExp" => "/^[a-zA-Z0-9-_\.]{4,15}$/", "required" => true, "fieldCaption" => "Подтв. пароля", "validMsg" => "Должно иметь длину от 5 символов, начинаться с английской буквы и содержать только английские буквы!" ],
		[ "fieldName" => "passConfirm", "fieldValue" => $_POST["passwordConfirmation"], "regExp" => "/^[a-zA-Z0-9-_\.]{4,15}$/", "required" => true, "fieldCaption" => "Год рождения", "validMsg" => "Должно иметь длину от 5 символов, начинаться с английской буквы и содержать только английские буквы!"  ],
		[ "fieldName" => "birthYear", "fieldValue" => $_POST["birthYear"], "regExp" => "/^[0-9]{0,4}$/", "required" => false, "fieldCaption" => "Место проживания", "validMsg" => "Должно иметь длину от 4 символа, диапазон 1920-2010"  ],
		[ "fieldName" => "livingArea", "fieldValue" => $_POST["livingArea"], "regExp" => "/[a-zA-Zа-яА-Я0-9,. ]{0,100}$/", "required" => false, "fieldCaption" => "Имя", "validMsg" => "Должно состоять только из русских или английских букв, цифр и символов , . "  ],
		[ "fieldName" => "phoneNumber", "fieldValue" => $_POST["phoneNumber"], "regExp" => "/^[0-9-.()+ ]{0,20}$/", "required" => false, "fieldCaption" => "Номер телефона", "validMsg" => "Должно состоять только из цифр и символов '-.() ' "  ],
		[ "fieldName" => "about", "fieldValue" => $_POST["about"], "regExp" => "/[a-zA-Zа-яА-Я0-9 ]{0,255}$/", "required" => false, "fieldCaption" => "Доп. информация", "validMsg" => "Должно состоять только из русских или английских букв, цифр и пробелов"  ],
		[ "fieldName" => "sex", "fieldValue" => $_POST["sex"], "regExp" => "/^[a-z]{0,6}$/", "required" => false, "fieldCaption" => "Пол", "validMsg" => ""  ] 
	);



$inputs = validate($inputs, "signUp");

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
		$imagePath = 'uploads/default.png';
	}

$confirmCode = generateRandomString(40);	
$passwordHashed = password_hash($fields['password'], PASSWORD_DEFAULT);
$confirmed = 0;

	 
$mysqli = mysqli_connect( 'localhost','root','','forms');     /* (server, user, password, databaseName) База данных для запросов по умолчанию */

	if (!$mysqli) { 
	   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
	   exit; 
	};

	$mysqli->query( "SET CHARSET 'utf8'" );

	$sql = "insert into users() values(null, '$fields[firstName]', '$fields[lastName]', '$fields[email]', '$passwordHashed', '$fields[birthYear]', '$fields[livingArea]', '$fields[phoneNumber]', '$fields[about]', '$imagePath', '$fields[sex]', '$confirmCode', $confirmed)";

	// Performs the $sql query on the server to create the database
	if ($mysqli->query($sql) === TRUE) {
	  

	  $mailed = mailing($confirmCode, $fields["email"]);

	  if($mailed){

	  	$_SESSION["success"] = "<p class=successMsg>Ваш аккаунт успешно зарегистрирован, но требует подтверждения. На указанный вами почтовый ящик отправлено письмо с ссылкой, по которой нужно проследовать для подтверждения аккаунта, спасибо за внимание!</p>";
	  	echo header( 'Location: http://'.$_SERVER['SERVER_NAME'], true, 301 );
	  }

	}
	else {

	 	echo '<br>Error: '. $mysqli->error;

	}
	/* Закрываем соединение */ 
	mysqli_close($mysqli);




function array_push_assoc($array, $subArray){
	 	array_push($array, $subArray);
	 	return $array;
	}

	function generateRandomString($length = 15){
    	return substr(sha1(rand()), 0, $length);
	}

 ?>