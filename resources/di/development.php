<?php

namespace resources\di;

use App\DebugBarFactory;
use function DI\factory;

return [
    // override slim settings
    'settings.addContentLengthHeader' => false,
    'settings.routerCacheFile' => false,

    // tracy debugbar
    'settings.tracy' => require __DIR__ . '/nette-debugbar.php',
    'debug_bar_factory' => factory(DebugBarFactory::class),
];