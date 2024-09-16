<?php

declare(strict_types=1);

use Wr\Kernel\Autoloader;
use Wr\Kernel\Container;
use Wr\Kernel\View;

// Configure autoload
require __DIR__ . '/../src/Wr/Kernel/Autoloader.php';

$autoload = new Autoloader();
$autoload->addNamespace('App', __DIR__.'/../src/App/');
$autoload->addNamespace('Wr', __DIR__.'/../src/Wr/');
$autoload->register();

$container = new Container(
    include(__DIR__ . '/../app/config/dependencies.php')
);

$view = $container->get(View::class);
echo $view->render('home');