<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Middleware;

class ServiceController
{
    public function __construct()
    {
        if (!Middleware::checkAuth()) {
            header('Location: /login');
        }
    }
    public function index()
    {
        $data = [
            'title' => 'NCT : Services',
            'active' => 'service',
        ];
        View::render('service/service', $data, 'default');
    }
}
