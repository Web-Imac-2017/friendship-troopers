<?php

define('ROOT', __DIR__);

require_once ROOT.'/api/utils/Autoloader.php';

\Utils\Autoloader::register();
\Utils\Config::init();

//var_dump(\Utils\Config::get('db.hostname'));

$model = new \Models\Model();
$controller = new \Controllers\publication();
$controller->view(1);
//$controller = new SignIn();
