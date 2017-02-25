<?php
session_start();
define('ROOT', __DIR__);
require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();
$router = new Utils\Router\Router($_GET['url']);
$router->get('/inscription','account#inscription');
$router->run();
 ?>

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
