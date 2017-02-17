<?php

define('ROOT', __DIR__);

require_once ROOT.'/api/utils/Autoloader.php';

\Utils\Autoloader::register();
\Utils\Config::init();

//var_dump(\Utils\Config::get('db.hostname'));

$model = new \Models\Model();

//$controller = new SignIn();
