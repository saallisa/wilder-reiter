<?php

declare(strict_types=1);

namespace App\Handler;

use Wr\Kernel\View;

/**
 * Handles a request to show the home page.
 */
class HomeHandler
{
    public function __construct(
        private readonly View $view
    ) {}

    /**
     * Handles a request and produces a response.
     */
    public function handle(): string {
        return $this->view->render('home');
    }
}