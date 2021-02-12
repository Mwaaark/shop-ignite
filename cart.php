<?php
session_name('client');
session_start();

require('dbconnect.php');

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete_query = "DELETE FROM carts WHERE id=$id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        $delete_success = true;
    } else {
        $delete_success = false;
    }
}

if (isset($_SESSION['user_data']['id'])) {

    $cart_query = "
        SELECT
            carts.id,
            products.name,
            products.price
        FROM
            products,
            carts
        WHERE
            carts.user_id = " . $_SESSION['user_data']['id'] . "
        AND
            carts.product_id = products.id
        ";
    $cart_result = mysqli_query($conn, $cart_query);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/>
    <title>Shop Ignite | View Cart</title>
    <link rel="icon" href="img/shop_ignite_logo.jpg">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="well well-sm"><a href="products.php">Cart</a> / View Cart</div>
            <div class="well well-sm">
                <h2>View Cart</h2>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($_SESSION['user_data']['id'])): ?>
                        <?php while($row = mysqli_fetch_assoc($cart_result)): ?>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td>PHP <?= number_format($row['price'], 2); ?></td>
                                <td>
                                    <a href="cart.php?delete=<?= $row['id']; ?>">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <a href="checkout.php" class="btn btn-danger">Proceed to checkout</a>
            </div>
        </div>
    </div>
</body>
</head>

<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/datatables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>