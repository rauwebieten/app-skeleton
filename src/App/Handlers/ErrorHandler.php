<?php

namespace App\Handlers;

use DI\Annotation\Inject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Whoops\Run;

class ErrorHandler
{
    /**
     * @Inject()
     * @var Run
     */
    private $whoops;

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

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, \Exception $exception)
    {
        $debug = filter_var(getenv('DEBUG'), FILTER_VALIDATE_BOOLEAN);

        $this->logger->error($exception->__toString());

        if ($debug) {
            $this->whoops->handleException($exception);
            exit;
        }

        return $this->view->render($response, 'error.html.twig');
    }
}