<?php

define('ROOT', __DIR__);

require_once ROOT.'/vendor/autoload.php';

$loader = new \Autoloadr\Universal();
$loader->add_prefix(ROOT.'/api/controllers');
$loader->add_prefix(ROOT.'/api/models');
$loader->add_prefix(ROOT.'/api/utils');
$loader->register();

//$controller = new SignIn();
