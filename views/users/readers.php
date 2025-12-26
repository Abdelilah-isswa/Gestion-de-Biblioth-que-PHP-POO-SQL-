<h2>👥 Readers List</h2>

<?php if (empty($readers)): ?>
    <p>No readers found.</p>
<?php else: ?>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
        </tr>

        <?php foreach ($readers as $reader): ?>
            <tr>
                <td><?= $reader['id'] ?></td>
                <td><?= htmlspecialchars($reader['firstName']) ?></td>
                <td><?= htmlspecialchars($reader['lastName']) ?></td>
                <td><?= htmlspecialchars($reader['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<br>
<a href="/dashboard">← Back to dashboard</a>
