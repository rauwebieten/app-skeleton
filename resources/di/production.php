<?php

namespace resources\di;

use App\App;
use App\Handlers\ErrorHandler;
use App\Handlers\NotFoundHandler;
use App\Handlers\PhpErrorHandler;
use App\Http\Controller\Documentation;
use App\Http\Controller\Homepage;
use App\LoggerFactory;
use Noodlehaus\Config;
use Psr\Log\LoggerInterface;
use Slim\Http\Uri;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PlainTextHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
use function DI\autowire;
use function DI\create;
use function DI\factory;
use function DI\get;
use function DI\string;

return [
    // override slim settings
    'settings.addContentLengthHeader' => true,
    'settings.routerCacheFile' => string('{application.path}/storage/cache/slim/router.cache.php'),

    // path, inserted by bootstrap
    'application.path' => '',

    // config
    Config::class => autowire()
        ->constructor(string('{application.path}/resources/config')),

    // slim app
    App::class => factory([App::class, 'factory']),

    // twig / twig-view for slim app

    'uri' => factory([Uri::class, 'createFromEnvironment'])
        ->parameter(0, get('environment')),

    TwigExtension::class => autowire()
        ->constructor(get('router'), get('uri')),

    Twig::class => autowire()
        ->constructor(
            string('{application.path}/resources/templates'),
            [
                'debug' => false,
                'cache' => string('{application.path}/storage/cache/twig'),
                'auto_reload' => false,
            ])
        ->method('addExtension', get(TwigExtension::class)),

    // controller classes
    Homepage::class => autowire(),
    Documentation::class => autowire(),

    // logger
    LoggerInterface::class => factory(LoggerFactory::class),

    // overwrite slim error handlers
    'notFoundHandler' => autowire(NotFoundHandler::class),
    'errorHandler' => autowire(ErrorHandler::class),
    'phpErrorHandler' => autowire(PhpErrorHandler::class),

    // whoops error handler
    Run::class => autowire(Run::class)
        ->method('pushHandler', create(PlainTextHandler::class))
        ->method('pushHandler', create(JsonResponseHandler::class))
        ->method('pushHandler', create(PrettyPageHandler::class)),
];