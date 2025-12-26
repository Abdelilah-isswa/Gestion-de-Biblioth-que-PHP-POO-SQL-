<h2>📖 My Borrowed Books</h2>

<?php if (empty($borrows)): ?>
    <p>You have not borrowed any books yet.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
        </tr>

        <?php foreach ($borrows as $borrow): ?>
            <tr>
                <td><?= htmlspecialchars($borrow['title']) ?></td>
                <td><?= htmlspecialchars($borrow['author']) ?></td>
                <td><?= $borrow['borrowDate'] ?></td>
                <td><?= $borrow['returnDate'] ?? 'Not returned' ?></td>


                      <td>
                <?php if ($borrow['returnDate'] === null): ?>
                    <form method="POST" action="/borrows/return">
                        <input type="hidden" name="borrow_id" value="<?= $borrow['borrow_id'] ?>">
                        <button type="submit">🔁 Return</button>
                    </form>
                <?php else: ?>
                    —
                <?php endif; ?>
            </td>

            
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<br>
<a href="/dashboard">← Back to dashboard</a>
