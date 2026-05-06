<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$id = $_GET['id'];

// Get current data
$result = $conn->query("SELECT * FROM transactions WHERE transaction_id = '$id'");
$data = $result->fetch_assoc();

// Update
if (isset($_POST['update'])) {
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $date = $_POST['date'];

    $conn->query("UPDATE transactions SET 
        amount='$amount',
        type='$type',
        category_id='$category',
        date='$date'
        WHERE transaction_id='$id'
    ");

    header("Location: dashboard.php");
}
?>

<h2>Edit Transaction</h2>

<form method="POST">
    Amount: <input type="number" name="amount" value="<?= $data['amount'] ?>"><br>

    Type:
    <select name="type">
        <option value="income" <?= $data['type']=='income'?'selected':'' ?>>Income</option>
        <option value="expense" <?= $data['type']=='expense'?'selected':'' ?>>Expense</option>
    </select><br>

    Category:
    <select name="category">
        <?php
        $cat = $conn->query("SELECT * FROM categories");
        while($row = $cat->fetch_assoc()) {
            $selected = ($row['category_id'] == $data['category_id']) ? 'selected' : '';
            echo "<option value='{$row['category_id']}' $selected>{$row['category_name']}</option>";
        }
        ?>
    </select><br>

    Date: <input type="date" name="date" value="<?= $data['date'] ?>"><br>

    <button name="update">Update</button>
</form>