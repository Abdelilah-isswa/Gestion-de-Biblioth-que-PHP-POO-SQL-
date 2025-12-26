<?php
require_once "../config/Database.php";

class Book
{
    
    public $id;
    public $title;
    public $author;
    public $year;
    public $status = 'available';

  
 
    public function save()
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO books (title, author, year, status)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $this->title,
            $this->author,
            $this->year,
            $this->status
        ]);
    }

    public function update()
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            UPDATE books
            SET title = ?, author = ?, year = ?, status = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $this->title,
            $this->author,
            $this->year,
            $this->status,
            $this->id
        ]);
    }

    public function isAvailable()
    {
        return $this->status === 'available';
    }

    // ---------- STATIC METHODS (USED BY CONTROLLERS) ----------

    public static function getAll()
    {
        $pdo = Database::connect();
        return $pdo->query("SELECT * FROM books")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAvailable()
    {
        $pdo = Database::connect();
        return $pdo->query("
            SELECT * FROM books WHERE status = 'available'
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($title, $author, $year)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            INSERT INTO books (title, author, year, status)
            VALUES (?, ?, ?, 'available')
        ");

        return $stmt->execute([$title, $author, $year]);
    }

    public static function updateById($id, $title, $author, $year)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("
            UPDATE books
            SET title = ?, author = ?, year = ?
            WHERE id = ?
        ");

        return $stmt->execute([$title, $author, $year, $id]);
    }

    public static function delete($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
