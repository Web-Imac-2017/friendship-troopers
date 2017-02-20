test.php 

<?php 
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
require_once $_SERVER['DOCUMENT_ROOT'].'\api\utils\Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();
//$model = new \Models\Model();
$controller = new controllers\LogIn(); 
$controller->login();
?>
