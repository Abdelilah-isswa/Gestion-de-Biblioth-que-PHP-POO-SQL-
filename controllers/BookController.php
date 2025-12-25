<?php

class BookController
{
    public function index()
    {
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
}
