<?php
require_once "../models/Borrow.php";
class BorrowController
{
        public function store()
    {
        session_start();

    
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'reader') {
            header("Location: /dashboard");
            exit;
        }

        if (!isset($_POST['book_id'])) {
            header("Location: /books");
            exit;
        }

        Borrow::create($_SESSION['user']['id'], $_POST['book_id']);

        header("Location: /books");
        exit;
    }


    public function borrow()
    {
  
        header("Location: /my-borrows");
        exit;
    }

    public function myBorrows()
    {
          session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }

    if ($_SESSION['user']['role'] !== 'reader') {
        header("Location: /dashboard");
        exit;
    }

    $user = $_SESSION['user'];

    $borrows = Borrow::getByReader($user['id']);
        require "../views/borrows/my_borrows.php";
    }

public function returnBook()
{
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }

    if ($_SESSION['user']['role'] !== 'reader') {
        header("Location: /dashboard");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: /borrows/my");
        exit;
    }

    $borrowId = $_POST['borrow_id'];
    $readerId = $_SESSION['user']['id'];

    Borrow::returnBook($borrowId, $readerId);

    header("Location: /borrows/my");
    exit;
}


    public function history()
    {
        session_start();

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /dashboard");
            exit;
        }

        $borrows = Borrow::getAllHistory();

        require "../views/borrows/history.php";
    }


}
