<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Middleware;

class ManagementController
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
            'title' => 'NCT : Management',
            'active' => 'management',
        ];
        View::render('management/management', $data, 'default');
    }
}
