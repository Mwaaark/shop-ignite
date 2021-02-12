<?php
session_name('admin');
session_start();

require('../dbconnect.php');

if (!isset($_SESSION['loggedIn'])) {
    header('location: login.php');
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

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete_query = "DELETE FROM products WHERE id=$id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        $delete_success = true;
    } else {
        $delete_success = false;
    }
}

$categoryQuery = "SELECT id, name FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);

$show_query = "
    SELECT
        products.id,
        products.name AS product_name,
        products.price,
        products.quantity,
        categories.name AS category,
        products.created_at
    FROM
        products,
        categories
    WHERE
        products.category_id = categories.id
    ";
$show_result = mysqli_query($conn, $show_query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/datatables.min.css"/>
    <title>Shop Ignite | Admin Products</title>
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
                                        <input type="file" name="larawan" class="form-control">
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
                <div class="well well-sm"><a href="products.php">Products</a> / All products</div>
                <div class="well well-sm">
                    <h2>Products</h2>
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
                    <?php if (isset($delete_success)): ?>
                        <?php if($delete_success): ?>
                        <div class="alert alert-success">
                            <strong>Success!</strong>
                            Product successfully Deleted
                        </div>
                        <?php elseif(!$delete_success): ?>
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            Failed to delete product
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <hr>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($show_result)): ?>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['product_name']; ?></td>
                                    <td>PHP <?= number_format($row['price']); ?></td>
                                    <td><?= $row['quantity']; ?></td>
                                    <td><?= $row['category']; ?></td>
                                    <td><?= $row['created_at']; ?></td>
                                    <td>
                                        <a href="view_product.php?id=<?= $row['id']; ?>" target="_blank">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a href="products.php?delete=<?= $row['id']; ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/datatables.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>