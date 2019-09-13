<?php

require_once dirname(dirname(__FILE__)) . "/server.php";

$dispatcher = $container->get('app.routing.dispatcher');
$dispatcher->resolve()->send();
