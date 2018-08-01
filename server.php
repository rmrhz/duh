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

// Routing Layer
$router = new RouteCollector();

$container = new ContainerBuilder();
$container->setParameter('container', $container);
$loader = new YamlFileLoader($container, new FileLocator(ROOT));
$loader->load('services.yaml');

$container->compile(true);

foreach(glob(ROOT . '/routes/*.php') as $route) {
    require_once $route;
}
