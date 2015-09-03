<?php require_once "helpers/header.php";
	  $captions = ["firstName" => 'Имя', "lastName" => 'Фамилия', "email" => 'E-mail', "birthYear" => 'Год рождения', "livingArea" => 'Место проживания', "phoneNumber" => 'Номер телефона', "about" => 'О себе', "sex" => 'Пол', ]
 ?>

	<br>
	<div style="float:left;width:40%;">
		<a class="signOut" href='/cgi/signOut.php'><?php echo $messages["profile"]["signOutLink"][$locale]; ?></a>
		<img src=<?php echo $profile["imagePath"] ?> class="imgProfile" />
	</div>
	<div style="float:left;width:55%;margin-top:30px;">
	<?php foreach($profile as $key => $value) {
		if( ($key == "about") || ($key == "imagePath") )
			continue;
		if( empty($value) ) $value = $messages["profile"]["undefined"][$locale];
		echo "<div class=profileRow><div class=profileKey>".$messages["profile"][$key][$locale].":</div><div class=profileValue>".$value."</div><div class=clearfix></div>";
		}; 
		?>
	</div>
	<div class="profileRow"><div class="profileKey"><?php echo $messages["profile"]["about"][$locale]; ?></div><div class="about"><?php echo ( !empty($profile["about"]) ? $profile["about"] : $messages["profile"]["undefined"][$locale] ); ?></div></div>
		
	</section>

	<footer>
	</footer>
</body>
</html>
