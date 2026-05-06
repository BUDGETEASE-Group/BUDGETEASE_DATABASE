<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_POST['add'])) {
    $user_id = $_SESSION['user_id'];
    $category_id = $_POST['category'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $date = $_POST['date'];

    $sql = "INSERT INTO transactions (user_id, category_id, amount, type, date)
            VALUES ('$user_id', '$category_id', '$amount', '$type', '$date')";

    $conn->query($sql);

    echo "Transaction added!";
}
?>

<h2>Add Transaction</h2>

<form method="POST">
    Amount: <input type="number" name="amount" required><br>
    
    Type:
    <select name="type">
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select><br>

    Category:
    <select name="category">
        <?php
        $cat = $conn->query("SELECT * FROM categories");
        while($row = $cat->fetch_assoc()) {
            echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
        }
        ?>
    </select><br>

    Date: <input type="date" name="date" required><br>

    <button name="add">Add</button>
</form>

<a href="dashboard.php">Back to Dashboard</a>