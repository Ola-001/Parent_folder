<!DOCTYPE html>
<html>
<head>
    <title>Add Product • Beans & Brew</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1 style="text-align:center; margin-top:40px;">Add New Product</h1>

<form action="insert_product.php" method="POST" style="width:400px; margin:auto;">
    
    <label>Name</label>
    <input type="text" name="name" required>

    <label>Category</label>
    <input type="text" name="category" required>

    <label>Price</label>
    <input type="number" step="0.01" name="price" required>

    <label>Image Path (e.g. img/Espresso.jpg)</label>
    <input type="text" name="image" required>

    <button type="submit" class="btn" style="width:100%; margin-top:10px;">
        Add Product
    </button>

</form>

</body>
</html>
