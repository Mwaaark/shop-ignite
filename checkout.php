<?php
session_name('client');
session_start();

require('dbconnect.php');

if (isset($_POST['checkout'])) {
    $checkout_success = true;
    header('location: index.php');
    exit;
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
    <!-- <link rel="stylesheet" type="text/css" href="css/datatables.min.css"/> -->
    <title>Shop Ignite | Checkout</title>
    <link rel="icon" href="img/shop_ignite_logo.jpg">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="well well-sm"><a href="checkout.php">Checkout</a> / Payment</div>
        <div class="row">
            <div class="col-md-6">
                <div class="well well-sm">
                    <h2>Shipping Address</h2>
                    <hr>
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="city_mun" placeholder="City/Municipality">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="province" placeholder="Province">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="zip_code" placeholder="Zip Code">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="firstname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="middlename" placeholder="Middle Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="middlename" placeholder="Phone Number">
                        </div>
                        <label>Payment Method:</label><br>
                        <label class="checkbox-inline">
                            <input type="radio" value=""> Cash on delivery
                        </label>
                        <label class="checkbox-inline">
                            <input type="radio" value="" disabled> Paypal
                        </label><br><br>
                        <button type="submit" class="btn btn-danger" name="checkout">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="well well-sm">
                    <h2>Checkout</h2>
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
                    <h3>Total Amount: <small>PHP 80,000.00</small></h3>
                </div>
            </div>
        </div>
    </div>
</body>
</head>

<script src="js/jquery.js"></script>
<!-- <script type="text/javascript" src="js/datatables.min.js"></script> -->
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>