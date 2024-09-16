<?php

declare(strict_types=1);

use Wr\Kernel\Container;

return [
    // Kernel classes
    \Wr\Kernel\View::class => function(Container $container) {
        return new \Wr\Kernel\View(__DIR__ . '/../views/');
    },
    // Request Handler classes
    \App\Handler\HomeHandler::class => function(Container $container) {
        return new \App\Handler\HomeHandler(
            $container->get(\Wr\Kernel\View::class)
        );
    }
];