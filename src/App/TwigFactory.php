<?php

namespace App;

use DI\Annotation\Inject;
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
        $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
        $extension = new TwigExtension($this->router, $uri);

        $templatePath = $this->applicationPath . '/resources/templates';
        $view = new Twig($templatePath,[
            'cache' => $this->applicationPath.'/storage/cache/twig',
            'auto_reload' => true,
        ]);
        $view->addExtension($extension);

        return $view;
    }
}