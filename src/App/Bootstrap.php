<?php

namespace App;

use DI\Container;
use DI\ContainerBuilder;

class Bootstrap
{
    private $container;

    /**
     * @return Container
     * @throws \Exception
     */
    public function createContainer(): Container
    {
        $builder = new ContainerBuilder();
        $builder->useAnnotations(true);
        $builder->useAutowiring(true);

        // add definitions
        $builder->addDefinitions((new DI())->getConfig());

        // build the container
        $this->container = $builder->build();
        return $this->container;
    }
}