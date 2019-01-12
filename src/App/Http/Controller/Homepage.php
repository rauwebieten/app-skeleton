<?php

namespace App\Http\Controller;

use DI\Annotation\Inject;
use Psr\Log\LoggerInterface;
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

    /**
     * @Inject()
     * @var LoggerInterface
     */
    private $logger;

    public function __invoke(Request $request, Response $response)
    {
        $this->logger->error('ok ok');
        return $this->view->render($response, 'homepage.html.twig');
    }
}