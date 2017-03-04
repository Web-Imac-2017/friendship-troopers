<?php
session_start();
if ($_GET['url'] === 'favicon.ico') {
    http_response_code(404);
    exit();
}
$_SESSION['user'] = [
  'planet' => 'Terre',
];
define('ROOT', __DIR__);
require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();
$router = new Utils\Router\Router($_GET['url']);
$router->get('/',function(){echo 'homepage';});
$router->get('/inscription',function(){echo 'inscription';});
$router->post('/inscription','account#inscription');
$router->post('/connexion','account#login');
$router->get('/deconnexion','account#logout');
$router->get('/validate','account#validateUser');
$router->get('/profil/:username','account#getUser');
$router->get('/profil/:username/validation','account#getUser');
$router->get('/univers/:planet/post/:id','publication#view');
$router->get('/univers/:planet/actualites' , 'planet#getPlanetFeed');
$router->run();
?>
