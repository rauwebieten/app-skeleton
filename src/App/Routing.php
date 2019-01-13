<?php

namespace App;

use App\Http\Controller\Documentation;
use App\Http\Controller\Homepage;

class Routing
{
    public function setRoutes(App $app)
    {
        $app->get('/', Homepage::class)->setName('homepage');
        $app->get('/documentation', Documentation::class)->setName('documentation');
    }
}