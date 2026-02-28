<?php

namespace App\Helpers;

class Middleware
{

    //check if user is logged in
    public static function checkAuth()
    {
        return isset($_SESSION['user']);
    }

    //check if user is admin
    public static function checkAdmin()
    {
        return isset($_SESSION['user']['roleId']) && $_SESSION['user']['roleId'] !== 0;
    }

    public static function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateCsrfToken($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
