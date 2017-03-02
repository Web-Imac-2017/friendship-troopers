
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>friendship-troopers</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>
  <body>
    <div id="app"></div>
    <script type="text/javascript" src="assets/js/build.js"></script>
  </body>
</html>


<?php
session_start();
if ($_GET['url'] === 'favicon.ico') {
    http_response_code(404);
    exit();
}
$_SESSION['test']='ok';
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
