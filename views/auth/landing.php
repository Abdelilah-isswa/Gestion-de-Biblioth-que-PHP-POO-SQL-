<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 120px;
            background-color: #f4f6f8;
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            color: #555;
        }

        .buttons {
            margin-top: 30px;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            font-weight: bold;
        }

        a.signup {
            background-color: #28a745;
        }

        a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <h1> Welcome to the Library</h1>
    <p>Please login or create an account to continue</p>

    <div class="buttons">
        <a href="/login">Login</a>
        <a href="/register" class="signup">Sign Up</a>
    </div>

</body>
</html>
