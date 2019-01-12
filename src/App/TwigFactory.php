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

    public function __invoke()
    {
        $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
        $extension = new TwigExtension($this->router, $uri);

        $templatePath = __DIR__.'/../../resources/templates';
        $view = new Twig($templatePath);
        $view->addExtension($extension);

        return $view;
    }
}