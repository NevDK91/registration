<?php require_once "helpers/header.php";
	  $captions = ["firstName" => 'Имя', "lastName" => 'Фамилия', "email" => 'E-mail', "birthYear" => 'Год рождения', "livingArea" => 'Место проживания', "phoneNumber" => 'Номер телефона', "abot" => 'О себе', "sex" => 'Пол', ]
 ?>

	<br>
	<div style="float:left;width:40%">
		<a href='/cgi/signOut.php'>Выйти</a>
		<img src=<?php echo $profile["imagePath"] ?> width="200" height="auto" />
	</div>
	<div style="float:left;width:55%;margin-top:15px">
	<?php foreach($profile as $key => $value) {
		if( ($key == "about") || ($key == "imagePath") )
			continue;
		echo "<div class=profileRow><div class=profileKey>".$captions[$key].":</div><div class=profileValue>".$value."</div><div class=clearfix></div>";

		} ?>
	</div>
	</section>

	<footer>
	</footer>
</body>
</html>
