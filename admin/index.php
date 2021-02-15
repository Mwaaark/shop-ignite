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
        products.image_filename,
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Ignite | Admin Dashboard</title>
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
                <h2 class="sub-header">Products</h2>
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
                <button type="button" id="add-project-btn" class="btn btn-default" data-toggle="modal" data-target="#myModal">
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
                                        <input type="file" name="image" class="form-control">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <span class="glyphicon glyphicon-remove"></span> Close
                                </button>
                                <button type="submit" name="add_product" class="btn btn-default">
                                    <span class="glyphicon glyphicon-check"></span> Confirm
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
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
                                <td><?= $row['id']; ?></td>
                                <td><img src="../assets/images/<?= $row['image_filename']; ?>" alt="<?= $row['name'] ?>" class="center-block img-thumbnail"></td>
                                <td><?= $row['product_name']; ?></td>
                                <td>PHP <?= number_format($row['price']); ?></td>
                                <td><?= $row['quantity']; ?></td>
                                <td><?= $row['category']; ?></td>
                                <td><?= $row['created_at']; ?></td>
                                <td>
                                    <a href="show.php?id=<?= $row['id']; ?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="index.php?delete=<?= $row['id']; ?>">
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