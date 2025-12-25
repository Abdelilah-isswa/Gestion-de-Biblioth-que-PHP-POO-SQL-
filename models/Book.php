<?php
require_once "../config/Database.php";

class Book
{
    public static function create($title, $author, $year)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO books (title, author, year, status)
            VALUES (?, ?, ?, 'available')
        ");

        return $stmt->execute([$title, $author, $year]);
    }


    public static function all()
{
    $pdo = Database::connect();

    $stmt = $pdo->query("SELECT * FROM books ORDER BY id DESC");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function delete($id)
{
    $pdo = Database::connect();

    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    return $stmt->execute([$id]);
}


}
