<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f8;
            padding: 40px;
        }
        .box {
            background: white;
            padding: 30px;
            max-width: 400px;
            margin: auto;
            border-radius: 8px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Edit Book</h2>

    <form method="POST" action="/books/update">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">

        <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
        <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
        <input type="number" name="year" value="<?= $book['year'] ?>" required>

        <button type="submit">Update Book</button>
    </form>
</div>

</body>
</html>
