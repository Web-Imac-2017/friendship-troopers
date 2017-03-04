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

use \Utils\Router\Router;

Router::init($_GET['url']);

Router::post('/auth/signin','account#inscription');
Router::post('/auth/login','account#login');
Router::post('/auth/logout','account#logout');
Router::get('/auth/validate','account#validateUser', 'auth.validate');
Router::get('/accounts/:username','account#getUser');
Router::get('/planets/:planet/posts', 'publication#list', 'planets.posts.list');
Router::get('/planets/:planet/posts/:id','publication#view');
Router::get('/planets/:planet/news' , 'planet#getPlanetFeed');

try {
  Router::run();
} catch (\Utils\RequestException $e) {
  header('Content-Type: application/json; charset=utf-8');
  http_response_code($e->getHttpCode());
  echo json_encode([
    'error' => $e->getMessage(),
  ]);
}
