<?php

class UserController
{
    public function readers()
    {
        session_start();

        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }

        if ($_SESSION['user']['role'] !== 'admin') {
            header("Location: /dashboard");
            exit;
        }

        $readers = User::getReaders();

        require "../views/users/readers.php";
    }
}
