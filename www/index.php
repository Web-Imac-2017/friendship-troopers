<?php 
/*
require_once($_SERVER['DOCUMENT_ROOT'].'/api/autoload.php');
$autoload =  new \Autoloadr\Universal();
$autoload->add_prefix($_SERVER['DOCUMENT_ROOT'] . '/api');
/*$autoload->add_prefix($_SERVER['DOCUMENT_ROOT'] . '/api/models');*/
/*$autoload->register();
$controller = new controllers\SignIn(); */

echo strpbrk("clasController", 'Controller');
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

