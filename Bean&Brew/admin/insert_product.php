<?php
include "db.php";

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$image = $_POST['image'];

$stmt = $conn->prepare("INSERT INTO products (name, category, price, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssds", $name, $category, $price, $image);
$stmt->execute();

header("Location: admin.php");
exit;
?>
