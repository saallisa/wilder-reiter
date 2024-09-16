<?php

declare(strict_types=1);

use Wr\Kernel\Container;

return [
    \Wr\Kernel\View::class => function(Container $container) {
        return new \Wr\Kernel\View(__DIR__ . '/../views/');
    }
];