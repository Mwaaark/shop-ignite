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
    $image_filename = $_FILES['image']['name'];
    $tmp_name       = $_FILES['image']['tmp_name'];
    $add_query = "INSERT INTO products (name, category_id, price, quantity, image_filename) VALUES
        ('$name', $category_id, $price, $quantity, '$image_filename')";
    $add_result = mysqli_query($conn, $add_query);
    if ($add_result) {
        move_uploaded_file($tmp_name, '../assets/images/' . $image_filename);
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
    $image_filename  = $_FILES['image']['name'];
    $tmp_name    = $_FILES['image']['tmp_name'];
    $edit_query = "
        UPDATE
            products
        SET
            name='$name',
            price=$price,
            category_id=$category,
            image_filename='$image_filename'
        WHERE
            id=$id
        ";
    $edit_result = mysqli_query($conn, $edit_query);
    
    if ($edit_result) {
        move_uploaded_file($tmp_name, '../assets/images/' . $image_filename);
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
        products.image_filename
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Ignite | <?= $view_product['product_name']; ?></title>
    <link rel="icon" type="image/png" href="https://res.cloudinary.com/dzfkuznwb/image/upload/v1613193824/ShopIgnite/shop_ignite_logo-removebg-preview_xh9wzp.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
  </head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php include('sidebar.php'); ?>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <!-- dashboard here -->
                <h2 class="sub-header">View Product</h2>
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
                        <label for="image">Image:</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left"></span> Go Back</a>
                    <button type="submit" class="btn btn-default" name="save">
                        <span class="glyphicon glyphicon-check"></span> Confirm
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>
</html>