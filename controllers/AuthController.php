<?php

class AuthController
{
    public function landing()
    {
        require "../views/auth/landing.php";
    }

    public function loginForm()
    {
        require "../views/auth/login.php";
    }

    public function registerForm()
    {
        require "../views/auth/register.php";
    }

    public function login()
    {
        // login logic
    }

    public function register()
    {
        // register logic
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit;
    }
}
