<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Middleware;

class DashboardController
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
            'title' => 'NCT : Dashboard',
            'active' => 'dashboard',
        ];
        View::render('dashboard/dashboard', $data, 'default');
    }
}
