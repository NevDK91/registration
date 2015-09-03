<?php require_once "helpers/header.php" ?>

		<form class="form" name="signIn" id="signIn" action="cgi/signIn.php" enctype="application/x-www-form-urlencoded" method="POST">
			<div class="line">
				<label for="email"><?php echo $messages["signIn"]["labelEmail"][$locale]; ?><span class="required"> *</span><div class="helper" id="for_email"><?php echo $messages["signIn"]["helperEmail"][$locale]; ?></div></label>
				<input type="email" name="email" id="email" onfocus="showHelper(this,this.id)" required/>
			</div>
			<div class="line">
				<label for="password"><?php echo $messages["signIn"]["labelPassword"][$locale]; ?><span class="required"> *</span><div class="helper" id="for_password"><?php echo $messages["signIn"]["helperPassword"][$locale]; ?></div></label>
				<input type="password" name="password" id="password" onfocus="showHelper(this,this.id)" required  />
			</div>
			<input type="hidden" name="csrf_token" value=<?php echo $token; ?>  />
			<div class="clearfix"></div>
			<input type="submit" value= <?php echo $messages["signIn"]["submitValue"][$locale]; ?> >
		</form>
	</section>
	<footer>
	</footer>
	<script type="text/javascript" src="js/main.js"></script>
	<script src="..\\js\\messages.jsonp"></script>
</body>
</html>
