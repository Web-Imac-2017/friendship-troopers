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
Router::post('/auth/signin/username','account#isUsernameFree', 'users.me.usernameFree');
Router::post('/auth/signin/mail','account#isMailFree', 'users.me.mailFree');
Router::post('/auth/login','account#login','user.login');
Router::post('/auth/logout','account#logout','user.logout');
Router::get('/auth/validate','account#validateUser', 'auth.validate'); //ok


Router::get('/users/search','account#search', 'users.search');
Router::get('/users/list','user#usersList', 'users.list'); //ok. prend comme param planetId ou role (l'id)
Router::get('/users/me','account#getCurrentUser', 'users.me');
Router::patch('/users/me','account#updateAccountInfos', 'users.me.update');
Router::delete('/users/me','account#delete', 'users.me.delete');
Router::post('/users/password','account#lostPassword', 'users.me.lostPassword');
Router::post('/users/password/new','account#setNewPassword', 'users.me.newPassword');
Router::get('/users/me/avatars','avatar#listUserAvatar', 'users.me.listAvatar');
Router::patch('/users/me/avatars/:avatarId/current','avatar#setCurrentAvatar', 'users.me.setCurrentAvatar');

Router::post('/users/:userId/user_title','user_title#add');
Router::get('/users/:userId/user_title/list','user_title#list');
Router::get('/users/:userId/user_title/current_title','user_title#viewCurrent');
Router::get('/users/:userId/user_title/count','user_title#count');
Router::patch('/users/:userId/user_title/set_current/:titleId','user_title#setCurrent');
Router::delete('/users/:userId/user_title/:titleId','user_title#delete');

Router::get('/users/me/waiting_list_friend','friend#invitationList', 'users.me.invitationList'); //ok
Router::get('/users/me/friends','friend#listFriend', 'users.me.listUserFriend'); //ok

Router::post('/users/me/interest/add_interest','interest#addUserInterest', 'users.me.updateUserInterest');
Router::post('/users/me/interest/delete_interest','interest#delete_interest', 'users.me.updateUserInterest');

Router::get('/users/:userId','account#getUser', 'users.profil');
Router::post('/users/:userId/add_friend','friend#addFriend', 'users.me.addFriend'); //ok
Router::patch('/users/:userId/confirm_friend','friend#confirmFriend', 'users.me.confirmFriend'); //ok
Router::delete('/users/:userId/delete_friend','friend#deleteFriend', 'users.me.deleteFriend'); //same route for rejecting a friend //ok
Router::get('/users/:userId/friends','friend#listFriend', 'users.me.listFriend'); //ok
Router::get('/users/:userId/number_friends','friend#countFriend', 'users.me.countFriend'); //ok

Router::get('/users/:userId/interest','interest#listUserInterest', 'users.me.listInterest');

Router::post('/avatar','avatar#create', 'avatar.create');
Router::patch('/avatar/:id','avatar#update', 'avatar.update');

Router::post('/interest/add' , 'interest#addInterest','interest.add');
Router::get('/interest/view','interest#listInterest', 'interest.list');
Router::post('/interest/delete','interest#deleteInterest','interest.delete');
Router::post('/user/:userId/interests' , 'interest#WelcomeOnBoard','interest.WelcomeOnBoard');

Router::get('/planets', 'planet#list');
Router::post('/planets', 'planet#create');
Router::delete('/planets/:planet', 'planet#delete');

Router::post('/planets/:planet/posts', 'publication#create', 'planets.posts.create');
Router::get('/planets/:planet/posts', 'publication#list', 'planets.posts.list');
Router::get('/planets/:planet/posts/count', 'publication#count', 'planets.posts.count');

Router::get('/planets/:planet/posts/:id','publication#view', 'planets.posts.view');
Router::patch('/planets/:planet/posts/:id', 'publication#update', 'planets.posts.update');
Router::delete('/planets/:planet/posts/:id', 'publication#delete', 'planets.posts.delete');

Router::post('/planets/:planet/posts/:publicationId/comments', 'comment#create', 'planets.posts.comments.create');
Router::get('/planets/:planet/posts/:publicationId/comments', 'comment#list', 'planets.posts.comments.list');
Router::get('/planets/:planet/posts/:publicationId/comments/count', 'comment#count', 'planets.posts.comments.count');
Router::patch('/planets/:planet/posts/:publicationId/comments/:id', 'comment#update', 'planets.posts.comments.update');
Router::delete('planets/:planet/posts/:publicationId/comments/:id', 'comment#delete', 'planets.posts.comments.delete');

Router::post('/posts/:publicationId/stardust' , 'stardust#create');
Router::delete('/posts/:publicationId/stardust' , 'stardust#delete');
Router::get('/posts/:publicationId/stardust' , 'stardust#list');
Router::get('/posts/:publicationId/stardust/exist' , 'stardust#exist');

Router::post('/riddles', 'riddle#create', 'riddle.create');
Router::get('/riddles', 'riddle#list', 'riddle.list');
Router::patch('/riddles/:id', 'riddle#update', 'riddle.update');
Router::delete('/riddles/:id', 'riddle#delete', 'riddle.delete');

Router::post('/titles', 'title#create');
Router::get('/titles', 'title#list');
Router::patch('/titles/:id', 'title#update');
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
