<?php
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
            products.price,
            products.image_filename
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Ignite | Checkout</title>
    <link rel="icon" type="image/png" href="https://res.cloudinary.com/dzfkuznwb/image/upload/v1613193824/ShopIgnite/shop_ignite_logo-removebg-preview_xh9wzp.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
<body>
    <?php include('navbar.php'); ?>
    <main class="container">
        <div class="row">
            <div class="col-md-5">
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
                        <button type="submit" class="btn btn-default" name="checkout">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="well well-sm">
                    <h2>Checkout</h2>
                    <hr>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($_SESSION['user_data']['id'])): ?>
                            <?php while($row = mysqli_fetch_assoc($cart_result)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><img src="assets/images/<?= $row['image_filename']; ?>" alt="<?= $row['name'] ?>" class="center-block img-thumbnail"></td>
                                <td><?= $row['name'] ?></td>
                                <td>PHP <?= number_format($row['price'], 2); ?></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right" style="margin-right: 5px">
                        <h3>Total Amount:</h3>
                        <p>PHP 80,000.00</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>