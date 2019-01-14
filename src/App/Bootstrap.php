<?php

namespace App;

use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;
use Tracy\Debugger;

class Bootstrap
{
    private $container;
    private $applicationPath;

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
     * @throws \Exception
     */
    private function buildContainer(): self
    {
        $debug = filter_var(getenv('DEBUG'), FILTER_VALIDATE_BOOLEAN);

        $builder = new ContainerBuilder();
        $builder->useAnnotations(true);
        $builder->useAutowiring(true);

        // add app definitions
        $builder->addDefinitions($this->applicationPath.'/vendor/php-di/slim-bridge/src/config.php');
        $builder->addDefinitions($this->applicationPath.'/resources/di/production.php');
        if ($debug) {
            $builder->addDefinitions($this->applicationPath.'/resources/di/development.php');
        }

        // build the container
        $this->container = $builder->build();
        $this->container->set('application.path', $this->applicationPath);

        if ($this->container->has('debug_bar_factory')) {
            $this->container->get('debug_bar_factory');
        }

        return $this;
    }

    /**
     * @return Bootstrap
     */
    private function loadEnv(): self
    {
        $dotenv = Dotenv::create($this->applicationPath);
        $dotenv->load();
        $dotenv->required('DEBUG')->isBoolean();
        return $this;
    }

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
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}