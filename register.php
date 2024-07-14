<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthday = $_POST['birthday'];

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, birthday) VALUES (?, ?, ?, ?)");
    
    try {
        $stmt->execute([$name, $email, $password, $birthday]);
        $_SESSION['message'] = "Registration successful. Please log in.";
        header("Location: login.php");
        exit();
    } catch(PDOException $e) {
        $error = "Registration failed. Email may already be in use.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="date" name="birthday" required><br>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>