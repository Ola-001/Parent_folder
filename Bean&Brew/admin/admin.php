<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 1) {
    die("Access denied.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin • Beans & Brew</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1 style="text-align:center; margin-top:40px;">Admin Panel</h1>

<div style="text-align:center; margin-bottom:20px;">
    <a href="add_product.php" class="btn" style="padding:10px 20px;">Add New Product</a>
</div>

<table style="width:80%; margin:auto; border-collapse:collapse;">
    <tr style="background:#2f1b0c; color:white;">
        <th style="padding:10px;">ID</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM products");
    while ($row = $result->fetch_assoc()):
    ?>
    <tr style="text-align:center; border-bottom:1px solid #ccc;">
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['category'] ?></td>
        <td>£<?= $row['price'] ?></td>
        <td><img src="<?= $row['image'] ?>" width="60"></td>
        <td>
            <a href="delete_product.php?id=<?= $row['id'] ?>" 
               style="color:red; font-weight:bold;">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
