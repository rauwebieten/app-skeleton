<?php

namespace App\Http\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Homepage extends Base
{
    public function __invoke(Request $request, Response $response)
    {
        $this->logger->info('Message from ' . __FILE__);
        return $this->view->render($response, 'homepage.html.twig');
    }
}