<?php

/*	ТОЧКА ВХОДА В ПРИЛЖЕНИЕ, МАРШРУТИЗАТОР	*/

	session_start();
	require_once "cgi/functions.php"; // все используемые функции
	require_once "cgi/messages.php"; // хранилищесообщений на разных языках
	$locale = _getLocale(); // функция определения текущего языка
	$mysqli = dbConnect(); // функция связи с БД

	if(empty( $_SESSION["token"] )){ // если пользователь заходит впервые - генерируется токен
		if( function_exists( "mcrypt_create_iv" ) ){
			$_SESSION["token"] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_RANDOM));
		}
		else{
			$_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(32));
		}
	}
	$token = $_SESSION["token"];

	if(empty( $_GET["action"] ))
		$_GET["action"] = "main";

	switch( $_GET["action"] ) { // примитивный маршрутизатор

		case "signUp": // страница регистрации
			$page_title = $messages["pageTitleSignUp"][$locale]; // заголовок страницы, отображается в html
			require_once "views/signUpForm.php"; // подключение вида
		break;

		case "signIn": // страница авторизации
			if( ( isset($_SESSION["signedUserId"]) ) && ( !empty($_SESSION["signedUserId"]) ) ) { // если пользователь уже авторизован, перенаправление на страницу профиля с сообщением об успехе
				$_SESSION["success"] = "<p class=successMsg>".$messages["signIn"]["alreadySignIn"][$locale]."</p>";
				echo header( 'Location: http://'.$_SERVER['SERVER_NAME']."/index.php?action=profile", true, 301 );
			}
			else{
				$page_title = $messages["pageTitleSignIn"][$locale]; // если пользователь не авторизован - на страницу авторизации
				require_once "views/signInForm.php";
			}
		break;

		case "profile": // страница профиля
			if( ( !isset($_SESSION["signedUserId"]) ) && ( empty($_SESSION["signedUserId"]) ) ) { // если не авторизован - на страницу авторизации
				$_SESSION["errors"] = "<p class=errorMsg>".$messages["profile"]["shouldSignIn"][$locale]."</p>";
				echo header( 'Location: http://'.$_SERVER['SERVER_NAME']."/index.php?action=signIn", true, 301 );
				}
				else{															//если авторизован - взять из БД данные и подключить страницу профиля
					$page_title = $messages["pageTitleProfile"][$locale]; 
					$profile = getProfile( $_SESSION["signedUserId"], $mysqli );
					require_once "views/profile.php";
				}
		break;

		case "main":	// главная страница
			$page_title = $messages["pageTitleMain"][$locale];
			if( empty( $_SESSION["success"]) || (!isset( $_SESSION["success"] )) ) // если нет других уведомлений - вывести приветствие
			$_SESSION["success"] = "<p class=successMsg>".$messages["msgBlockGreetings"][$locale]."</p>";
			require_once "views/main.php";
		break;

		default:
			require_once "views/main.php";
	}			
 ?>
 
