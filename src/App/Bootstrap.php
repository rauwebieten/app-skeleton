<?php

namespace App;

use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

class Bootstrap
{
    private $container;
    private $applicationPath;

    /**
     * @param $applicationPath
     * @return Bootstrap
     * @throws \Exception
     */
    public static function create($applicationPath): self
    {
        return new self($applicationPath);
    }

    /**
     * Bootstrap constructor.
     * @param $applicationPath
     * @throws \Exception
     */
    public function __construct($applicationPath)
    {
        $this->applicationPath = $applicationPath;
        $this
            ->loadEnv()
            ->buildContainer();
    }

    /**
     * @return Bootstrap
     */
    private function loadEnv(): self
    {
        $env = Dotenv::create($this->applicationPath);
        $env->load();
        return $this;
    }

    /**
     * @return Bootstrap
     * @throws \Exception
     */
    private function buildContainer(): self
    {
        $builder = new ContainerBuilder();
        $builder->useAnnotations(true);
        $builder->useAutowiring(true);

        // add definitions
        $builder->addDefinitions((new DI())->getConfig());

        // build the container
        $this->container = $builder->build();
        $this->container->set('application.path', $this->applicationPath);
        return $this;
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}