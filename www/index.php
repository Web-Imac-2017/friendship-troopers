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
Router::get('/users/:userId/interest','interest#listUserInterest', 'users.me.listInterest');
Router::post('/users/me/interest/add_interest','interest#addUserInterest', 'users.me.updateUserInterest');
Router::post('/users/me/interest/delete_interest','interest#delete_interest', 'users.me.updateUserInterest');
Router::get('/users/me/avatars','avatar#listUserAvatar', 'users.me.listAvatar');

Router::get('/users/me/waiting_list_friend','friend#invitationList', 'users.me.invitationList'); //ok
Router::get('/users/me/friends','friend#listFriend', 'users.me.listUserFriend'); //ok
Router::post('/users/:userId/add_friend','friend#addFriend', 'users.me.addFriend'); //ok
Router::patch('/users/:userId/confirm_friend','friend#confirmFriend', 'users.me.confirmFriend'); //ok
Router::delete('/users/:userId/delete_friend','friend#deleteFriend', 'users.me.deleteFriend'); //same route for rejecting a friend //ok
Router::get('/users/:userId/friends','friend#listFriend', 'users.me.listFriend'); //ok
Router::get('/users/:userId/number_friends','friend#countFriend', 'users.me.countFriend'); //ok

Router::post('/avatar','avatar#create', 'avatar.create');

Router::post('/planets/:planet/posts', 'publication#create', 'planets.posts.create');
Router::get('/planets/:planet/posts', 'publication#list', 'planets.posts.list');
Router::patch('/planets/:planet/posts/:id', 'publication#update', 'planets.posts.update');
Router::delete('/planets/:planet/posts/:id', 'publication#delete', 'planets.posts.delete');

Router::get('/planets/:planet/news', 'planet#getPlanetFeed');

Router::post('/interest/add' , 'interest#addInterest','interest.add');
Router::get('/interest/view','interest#listInterest', 'interest.list');

Router::post('/planets/:planet/posts/:publicationId/comments', 'comment#create', 'planets.posts.comments.create');
Router::get('/planets/:planet/posts/:publicationId/comments', 'comment#list', 'planets.posts.comments.list');
Router::patch('/planets/:planet/posts/:publicationId/comments/:id', 'comment#update', 'planets.posts.comments.update');
Router::delete('planets/:planet/posts/:publicationId/comments/:id', 'comment#delete', 'planets.posts.comments.delete');

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
