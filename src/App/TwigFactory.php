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

    /**
     * @Inject()
     * @var Config
     */
    private $config;

    public function __invoke()
    {
        $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
        $extension = new TwigExtension($this->router, $uri);

        $templatePath = $this->applicationPath . '/resources/templates';
        $view = new Twig($templatePath, [
            'cache' => $this->applicationPath . '/storage/cache/twig',
            'auto_reload' => true,
        ]);
        $view->addExtension($extension);

        $view->getEnvironment()->addGlobal('applicationName', $this->config->get('application.name'));

        return $view;
    }
}