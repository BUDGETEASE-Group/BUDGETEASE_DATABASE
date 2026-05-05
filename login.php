<?php
session_start();
include "config.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: dashboard.php");
        } else {
            echo "Wrong password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" required><br>
    <input type="password" name="password" required><br>
    <button name="login">Login</button>
</form>