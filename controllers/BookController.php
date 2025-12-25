<!-- Goal:

Start session

Check if user is logged in

If not → redirect to login

If yes → show welcome message -->

<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library</title>
</head>
<body>

<h1>Welcome <?= htmlspecialchars($_SESSION['user']['firstName']) ?></h1>
<p>Role: <?= $_SESSION['user']['role'] ?></p>

<a href="logout.php">Logout</a>

</body>
</html>
