<?php

namespace App;

use DI\Annotation\Inject;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LoggerFactory
{

    /**
     * @Inject("application.path")
     * @var string
     */
    private $applicationPath;

    /**
     * @throws \Exception
     */
    public function __invoke()
    {
        $logger = new Logger('app');

        // error handler
        $path = $this->applicationPath . '/storage/logs/error.log';
        $handler = new RotatingFileHandler($path, 0, Logger::ERROR);
        $logger->pushHandler($handler);

        return $logger;
    }
}