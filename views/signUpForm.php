<?php require_once "helpers/header.php" ?>

		<form class="form" name="signUp" id="signUp" action="cgi/signUp.php" enctype="multipart/form-data" method="POST">
			<h3> <?php echo $messages["signUp"]["titleMain"][$locale]; ?> </h3>
			<div class="line">
				<label for="firstName"> <?php echo $messages["signUp"]["labelFirstName"][$locale]; ?> <span class="required"> *</span><div class="helper" id="for_firstName"><?php echo $messages["signUp"]["helperFirstName"][$locale]; ?></div></label>
				<input type="text" name="firstName" id="firstName" onfocus="showHelper(this,this.id)" required />
			</div>
			<div class="line">
				<label for="lastName"> <?php echo $messages["signUp"]["labelLastName"][$locale]; ?> <span class="required"> *</span><div class="helper" id="for_lastName"><?php echo $messages["signUp"]["helperLastName"][$locale]; ?></div></label>
				<input type="text" name="lastName" id="lastName" onfocus="showHelper(this,this.id)" required />
			</div>
			<div class="line">
				<label for="email"> <?php echo $messages["signUp"]["labelEmail"][$locale]; ?> <span class="required"> *</span><div class="helper" id="for_email"><?php echo $messages["signUp"]["helperEmail"][$locale]; ?></div></label>
				<input type="email" name="email" id="email" onfocus="showHelper(this,this.id)" required/>
			</div>
			<div class="line">
				<label for="password"> <?php echo $messages["signUp"]["labelPassword"][$locale]; ?> <span class="required"> *</span><div class="helper" id="for_password"><?php echo $messages["signUp"]["helperPassword"][$locale]; ?></div></label>
				<input type="password" name="password" id="password" onfocus="showHelper(this,this.id)" required  />
			</div>
			<div class="line">
				<label for="passwordConfirmation"> <?php echo $messages["signUp"]["labelPassConfirm"][$locale]; ?> <span class="required"> *</span><div class="helper" id="for_passwordConfirmation"><?php echo $messages["signUp"]["helperPassword"][$locale]; ?></div></label>
				<input type="passowrd" name="passwordConfirmation" onfocus="showHelper(this,this.id)" required id="passwordConfirmation"  />
			</div>
			<h3> <?php echo $messages["signUp"]["titleAdditional"][$locale]; ?> </h3>
			<div class="line">
				<label for="birthYear"> <?php echo $messages["signUp"]["labelBirthYear"][$locale]; ?> <div class="helper" id="for_birthYear"><?php echo $messages["signUp"]["helperBirthYear"][$locale]; ?></div></label>
				<input type="number" min="1920" max="2010" step="1" name="birthYear" id="birthYear" onfocus="showHelper(this,this.id)" />
			</div>
			<div class="line">
				<label for="livingArea"> <?php echo $messages["signUp"]["labelLivingArea"][$locale]; ?> <div class="helper" id="for_livingArea"><?php echo $messages["signUp"]["helperLivingArea"][$locale]; ?></div></label>
				<input type="text" name="livingArea" id="livingArea" onfocus="showHelper(this,this.id)" />
			</div>
			<div class="line" id="phoneNumbers">
				<label for="phoneNumber"> <?php echo $messages["signUp"]["labelPhoneNumber"][$locale]; ?> <div class="helper" id="for_phoneNumber"><?php echo $messages["signUp"]["helperPhoneNumber"][$locale]; ?></div></label>
				<input type="tel" name="phoneNumber" id="phoneNumber" onfocus="showHelper(this,this.id)" />
			</div>
			<div class="line">
				<label for="about"> <?php echo $messages["signUp"]["labelAbout"][$locale]; ?> <div class="helper" id="for_about"><?php echo $messages["signUp"]["helperAbout"][$locale]; ?></div></label>
				<textarea name="about" id="about" onfocus="showHelper(this,this.id)" ></textarea>
			</div>
			<div class="line">
				<label for="image"> <?php echo $messages["signUp"]["labelImage"][$locale]; ?> <div class="helper" id="for_image"><?php echo $messages["signUp"]["helperImage"][$locale]; ?></div></label>
				<input type="file" name="image" id="image" onfocus="showHelper(this,this.id)" />
			</div>
			<div class="line">
				<label for="sex"> <?php echo $messages["signUp"]["labelSex"][$locale]; ?> </label>
				<span>
				<label> <?php echo $messages["signUp"]["maleSex"][$locale]; ?> <input type="radio" name="sex" id="sex" value="male"></label>
				<label> <?php echo $messages["signUp"]["femaleSex"][$locale]; ?> <input type="radio" name="sex" id="sex" value="female"></label>
				</span>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<input type="submit" value= <?php echo $messages["signUp"]["submitValue"][$locale]; ?> >
		</form>
	</section>
	<footer>
	</footer>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
