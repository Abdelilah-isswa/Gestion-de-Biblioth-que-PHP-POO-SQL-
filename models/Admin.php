<?php

require_once 'AbstractUser.php';
require_once 'Book.php';
class Admin extends AbstractUser{
    public function addBook(Book $book):void{
        $book->save();

    }
    public function updateBook(Book $book):void{
        $book->update();

    }
    public function deleteBook(int $id):void{
        Book::delete($id);

    }



}