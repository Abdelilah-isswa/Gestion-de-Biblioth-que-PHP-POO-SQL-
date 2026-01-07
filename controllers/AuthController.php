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
            
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['firstName'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            header("Location: /dashboard");
            exit;
        }

       
        $_SESSION['error'] = "Invalid email or password";
        header("Location: /login");
        exit;
    }

  public function register()
{
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $firstName = trim($_POST['firstName']);
        $lastName  = trim($_POST['lastName']);
        $email     = trim($_POST['email']);
        $password  = $_POST['password'];

        
        if (
            empty($firstName) ||
            empty($lastName) ||
            empty($email) ||
            empty($password)
        ) {
            $error = "All fields are required.";
            require "../views/auth/register.php";
            return;
        }

        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email address.";
            require "../views/auth/register.php";
            return;
        }

        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $success = User::create([
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'email'     => $email,
            'password'  => $hashedPassword,
            'role'      => 'reader'
        ]);

        if (!$success) {
            $error = "Email already exists.";
            require "../views/auth/register.php";
            return;
        }

       
        header("Location: /login");
        exit;
    }

    
    require "../views/auth/register.php";
}


    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit;
    }
}
