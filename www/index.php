<?php
define('ROOT', __DIR__);

require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();

// j'ai mis en get, mais il est possible que vous ayez besoin de post pour certaines routes.
// Il faudra que vous le changiez
// Vous aurez également à en ajouter

$router = new Router($_GET['url']);
$router->get('/', function(){ echo "homepage !"; });
$router->get('/inscription', 'test');
$router->get('/connexion', '' );
$router->get('/:username', 'Account#profil');
$router->get('/:planet/posts/:id', 'Publication#view');
$router->get('/planet/wiki', 'Planet#wiki');
$router->get('/planets', 'Planet#getAllPlanet');
$router->get('/univers', '');
$router->run();
//COMMENT CREER UNE ROUTE :
//EN GET :
// $router->get('/posts/:id', 'CONTROLLER#METHOD' });
//EN POST :
// $router->post('/posts/:id', 'CONTROLLER#METHOD' });
