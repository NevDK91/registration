<?php require_once "helpers/header.php";
	  $captions = ["firstName" => 'Имя', "lastName" => 'Фамилия', "email" => 'E-mail', "birthYear" => 'Год рождения', "livingArea" => 'Место проживания', "phoneNumber" => 'Номер телефона', "about" => 'О себе', "sex" => 'Пол', ]
 ?>

	<br>
	<div style="float:left;width:40%;">
		<a href='/cgi/signOut.php'><?php echo $messages["profile"]["signOutLink"][$locale]; ?></a>
		<img src=<?php echo $profile["imagePath"] ?> class="imgProfile" />
	</div>
	<div style="float:left;width:55%;margin-top:15px;">
	<?php foreach($profile as $key => $value) {
		if( ($key == "about") || ($key == "imagePath") )
			continue;
		echo "<div class=profileRow><div class=profileKey>".$messages["profile"][$key][$locale].":</div><div class=profileValue>".$value."</div><div class=clearfix></div>";
		}; 
		?>
	</div>
	<div class="profileRow"><div class="profileKey"><?php echo $messages["profile"]["about"][$locale]; ?></div><div class="about"><?php echo $profile["about"]; ?></div></div>
		
	</section>

	<footer>
	</footer>
</body>
</html>
