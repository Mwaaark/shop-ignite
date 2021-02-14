<?php
session_start();
require('../dbconnect.php');

if (!isset($_SESSION['loggedIn'])) {
    header('location: ../login.php');
    exit;
}

if (isset($_POST['add_product'])) {
    $name           = $_POST['product_name'];
    $category_id    = $_POST['product_category'];
    $price          = $_POST['product_price'];
    $quantity       = $_POST['product_quantity'];
    $image_name     = $_FILES['larawan']['name'];
    $tmp_name     = $_FILES['larawan']['tmp_name'];
    $add_query = "INSERT INTO products (name, category_id, price, quantity, image_name) VALUES
        ('$name', $category_id, $price, $quantity, '$image_name')";
    $add_result = mysqli_query($conn, $add_query);
    if ($add_result) {
        move_uploaded_file($tmp_name, '../img/' . $image_name);
        $add_success = true;
    } else {
        $add_failed = false;
    }
}

if (isset($_POST['save'])) {
    $id = $_GET['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image_name  = $_FILES['larawan']['name'];
    $tmp_name    = $_FILES['larawan']['tmp_name'];
    $edit_query = "
        UPDATE
            products
        SET
            name='$name',
            price=$price,
            category_id=$category,
            image_name='$image_name'
        WHERE
            id=$id
        ";
    $edit_result = mysqli_query($conn, $edit_query);
    
    if ($edit_result) {
        move_uploaded_file($tmp_name, '../img/' . $image_name);
        $edit_success = true;
    } else {
        $edit_success = false;
    }
}

$id = $_GET['id'];

$categoryQuery = "SELECT id, name FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);
$view_categoryQuery = "SELECT id, name FROM categories";
$view_categoryResult = mysqli_query($conn, $view_categoryQuery);

$view_query = "
    SELECT
        products.id,
        products.name AS product_name,
        products.price,
        categories.name AS category,
        products.image_name
    FROM
        products,
        categories
    WHERE
        products.category_id = categories.id
    AND
        products.id = $id
    ";
$view_result = mysqli_query($conn, $view_query);
$view_product = mysqli_fetch_assoc($view_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Shop Ignite | Admin View Products</title>
    <link rel="icon" href="../img/shop_ignite_logo.jpg">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-plus"></span> Add new product
                </button>

                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add new product</h4>
                            </div>

                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="text" name="product_name" class="form-control" placeholder="Product Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="product_price" class="form-control" placeholder="Price">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="product_quantity" class="form-control" placeholder="Quantity">
                                    </div>
                                    <div class="form-group">
                                        <select name="product_category" class="form-control">
                                            <option>Choose category...</option>
                                            <?php while($row = mysqli_fetch_assoc($categoryResult)): ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="larawan" class="form-control" required>
                                    </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove"></span> Close
                                </button>
                                <button type="submit" name="add_product" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-plus"></span> Add
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-9">
                <div class="well well-sm"><a href="products.php">View Product</a> / <?= $view_product['product_name']; ?></div>
                <div class="well well-sm">
                    <h2>View Product</h2>
                    <?php if (isset($add_result)): ?>
                        <?php if($add_result): ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong>
                            Product successfully added
                        </div>
                        <?php elseif(!$add_result): ?>
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            Failed to add product
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (isset($edit_success)): ?>
                        <?php if($edit_success): ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong>
                            Product updated
                        </div>
                        <?php else: ?>
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            Failed to update product
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <hr>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Product name:</label>
                            <input type="text" class="form-control" value="<?= $view_product['product_name']; ?>"
                                name="name" id="name"><br>
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" value="<?= $view_product['price']; ?>"
                                name="price" id="price"><br>
                        </div>
                        <div class="form-group">
                            <label for="category">Category:</label>
                            <select name="category" class="form-control" id="category">
                                <option>Choose category...</option>
                                <?php while($row = mysqli_fetch_assoc($view_categoryResult)): ?>
                                <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="larawan">Image:</label>
                            <input type="file" class="form-control" name="larawan" id="larawan">
                        </div>
                        <button type="submit" class="btn btn-danger" name="save">
                            <span class="glyphicon glyphicon-floppy-save"></span> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>