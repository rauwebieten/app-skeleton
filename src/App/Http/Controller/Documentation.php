<?php

namespace App\Http\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class Documentation extends Base
{
    public function __invoke(Request $request, Response $response)
    {
        return $this->view->render($response, 'homepage.html.twig');
    }
}