<?php

class BorrowController
{
    public function borrow()
    {
        // borrow logic
        header("Location: /my-borrows");
        exit;
    }

    public function myBorrows()
    {
        require "../views/borrows/my_borrows.php";
    }
}
