<?php

require_once "vendor/autoload.php";

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Dotenv\Dotenv;

define('ROOT', dirname(__FILE__));

$dotenv = new Dotenv;
$dotenv->load(ROOT . '/.env');

$locator = new FileLocator(ROOT . '/config');

$container = new ContainerBuilder();
$container->setParameter('container', $container);
$container->setParameter('root.path', ROOT);

$loader = new YamlFileLoader($container, $locator);
$loader->load('services.yaml');

$container->compile(true);
