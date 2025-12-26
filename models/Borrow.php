<?php
require_once "../config/Database.php";

class Borrow
{
    public static function create(int $readerId, int $bookId)
    {
        $pdo = Database::connect();

        // Create borrow record
        $stmt = $pdo->prepare("
            INSERT INTO borrows (readerId, bookId, borrowDate)
            VALUES (?, ?, NOW())
        ");
        $stmt->execute([$readerId, $bookId]);

        // Update book status
        $pdo->prepare("
            UPDATE books SET status = 'borrowed'
            WHERE id = ?
        ")->execute([$bookId]);
    }

public static function getByReader($readerId)
{
    $pdo = Database::connect();

    $stmt = $pdo->prepare("
        SELECT 
            borrows.id AS borrow_id,
            books.title,
            books.author,
            borrows.borrowDate,
            borrows.returnDate
        FROM borrows
        JOIN books ON books.id = borrows.bookId
        WHERE borrows.readerId = ?
        ORDER BY borrows.borrowDate DESC
    ");

    $stmt->execute([$readerId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public static function returnBook(int $borrowId): void
    {
        $pdo = Database::connect();

        // Get bookId
        $stmt = $pdo->prepare("SELECT bookId FROM borrows WHERE id = ?");
        $stmt->execute([$borrowId]);
        $borrow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$borrow) return;

        // Mark borrow as returned
        $pdo->prepare("
            UPDATE borrows
            SET returnDate = NOW()
            WHERE id = ?
        ")->execute([$borrowId]);

        // Mark book as available again
        $pdo->prepare("
            UPDATE books SET status = 'available'
            WHERE id = ?
        ")->execute([$borrow['bookId']]);
    }

public static function getAllHistory()
{
    $pdo = Database::connect();

    $sql = "
        SELECT 
            books.title AS book_title,
            users.firstName,
            users.lastName,
            users.email,
            borrows.borrowDate,
            borrows.returnDate
        FROM borrows
        JOIN books ON borrows.bookId = books.id
        JOIN users ON borrows.readerId = users.id
        ORDER BY borrows.borrowDate DESC
    ";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
