<?php
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
    <title>Shop Ignite | Cart</title>
    <link rel="icon" type="image/png" href="https://res.cloudinary.com/dzfkuznwb/image/upload/v1613193824/ShopIgnite/shop_ignite_logo-removebg-preview_xh9wzp.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
<body>
    <?php include('navbar.php'); ?>
    <main class="container">
    <?php include('flash.php'); ?>
        <div class="well well-sm">
        <h2>Cart</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Action</th>
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
        <a href="checkout.php" class="btn btn-default">Proceed to checkout</a>
        </div>
    </main>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>