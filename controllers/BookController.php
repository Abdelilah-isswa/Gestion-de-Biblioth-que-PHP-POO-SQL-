<?php
require_once "../models/Book.php";
class BookController
{

    // delete a book by admin
public function delete()
{
    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: /dashboard");
        exit;
    }

    if (!isset($_POST['id'])) {
        header("Location: /books");
        exit;
    }

    try {
        Book::delete($_POST['id']);
        $_SESSION['success'] = "Book deleted successfully.";
    } catch (PDOException $e) {
        $_SESSION['error'] = "Cannot delete book: it has borrow history.";
    }

    header("Location: /books");
    exit;
}





    public function createForm()
    {
        session_start();

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /dashboard");
            exit;
        }

        require "../views/books/create.php";
    }

    public function store()
    {
        session_start();

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: /dashboard");
            exit;
        }

        $title  = $_POST['title'];
        $author = $_POST['author'];
        $year   = $_POST['year'];

        Book::create($title, $author, $year);

        header("Location: /dashboard");
        exit;
    }

public function index()
{
    session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: /login");
        exit;
    }

    $user = $_SESSION['user'];

    // 🎯 ROLE-BASED BOOK LIST
    if ($user['role'] === 'admin') {
        $books = Book::getAll();          // admin sees everything
    } else {
        $books = Book::getAvailable();   // reader sees only available
    }
    ///

    ////

    require "../views/books/index.php";
}



    public function show()
    {
        require "../views/books/show.php";
    }

    public function dashboard()
    {
        require "../views/books/dashboard.php";
    }


    public function edit()
{
    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: /dashboard");
        exit;
    }

    if (!isset($_GET['id'])) {
        header("Location: /books");
        exit;
    }

    $book = Book::find($_GET['id']);

    if (!$book) {
        header("Location: /books");
        exit;
    }

    require "../views/books/edit.php";
}

public function update()
{
    session_start();

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header("Location: /dashboard");
        exit;
    }

    Book::update(
        $_POST['id'],
        $_POST['title'],
        $_POST['author'],
        $_POST['year']
    );

    $_SESSION['success'] = "Book updated successfully.";
    header("Location: /books");
    exit;
}


}
