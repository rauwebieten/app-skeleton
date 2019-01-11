<?php

require_once __DIR__ . '/../vendor/autoload.php';

$bootstrap = new \App\Bootstrap();
$container = $bootstrap->createContainer();

$app = $container->get(\App\App::class);
$app->run();