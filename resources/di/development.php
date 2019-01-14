<?php

namespace resources\di;

use App\DebugBarFactory;
use RauweBieten\TwigStringyExtension;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use function DI\autowire;
use function DI\create;
use function DI\factory;
use function DI\get;
use function DI\string;

return [
    // override slim settings
    'settings.addContentLengthHeader' => false,
    'settings.routerCacheFile' => false,

    // tracy debugbar
    'settings.tracy' => require __DIR__ . '/nette-debugbar.php',
    'debug_bar_factory' => factory(DebugBarFactory::class),

    'twig_profile' => get(\Twig_Profiler_Profile::class),
    \Twig_Extension_Profiler::class => autowire()
        ->constructor(get('twig_profile')),

    Twig::class => autowire()
        ->constructor(
            string('{application.path}/resources/templates'),
            [
                'debug' => true,
                'cache' => string('{application.path}/storage/cache/twig'),
                'auto_reload' => true,
            ])
        ->method('addExtension', get(TwigExtension::class))
        ->method('addExtension', get(\Twig_Extension_Profiler::class))
        ->method('addExtension', create(\Twig_Extension_Debug::class))
        ->method('addExtension', get(TwigStringyExtension::class)),
];