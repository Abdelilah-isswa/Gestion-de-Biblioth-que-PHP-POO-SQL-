<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 40px;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="box">
        <h1>Welcome <?= htmlspecialchars($user['name']) ?> </h1>

        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Role:</strong> <?= htmlspecialchars($user['role']) ?></p>
        <?php if ($user['role'] === 'admin'): ?>
            <a href="/books/create">➕ Add Book </a><br>
            <a href="/books">📚 View All Books</a><br>

             <br><br>

    <a href="/users/readers" style="
        display:inline-block;
        padding:10px 15px;
        background:#6f42c1;
        color:#fff;
        text-decoration:none;
        border-radius:5px;
    ">
         View Readers
    </a>

     <br><br>
     <a href="/borrows/history">
    <button>Borrow History</button>
</a>



        <?php endif; ?>





        <?php if ($user['role'] === 'reader'): ?>

            <a href="/books"> View Books</a><br>
                <br><br>

    <a href="/borrows/my" style="
        display:inline-block;
        padding:10px 15px;
        background:#28a745;
        color:#fff;
        text-decoration:none;
        border-radius:5px;
    ">
        📖 My Borrowed Books
    </a>
    <br>
        <?php endif; ?>
        <a href="/logout">Logout</a>
    </div>

</body>

</html>