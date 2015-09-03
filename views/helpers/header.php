<!doctype html>
<html lang=<?php echo $locale; ?> >
<head>
	<meta charset="UTF-8">
	<title> <?php echo $page_title; ?> </title>
<link rel="stylesheet" type="text/css" href="/css/styles.css">	
</head>
<body>
	<header>
		<h2> <?php echo $page_title; ?> </h2>
	</header>
	<section id="nav">
	<?php
		echo '	
			<a href="index.php?action=main&locale='.$locale.'" >'.$messages["navMain"][$locale].'</a>
			<a href="index.php?action=signUp&locale='.$locale.'" >'.$messages["navSignUp"][$locale].'</a>
			<a href="index.php?action=signIn&locale='.$locale.'" >'.$messages["navSignIn"][$locale].'</a>
			<a href="index.php?action=profile&locale='.$locale.'" >'.$messages["navProfile"][$locale].'</a>
		';
	 ?>
	</section>
	<section id="main" class="clearfix">

		<div class="messageBlock" id="messageBlock">
			<?php
				if( (isset( $_SESSION["success"] )) && ( $_SESSION["success"] !== "" ) ){
					echo "<script type='text/javascript'>var block = document.getElementById(\"messageBlock\"); 
					block.style.display = \"block\"; block.style.border = \"1px solid green\";block.style.background = \"#d4fad0\";</script>";
					echo $_SESSION["success"];
					$_SESSION["success"] = "";
				}
				elseif( (isset( $_SESSION["errors"] )) && ( !empty($_SESSION["errors"]) ) ){
					echo "<script type='text/javascript'>var block = document.getElementById(\"messageBlock\"); 
					block.style.display = \"block\"; block.style.border = \"1px solid red\";block.style.background = \"#fad0d4\";</script>";
					echo $_SESSION["errors"];
					unset($_SESSION["errors"]);
				}	
				
			 ?>
		</div>