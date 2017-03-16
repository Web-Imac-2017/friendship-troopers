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

Router::post('api/auth/signin','account#inscription');
Router::post('api/auth/signin/username','account#isUsernameFree', 'users.me.usernameFree');
Router::post('api/auth/signin/mail','account#isMailFree', 'users.me.mailFree');
Router::post('api/auth/login','account#login','user.login');
Router::post('api/auth/logout','account#logout','user.logout');
Router::get('api/auth/validate','account#validateUser', 'auth.validate'); //ok


Router::get('api/users/search','account#search', 'users.search');
Router::get('api/users/list','user#usersList', 'users.list'); //ok. prend comme param planetId ou role (l'id)
Router::get('api/users/me','account#getCurrentUser', 'users.me');
Router::patch('api/users/me','account#updateAccountInfos', 'users.me.update');
Router::delete('api/users/me','account#delete', 'users.me.delete');
Router::post('api/users/password','account#lostPassword', 'users.me.lostPassword');
Router::post('api/users/password/new','account#setNewPassword', 'users.me.newPassword');

Router::get('api/users/me/avatars','avatar#listUserAvatar', 'users.me.listAvatar');
Router::patch('api/users/me/avatars/:avatarId/current','avatar#setCurrentAvatar', 'users.me.setCurrentAvatar');

Router::get('api/users/me/waiting_list_friend','friend#invitationList', 'users.me.invitationList'); //ok
Router::get('api/users/me/friends','friend#listFriend', 'users.me.listUserFriend'); //ok

Router::post('api/users/me/interest/add_interest','interest#addUserInterest', 'users.me.updateUserInterest');
Router::post('api/users/me/interest/delete_interest','interest#delete_interest', 'users.me.updateUserInterest');

Router::post('api/users/:userId/user_title','user_title#add');
Router::get('api/users/:userId/user_title/list','user_title#list');
Router::get('api/users/:userId/user_title/current_title','user_title#viewCurrent');
Router::get('/users/:userId/user_title/count','user_title#count');
Router::patch('/users/:userId/user_title/set_current/:titleId','user_title#setCurrent');
Router::delete('/users/:userId/user_title/:titleId','user_title#delete');




Router::get('api/users/:userId','account#getUser', 'users.profil');
Router::post('api/users/:userId/add_friend','friend#addFriend', 'users.me.addFriend'); //ok
Router::patch('api/users/:userId/confirm_friend','friend#confirmFriend', 'users.me.confirmFriend'); //ok
Router::delete('api/users/:userId/delete_friend','friend#deleteFriend', 'users.me.deleteFriend'); //same route for rejecting a friend //ok
Router::get('api/users/:userId/friends','friend#listFriend', 'users.me.listFriend'); //ok
Router::get('api/users/:userId/number_friends','friend#countFriend', 'users.me.countFriend'); //ok

Router::get('api/users/:userId/interest','interest#listUserInterest', 'users.me.listInterest');

Router::post('api/avatar','avatar#create', 'avatar.create');
Router::patch('api/avatar/:id','avatar#update', 'avatar.update');

Router::post('api/interest/add' , 'interest#addInterest','interest.add');
Router::get('api/interest/view','interest#listInterest', 'interest.list');
Router::post('api/interest/delete','interest#deleteInterest','interest.delete');
Router::post('api/user/:userId/interests' , 'interest#WelcomeOnBoard','interest.WelcomeOnBoard');

Router::get('api/planets', 'planet#list');
Router::post('api/planets', 'planet#create');
Router::delete('api/planets/:planet', 'planet#delete');

Router::post('api/planets/:planet/posts', 'publication#create', 'planets.posts.create');
Router::get('api/planets/:planet/posts', 'publication#list', 'planets.posts.list');
Router::get('api/planets/:planet/posts/count', 'publication#count', 'planets.posts.count');

Router::patch('api/planets/:planet/posts/:id', 'publication#update', 'planets.posts.update');
Router::delete('api/planets/:planet/posts/:id', 'publication#delete', 'planets.posts.delete');

Router::post('api/planets/:planet/posts/:publicationId/comments', 'comment#create', 'planets.posts.comments.create');
Router::get('api/planets/:planet/posts/:publicationId/comments', 'comment#list', 'planets.posts.comments.list');
Router::get('api/planets/:planet/posts/:publicationId/comments/count', 'comment#count', 'planets.posts.comments.count');
Router::patch('api/planets/:planet/posts/:publicationId/comments/:id', 'comment#update', 'planets.posts.comments.update');
Router::delete('api/planets/:planet/posts/:publicationId/comments/:id', 'comment#delete', 'planets.posts.comments.delete');

Router::post('api/posts/:publicationId/stardust' , 'stardust#create');
Router::delete('api/posts/:publicationId/stardust' , 'stardust#delete');
Router::get('api/posts/:publicationId/stardust' , 'stardust#list');
Router::get('api/posts/:publicationId/stardust/exist' , 'stardust#exist');

Router::post('api/riddles', 'riddle#create', 'riddle.create');
Router::get('api/riddles', 'riddle#list', 'riddle.list');
Router::patch('api/riddles/:id', 'riddle#update', 'riddle.update');
Router::delete('api/riddles/:id', 'riddle#delete', 'riddle.delete');

Router::post('api/titles', 'title#create');
Router::get('api/titles', 'title#list');
Router::patch(api'/titles/:id', 'title#update');
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
