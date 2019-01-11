<?php


namespace App;

use App\Http\Controller\Homepage;

class Routing
{
    public function setRoutes(App $app)
    {
        $app->get('/', Homepage::class);
    }
}