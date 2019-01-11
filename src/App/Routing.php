<?php


namespace App;


class Routing
{
    public function setRoutes(App $app)
    {
        $app->get('/', function() {
            echo 'ok';
        });
    }
}