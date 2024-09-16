<?php

declare(strict_types=1);

use App\Handler\HomeHandler;

use Wr\Kernel\Autoloader;
use Wr\Kernel\Container;

// Configure autoload
require __DIR__ . '/../src/Wr/Kernel/Autoloader.php';

$autoload = new Autoloader();
$autoload->addNamespace('App', __DIR__.'/../src/App/');
$autoload->addNamespace('Wr', __DIR__.'/../src/Wr/');
$autoload->register();

$container = new Container(
    include(__DIR__ . '/../app/config/dependencies.php')
);

$handler = $container->get(HomeHandler::class);
echo $handler->handle();
