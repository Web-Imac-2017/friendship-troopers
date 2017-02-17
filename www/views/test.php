test.php 

<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/api/autoload.php');
autoloader::register();

$controller = new controllers\SignIn(); 
$controller->inscription();
?>
