<!DOCTYPE html>
<html>
<head>
    <title>Borrow History</title>
</head>
<body>

<h2>📚 Borrowing History</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Book</th>
        <th>Reader</th>
        <th>Email</th>
        <th>Borrow Date</th>
        <th>Return Date</th>
    </tr>

    <?php foreach ($borrows as $b): ?>
        <tr>
            <td><?= htmlspecialchars($b['book_title']) ?></td>
            <td><?= htmlspecialchars($b['firstName'] . ' ' . $b['lastName']) ?></td>
            <td><?= htmlspecialchars($b['email']) ?></td>
         <td><?= $b['borrowDate'] ?></td>
<td><?= $b['returnDate'] ?? '❌ Not returned' ?></td>

        </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="/dashboard">← Back to dashboard</a>

</body>
</html>
