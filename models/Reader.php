<?php 
require_once 'AbstractUser.php';
require_once 'Borrow.php';
class reader extends AbstractUser{

    public function borrowBook(int $bookId)
    {
        return Borrow::create($this->id, $bookId);
    }

    public function returnBook(int $borrowId): void
    {
        Borrow::returnBook($borrowId);
    }
}