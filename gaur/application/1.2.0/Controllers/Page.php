<?php

declare(strict_types=1);

namespace App\Controllers;

use Config\Services;
use Gaur\Controller;

class Page extends Controller
{
    /**
     * Default page for this controller
     *
     * @return void
     */
    protected function index(): void
    {
        $view = implode('/', Services::URI()->getSegments());

        echo view('app/default/pages/' . $view);
    }
}
