<?php

namespace App;

use DI\Annotation\Inject;
use Noodlehaus\Config;
use Slim\Router;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class TwigFactory
{
    /**
     * @Inject()
     * @var Router
     */
    private $router;

    /**
     * @Inject("application.path")
     * @var string
     */
    private $applicationPath;

    public function __invoke()
    {
        throw new \Exception("do not use");

        $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
        $extension = new TwigExtension($this->router, $uri);

        $view = new Twig($this->applicationPath . '/resources/templates', [
            'cache' => $this->applicationPath . '/storage/cache/twig',
            'auto_reload' => true,
        ]);
        $view->addExtension($extension);

        return $view;
    }
}