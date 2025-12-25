<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
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
    <h2>Add New Book</h2>

    <form method="POST" action="/books/create">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="number" name="year" placeholder="Year" required>

        <button type="submit">Save Book</button>
    </form>
</div>

</body>
</html>
