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
$router->post('/auth/signin','account#inscription');
$router->post('/auth/login','account#login');
$router->get('/auth/logout','account#logout');
$router->get('/auth/validate','account#validateUser');
$router->get('/accounts/:username','account#getUser');
$router->get('/planets/:planet/posts/:id','publication#view');
$router->get('/planets/:planet/news' , 'planet#getPlanetFeed');

try {
  $router->run();
} catch (\Utils\RequestException $e) {
  http_response_code($e->getHttpCode());
  echo json_encode([
    'error' => $e->getMessage(),
  ]);
}
