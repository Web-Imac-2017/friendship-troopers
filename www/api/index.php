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

require_once ROOT.'/api/utils/Router/Router.php';
require_once ROOT.'/api/utils/Router/Route.php';

use \Utils\Router\Router;

Router::init($_GET['url']);

Router::post('/v1/auth/signin','account#inscription');
Router::post('/v1/auth/signin/username','account#isUsernameFree', 'users.me.usernameFree');
Router::post('/v1/auth/signin/mail','account#isMailFree', 'users.me.mailFree');
Router::post('/v1/auth/login','account#login','user.login');
Router::post('/v1/auth/logout','account#logout','user.logout');
Router::get('/v1/auth/validate','account#validateUser', 'auth.validate'); //ok


Router::get('/v1/users/search','account#search', 'users.search');
Router::get('/v1/users/list','user#usersList', 'users.list'); //ok. prend comme param planetId ou role (l'id)
Router::get('/v1/users/me','account#getCurrentUser', 'users.me');
Router::patch('/v1/users/me','account#updateAccountInfos', 'users.me.update');
Router::delete('/v1/users/me','account#delete', 'users.me.delete');
Router::post('/v1/users/password','account#lostPassword', 'users.me.lostPassword');
Router::post('/v1/users/password/new','account#setNewPassword', 'users.me.newPassword');

Router::get('/v1/users/me/avatars','avatar#listUserAvatar', 'users.me.listAvatar');
Router::patch('/v1/users/me/avatars/:avatarId/current','avatar#setCurrentAvatar', 'users.me.setCurrentAvatar');

Router::get('/v1/users/me/waiting_list_friend','friend#invitationList', 'users.me.invitationList'); //ok
Router::get('/v1/users/me/friends','friend#listFriend', 'users.me.listUserFriend'); //ok

Router::post('/v1/users/me/interest/add_interest','interest#addUserInterest', 'users.me.updateUserInterest');
Router::post('/v1/users/me/interest/delete_interest','interest#delete_interest', 'users.me.updateUserInterest');

Router::post('/v1/users/:userId/user_title','user_title#add');
Router::get('/v1/users/:userId/user_title/list','user_title#list');
Router::get('/v1/users/:userId/user_title/current_title','user_title#viewCurrent');
Router::get('/v1/users/:userId/user_title/count','user_title#count');
Router::patch('/v1/users/:userId/user_title/set_current/:titleId','user_title#setCurrent');
Router::delete('/v1/users/:userId/user_title/:titleId','user_title#delete');




Router::get('v1/users/:userId','account#getUser', 'users.profil');
Router::post('v1/users/:userId/add_friend','friend#addFriend', 'users.me.addFriend'); //ok
Router::patch('v1/users/:userId/confirm_friend','friend#confirmFriend', 'users.me.confirmFriend'); //ok
Router::delete('v1/users/:userId/delete_friend','friend#deleteFriend', 'users.me.deleteFriend'); //same route for rejecting a friend //ok
Router::get('v1/users/:userId/friends','friend#listFriend', 'users.me.listFriend'); //ok
Router::get('v1/users/:userId/number_friends','friend#countFriend', 'users.me.countFriend'); //ok

Router::get('v1/users/:userId/interest','interest#listUserInterest', 'users.me.listInterest');

Router::post('v1/avatar','avatar#create', 'avatar.create');
Router::patch('v1/avatar/:id','avatar#update', 'avatar.update');

Router::post('v1/interest/add' , 'interest#addInterest','interest.add');
Router::get('v1/interest/view','interest#listInterest', 'interest.list');
Router::post('v1/interest/delete','interest#deleteInterest','interest.delete');
Router::post('/v1/user/:userId/interests' , 'interest#WelcomeOnBoard','interest.WelcomeOnBoard');

Router::get('/v1/planets', 'planet#list');
Router::post('/v1/planets', 'planet#create');
Router::delete('/v1/planets/:planet', 'planet#delete');

Router::post('/v1/planets/:planet/posts', 'publication#create', 'planets.posts.create');
Router::get('/v1/planets/:planet/posts', 'publication#list', 'planets.posts.list');
Router::get('/v1/planets/:planet/posts/count', 'publication#count', 'planets.posts.count');

Router::patch('/v1/planets/:planet/posts/:id', 'publication#update', 'planets.posts.update');
Router::delete('/v1/planets/:planet/posts/:id', 'publication#delete', 'planets.posts.delete');

Router::post('/v1/planets/:planet/posts/:publicationId/comments', 'comment#create', 'planets.posts.comments.create');
Router::get('/v1/planets/:planet/posts/:publicationId/comments', 'comment#list', 'planets.posts.comments.list');
Router::get('/v1/planets/:planet/posts/:publicationId/comments/count', 'comment#count', 'planets.posts.comments.count');
Router::patch('/v1/planets/:planet/posts/:publicationId/comments/:id', 'comment#update', 'planets.posts.comments.update');
Router::delete('v1/planets/:planet/posts/:publicationId/comments/:id', 'comment#delete', 'planets.posts.comments.delete');

Router::post('v1/posts/:publicationId/stardust' , 'stardust#create');
Router::delete('v1/posts/:publicationId/stardust' , 'stardust#delete');
Router::get('v1/posts/:publicationId/stardust' , 'stardust#list');
Router::get('v1/posts/:publicationId/stardust/exist' , 'stardust#exist');

Router::post('v1/riddles', 'riddle#create', 'riddle.create');
Router::get('v1/riddles', 'riddle#list', 'riddle.list');
Router::patch('v1/riddles/:id', 'riddle#update', 'riddle.update');
Router::delete('v1/riddles/:id', 'riddle#delete', 'riddle.delete');

Router::post('v1/titles', 'title#create');
Router::get('v1/titles', 'title#list');
Router::patch('v1/titles/:id', 'title#update');
//Router::delete('/titles/:id', 'title#delete');

try {
  Router::run();
} catch (\Utils\RequestException $e) {
  header('Content-Type: application/json; charset=utf-8');
  http_response_code($e->getHttpCode());
  echo json_encode([
    'error' => $e->getMessage(),
  ]);
}
