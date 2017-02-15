<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/api/controllers/SignInController.class.php');

$controller = new SignIn(); 
?>


<form method="POST" action="views/test.php">
	<label>Username
		<input type="text" name="username"/>
	</label>
	<label>email
		<input type="text" name="mail"/>
	</label>
	<label>password
		<input type="password" name="password" />
		</label>

	<input type="submit" value="envoyer">
</form>

