<?php

if ($_GET['url'] === 'favicon.ico') {
    http_response_code(404);
    exit();
}
define('ROOT', __DIR__);
require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();
\Utils\Session::init();

use \Utils\Router\Router;

Router::init($_GET['url']);

Router::post('/auth/signin','account#inscription');
Router::post('/auth/login','account#login');
Router::post('/auth/logout','account#logout');
Router::get('/auth/validate','account#validateUser', 'auth.validate');
Router::get('/users/me','account#getCurrentUser', 'users.me');

Router::get('/users/me/friends','friend#viewListFriend', 'users.me');
Router::post('/users/:userId/add_friend','friend#addFriend', 'users.me.addFriend');
Router::post('/users/:userId/confirm_friend','friend#confirmFriend', 'users.me.confirmFrien');
Router::post('/users/:userId/delete_friend','friend#deleteFriend', 'users.me.deleteFriend');
Router::get('/users/:userId/friends','friend#viewListFriend', 'users.me.viewListFriend');

Router::post('/planets/:planet/posts', 'publication#create', 'planets.posts.create');
Router::get('/planets/:planet/posts', 'publication#list', 'planets.posts.list');
Router::get('/planets/:planet/posts/:id','publication#view', 'planets.posts.view');
Router::patch('/planets/:planet/posts/:id', 'publication#update', 'planets.posts.update');
Router::delete('planets/:planet/posts/:id', 'publication#delete', 'planets.posts.delete');

Router::get('/planets/:planet/news' , 'planet#getPlanetFeed');

Router::post('/riddles', 'riddle#create', 'riddle.create');
Router::get('/riddles', 'riddle#list', 'riddle.list');
Router::patch('/riddles/:id', 'riddle#update', 'riddle.update');
Router::delete('/riddles/:id', 'riddle#delete', 'riddle.delete');

try {
  Router::run();
} catch (\Utils\RequestException $e) {
  header('Content-Type: application/json; charset=utf-8');
  http_response_code($e->getHttpCode());
  echo json_encode([
    'error' => $e->getMessage(),
  ]);
}
