<?php
require_once "../models/User.php";
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
        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // SUCCESS LOGIN
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['firstName'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            header("Location: /dashboard");
            exit;
        }

        // FAILED LOGIN
        $_SESSION['error'] = "Invalid email or password";
        header("Location: /login");
        exit;
    }

    public function register()
    {
        echo "Register logic coming soon";
    }

    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit;
    }
}
