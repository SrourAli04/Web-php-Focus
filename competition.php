<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$birthday = new DateTime($_SESSION['user_birthday']);
$now = new DateTime();
$age = $birthday->diff($now)->y;

if ($age < 18) {
    echo "You must be 18 or older to access this page.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Competition</title>
</head>
<body>
    <h2>Competition Page</h2>
    <p>Welcome to the competition! This content is only for users 18 and older.</p>
    <a href="home.php">Back to Home</a>
</body>
</html>