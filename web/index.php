<?php

declare(strict_types=1);

use Wr\Kernel\Autoloader;

// Configure autoload
require __DIR__ . '/../src/Wr/Kernel/Autoloader.php';

$autoload = new Autoloader();
$autoload->addNamespace('App', __DIR__.'/../src/App/');
$autoload->addNamespace('Wr', __DIR__.'/../src/Wr/');
$autoload->register();

