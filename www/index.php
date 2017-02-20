<?php
define('ROOT', __DIR__);
require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();
//var_dump(\Utils\Config::get('db.hostname'));
//$model = new \Models\Model();
//$controller = new SignIn(); ?>

<form method="POST" action="views/test.php">
	<!-- <label>Username
		<input type="text" name="username"/>
	</label> -->
	<label>email
		<input type="text" name="mail"/>
	</label>
	<label>password
		<input type="password" name="password" />
	</label>

	<input type="submit" value="envoyer">
</form>



