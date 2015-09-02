<?php require_once "helpers/header.php" ?>

		<form class="form" name="signIn" id="signIn" action="cgi/signIn.php" enctype="application/x-www-form-urlencoded" method="POST">
			<div class="line">
				<label for="email">e-mail<span class="required"> *</span><div class="helper" id="for_email">разрешены буквы a-Z, цифры</div></label>
				<input type="email" name="email" id="email" onfocus="showHelper(this,this.id)" required/>
			</div>
			<div class="line">
				<label for="password">Пароль<span class="required"> *</span><div class="helper" id="for_password">минимум 5 символов, разрешены англ. буквы, цифры</div></label>
				<input type="password" name="password" id="password" onfocus="showHelper(this,this.id)" required  />
			</div>
			<input type="hidden" name="csrf_token" value=<?php echo $token; ?>  />
			<div class="clearfix"></div>
			<input type="submit" value="Вход">
		</form>
	</section>
	<footer>
	</footer>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
