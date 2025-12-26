<?php
session_start();
$user = $_SESSION['user'];
?>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<!-- add to show all bookes that are exist in the admin page when he clickes on the btn -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Books</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 40px;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>

<h2>📚 Books List</h2>

<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Year</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($books as $book): ?>
        <tr>
            <td><?= htmlspecialchars($book['title']) ?></td>
            <td><?= htmlspecialchars($book['author']) ?></td>
            <td><?= $book['year'] ?></td>
            <td><?= $book['status'] ?></td>

            <td>
                <!-- ADMIN ACTIONS -->
                <?php if ($user['role'] === 'admin'): ?>
                    <a href="/books/edit?id=<?= $book['id'] ?>"> Edit</a>

                    <form method="POST" action="/books/delete" style="display:inline">
                        <input type="hidden" name="id" value="<?= $book['id'] ?>">
                        <button type="submit" onclick="return confirm('Delete this book?')">
                            🗑 Delete
                        </button>
                    </form>
                <?php endif; ?>

                <!-- READER ACTION -->
                <?php if ($user['role'] === 'reader' && $book['status'] === 'available'): ?>
                    <form method="POST" action="/borrows/create" style="display:inline">
                        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                        <button type="submit">📖 Borrow</button>
                    </form>
                <?php endif; ?>
                <!--  -->
                




            </td>

        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="/dashboard">← Back to dashboard</a>

</body>
</html>
