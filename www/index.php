<?php
session_start();
if ($_GET['url'] === 'favicon.ico') {
 http_response_code(404);
 exit();
}
define('ROOT', __DIR__);
require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();
$router = new Utils\Router\Router($_GET['url']);
$router->get('/',function(){echo 'homepage';});
$router->get('/inscription',function(){});
$router->post('/welcomeOnBoard','account#inscription');
$router->post('/connexion','account#login');
$router->get('/deconnexion','account#logout');
$router->get('/validate','account#validateUser');
$router->get('/profil/:username','account#getUser');
$router->post('/profil/:username/param','account#updateAccountInfos');
$router->get('/univers/:planet/post/:id','publication#view');
$router->run();
