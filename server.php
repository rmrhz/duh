<?php

require_once "vendor/autoload.php";

use Phroute\Phroute\RouteCollector;
use Symfony\Component\DependencyInjection\ContainerBuilder;

define('ROOT', dirname(__FILE__));

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Routing Layer
$router = new RouteCollector();

$container = new ContainerBuilder();

$container->register('db', 'DB')
	->setArguments([getenv('DB_HOST', 'localhost'), getenv('DB_NAME', 'duhnews'), getenv('DB_USER', 'root'), getenv('DB_PASS', '')]);
$container->register('resolver', 'News\Core\Routing\HandlerResolver')
	->addArgument($container);
$container->register('twig_filesystem', 'Twig_Loader_Filesystem')
	->addArgument(ROOT . '/resources/templates');
$container->register('twig', 'Twig_Environment')
	->addArgument($container->get('twig_filesystem'))
	->addArgument([
		'debug' => true,
		'cache' => ROOT . '/cache/templates'
	]);

$router->get('/', ['News\Platform', 'getIndex']);
$router->get('/create', ['News\Platform', 'getAddBulletin']);
$router->post('/create', ['News\Platform', 'postAddBulletin']);
$router->get('/{bulletin_id}/remove', ['News\Platform', 'getRemoveBulletin']);
$router->get('/{bulletin_id}', ['News\Platform', 'getViewBulletin']);
$router->get('/{bulletin_id}/comments', ['News\Platform', 'getBulletinComments']);
$router->get('/{bulletin_id}/comments/create', ['News\Platform', 'getAddBulletinComment']);
$router->post('/{bulletin_id}/comments/create', ['News\Platform', 'postAddBulletinComment']);
$router->get('/{bulletin_id}/comments/{bulletin_comment_id}/remove', ['News\Platform', 'getRemoveBulletinComment']);
