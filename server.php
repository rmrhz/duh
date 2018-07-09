<?php

require_once "vendor/autoload.php";

use Phroute\Phroute\RouteCollector;
use Illuminate\Database\Capsule\Manager as Capsule;  

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// Routing Layer
$router = new RouteCollector();
