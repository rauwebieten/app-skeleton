<?php

namespace resources\di;

return [
    'showPhpInfoPanel' => 1,
    'showSlimRouterPanel' => 1,
    'showSlimEnvironmentPanel' => 1,
    'showSlimRequestPanel' => 1,
    'showSlimResponsePanel' => 1,
    'showSlimContainer' => 1,
    'showTwigPanel' => 1,
//    'showEloquentORMPanel' => 0,
//    'showIdiormPanel' => 0,
//    'showDoctrinePanel' => 'em',
//    'showProfilerPanel' => 0,
//    'showVendorVersionsPanel' => 0,
//    'showXDebugHelper' => 0,
//    'showIncludedFiles' => 0,
//    'showConsolePanel' => 0,
    'configs' => [
        // XDebugger IDE key
        'XDebugHelperIDEKey' => 'PHPSTORM',
        // Disable login (don't ask for credentials, be careful) values( 1 || 0 )
        'ConsoleNoLogin' => 0,
        // Multi-user credentials values( ['user1' => 'password1', 'user2' => 'password2'] )
        'ConsoleAccounts' => [
            'dev' => '34c6fceca75e456f25e7e99531e2425c6c1de443'// = sha1('dev')
        ],
        // Password hash algorithm (password must be hashed) values('md5', 'sha256' ...)
        'ConsoleHashAlgorithm' => 'sha1',
        // Home directory (multi-user mode supported) values ( var || array )
        // '' || '/tmp' || ['user1' => '/home/user1', 'user2' => '/home/user2']
        'ConsoleHomeDirectory' => '',
        // terminal.js full URI
        'ConsoleTerminalJs' => '/assets/js/jquery.terminal.min.js',
        // terminal.css full URI
        'ConsoleTerminalCss' => '/assets/css/jquery.terminal.min.css',
        'ProfilerPanel' => [
            // Memory usage 'primaryValue' set as Profiler::enable() or Profiler::enable(1)
//                    'primaryValue' =>                   'effective',    // or 'absolute'
            'show' => [
                'memoryUsageChart' => 1, // or false
                'shortProfiles' => true, // or false
                'timeLines' => true // or false
            ]
        ]
    ]
];