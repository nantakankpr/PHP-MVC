<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Helpers\Helper;
use App\Helpers\Middleware;

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        
        if (Middleware::checkAuth()) {
            header('Location: /dashboard');
        }
        $csrfToken = Middleware::generateCsrfToken();
        $data = [
            'title' => 'NCT-BOT : LOGIN',
            'content' => 'Welcome to the home page!',
            'csrf_token' => $csrfToken
        ];
        View::render('auth/login', $data, 'login');
    }


    public function login()
    {
        $username = Helper::sanitizeInput($_POST['username']);
        $password = Helper::sanitizeInput($_POST['password']);

        //check CSRF token
        if (!Middleware::validateCsrfToken($_POST['csrf_token'])) {
            header('Location: /login');
            exit();
        }
        //after validation remove CSRF token from session
        unset($_SESSION['csrf_token']);

        $user = $this->userModel->authenticate($username, $password);
        if ($user) {
            unset($user['password']);
            $_SESSION['user'] = $user;
            View::response(200, 'Login Successful');
        } else {
            View::response(401, 'Invalid username or password');
        }
    }

    public function addMember()
    {
        // if (!Middleware::checkAdmin()) {
        //     View::response(403, 'Permission is not allowed');
        // }
        $username = Helper::sanitizeInput($_POST['username']);
        $password = Helper::sanitizeInput($_POST['password']);
        $roleId = Helper::sanitizeInput($_POST['roleId']);

        //check duplicates
        $user = $this->userModel->getMemberByUsername($username);
        if ($user) {
            View::response(400, 'Username already exists');
        }
        $resCreateMember = $this->userModel->createMember($username, $password, $roleId);
        if ($resCreateMember) {
            View::response(200, 'Successfully added member.');
        } else {
            View::response(400, 'Failed to add member. Please try again.');
        }
    }

    public function logout()
    {
        if (!Middleware::checkAuth()) {
            View::response(403, 'Unauthorized');
        }
        session_start();
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
