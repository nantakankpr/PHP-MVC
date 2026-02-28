<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\Middleware;

class SettingController
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
            'title' => 'NCT : Setting',
            'active' => 'setting',
        ];
        View::render('setting/setting', $data, 'default');
    }
}
