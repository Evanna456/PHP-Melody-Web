<?php

declare(strict_types=1);

namespace App\Controllers;

require __DIR__ . "/Controller/Controller.php";

use App\Controllers\Controller\Controller;

class PublicController extends Controller
{
    public function index()
    {
        return Controller::view('index.php');
    }

    public function docs()
    {
        return Controller::view('docs.php');
    }

    public function error403()
    {
        return Controller::view('errors/error403.php');
    }
    public function error404()
    {
        return Controller::view('errors/error404.php');
    }
}
