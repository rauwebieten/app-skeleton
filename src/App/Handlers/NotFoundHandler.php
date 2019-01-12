<?php

namespace App\Handlers;

use DI\Annotation\Inject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class NotFoundHandler
{
    /**
     * @Inject()
     * @var Twig
     */
    private $view;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response = $response->withStatus(404);
        return $this->view->render($response, 'not-found.html.twig');
    }
}