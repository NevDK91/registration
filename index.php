<?php
	session_start();
	require_once "cgi/functions.php"; // getProfile()
	require_once "cgi/messages.php"; // локализация сообений

	if(empty( $_SESSION["token"] )){
		if( function_exists( "mcrypt_create_iv" ) ){
			$_SESSION["token"] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_RANDOM));
		}
		else{
			$_SESSION["token"] = bin2hex(openssl_random_pseudo_bytes(32));
		}
	}
	$token = $_SESSION["token"];

	if(!isset( $_GET["action"] ))
		$_GET["action"] = "main";

	if(!empty( $_GET["locale"] )){
		$_SESSION["locale"] = $_GET["locale"];
	}
	elseif(( empty($_GET["locale"])) && (empty( $_SESSION["locale"] )) ){
		$_SESSION["locale"] = "ru";			
	}
	$locale = $_SESSION["locale"];
	var_dump($locale);

	switch( $_GET["action"] ) {
		case "signUp":
			$page_title = $messages["pageTitleSignUp"][$locale];
			require_once "views/signUpForm.php";
		break;
		case "signIn":
			if( ( isset($_SESSION["signedUserId"]) ) && ( !empty($_SESSION["signedUserId"]) ) ) {
				$_SESSION["success"] = "<p class=successMsg>Вы уже авторизованы!</p>";
				echo header( 'Location: http://'.$_SERVER['SERVER_NAME']."/index.php?action=profile", true, 301 );
			}
			else{
				$page_title = $messages["pageTitleSignIn"][$locale];
				require_once "views/signInForm.php";
			}
		break;
		case "profile":
			if( ( !isset($_SESSION["signedUserId"]) ) && ( empty($_SESSION["signedUserId"]) ) ) {
				$_SESSION["error"] = "<p class=errorMsg>Авторизуйтесь, чтобы просматривать совй профиль!</p>";
				echo header( 'Location: http://'.$_SERVER['SERVER_NAME']."/index.php?action=signIn", true, 301 );
				}
				else{
					$page_title = $messages["pageTitleProfile"][$locale];
					$profile = getProfile( $_SESSION["signedUserId"] );
					require_once "views/profile.php";
				}
		break;
		case "main":
			$page_title = $messages["pageTitleMain"][$locale];
			require_once "views/main.php";
		break;
		default:
			require_once "views/main.php";
	}			
 ?>
