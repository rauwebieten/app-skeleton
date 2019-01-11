<?php


namespace App;


use Psr\Container\ContainerInterface;

class App extends \Slim\App
{
    public static function factory(ContainerInterface $container)
    {
        $app = new self($container);
        $app->loadRoutes();
        return $app;
    }

    public function loadRoutes()
    {
        (new Routing())->setRoutes($this);
    }
}