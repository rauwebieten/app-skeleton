<?php

require_once __DIR__ . '/../vendor/autoload.php';

\App\Bootstrap::create('..')
    ->getContainer()
    ->get(\App\App::class)
    ->run();