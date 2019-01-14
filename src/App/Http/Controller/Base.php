<?php

namespace App\Http\Controller;

use DI\Annotation\Inject;
use Noodlehaus\Config;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

abstract class Base
{
    protected $view;
    protected $logger;
    protected $config;

    public function __construct(
        Config $config,
        LoggerInterface $logger,
        Twig $view
    )
    {
        $this->config = $config;
        $this->view = $view;
        $this->logger = $logger;

        $this->view['applicationName'] = $this->config->get('application.name');
        $this->view['applicationContactEmail'] = $this->config->get('application.contact_email');
    }
}