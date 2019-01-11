<?php

namespace App\Http\Controller;

use DI\Annotation\Inject;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class Homepage
{
    /**
     * @Inject()
     * @var Twig
     */
    private $view;

    public function __invoke(Request $request, Response $response)
    {
        return $this->view->render($response, 'homepage.html.twig');
    }
}