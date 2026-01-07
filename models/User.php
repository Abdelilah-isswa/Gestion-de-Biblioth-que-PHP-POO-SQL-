<?php
require_once "../config/Database.php";

class User
{
    public static function findByEmail($email)
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public static function create($data)
{
    $pdo = Database::connect();

    try {
        $stmt = $pdo->prepare("
            INSERT INTO users (firstName, lastName, email, password, role)
            VALUES (?, ?, ?, ?, ?)
        ");

        return $stmt->execute([
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['password'],
            $data['role']
        ]);
    } catch (PDOException $e) {
        return false; 
    }
}

public static function getReaders()
{
    $pdo = Database::connect();

    $stmt = $pdo->query("
        SELECT id, firstName, lastName, email
        FROM users
        WHERE role = 'reader'
        ORDER BY firstName
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}
