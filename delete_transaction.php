<?php
include "config.php";

$id = $_GET['id'];

$conn->query("DELETE FROM transactions WHERE transaction_id='$id'");

header("Location: dashboard.php");
?>