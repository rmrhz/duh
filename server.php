<?php

require_once "vendor/autoload.php";

use Phroute\Phroute\RouteCollector;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Dotenv\Dotenv;

define('ROOT', dirname(__FILE__));

$dotenv = new Dotenv;
$dotenv->load(ROOT . '/.env');

$locator = new FileLocator(ROOT . '/config');

// Routing Layer
$router = new RouteCollector();

$container = new ContainerBuilder();
$container->setParameter('container', $container);
$container->setParameter('root_dir', ROOT);

$loader = new YamlFileLoader($container, $locator);
$loader->load('services.yaml');

$container->compile(true);

foreach(glob(ROOT . '/routes/*.php') as $route) {
    require_once $route;
}
