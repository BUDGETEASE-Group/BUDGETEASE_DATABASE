<?php
session_start();
include "config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

// INNER JOIN
$sql = "SELECT transactions.*, categories.Category_Name
        FROM transactions
        INNER JOIN categories
        ON transactions.category_id = categories.category_id
        WHERE transactions.user_id = '$user_id'";

$result = $conn->query($sql);
?>

<h2>Dashboard</h2>
<a href="logout.php">Logout</a>

<table border="1">
<tr>
    <th>Amount</th>
    <th>Type</th>
    <th>Category</th>
    <th>Date</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['amount'] ?></td>
    <td><?= $row['type'] ?></td>
    <td><?= $row['Category_Name'] ?></td>
    <td><?= $row['Date'] ?></td>
</tr>
<?php endwhile; ?>

</table>