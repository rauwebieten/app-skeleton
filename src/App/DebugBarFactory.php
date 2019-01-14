<?php

namespace App;

use DI\Annotation\Inject;
use RunTracy\Middlewares\TracyMiddleware;
use Tracy\Debugger;

class DebugBarFactory
{
    /**
     * @Inject()
     * @var App
     */
    private $app;

    public function __invoke()
    {
        Debugger::enable(Debugger::DEVELOPMENT, 'C:\Users\Peter\PhpstormProjects\app-skeleton\storage\logs');
        $this->app->add(new TracyMiddleware($this->app));
    }
}