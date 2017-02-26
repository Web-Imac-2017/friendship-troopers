<?php

define('ROOT', __DIR__);

if ($_GET['url'] === 'favicon.ico') {
  http_response_code(404);
  exit();
}

require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();

// j'ai mis en get, mais il est possible que vous ayez besoin de post pour certaines routes.
// Il faudra que vous le changiez
// Vous aurez également à en ajouter

$router = new Utils\Router\Router($_GET['url']);
$router->get('/', function(){ echo "homepage !"; });
$router->get('/inscription', 'test');
$router->get('/connexion', '' );
$router->get('/:username', 'Account#profil');
$router->get('/:planet/posts/:id', 'Publication#view');
$router->get('/planet/wiki', 'Planet#wiki');
$router->get('/planets', 'Planet#getAllPlanet');
$router->get('/univers', '');
$router->post('/connexion','CONTROLLER#FONCTION');
$router->run();

//COMMENT CREER UNE ROUTE :
//EN GET :
// $router->get('/posts/:id', 'CONTROLLER#METHOD' });
//EN POST :
// $router->post('/posts/:id', 'CONTROLLER#METHOD' });

//session_start();
//$userId = $_SESSION['user'] = new Models\user(['id' => 1]);
$publication = new \Controllers\Publication();
$title = 'Cyril';
$content = 'super content';
$imgPath = 'test.jpg';
$publicationType = 3;
$userId = 3;

//$publication->create($title, $content, $publicationType, $userId);
//$publication->delete(2);
//$publication->update($title, $content, 2);
