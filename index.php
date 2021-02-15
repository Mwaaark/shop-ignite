<?php
session_start();
require('dbconnect.php');

if(isset($_GET['addtocart'])) {
    if (!isset($_SESSION['user_data'])) {
        header('location: login.php');
        die;
    } else {
        $id = $_GET['addtocart'];
        $addtocart_query = "
            INSERT INTO
                carts (
                user_id,
                product_id
            )
            VALUES (
                " . $_SESSION['user_data']['id'] . ",
                $id
            )
            ";
        $addtocart_result = mysqli_query($conn, $addtocart_query);

        if ($addtocart_result) {
            $addtocart_success = true;
        } else {
            $addtocart_success = false;
        }
    }
}

$show_products_query = "
    SELECT
        products.id,
        products. name,
        products.price,
        products.image_filename,
        categories.name AS category
    FROM
        products
    INNER JOIN
        categories
    ON
        categories.id = category_id
    ORDER BY
        products.id
    DESC
    ";
$show_products_result = mysqli_query($conn, $show_products_query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Ignite | Home</title>
    <link rel="icon" type="image/png" href="https://res.cloudinary.com/dzfkuznwb/image/upload/v1613193824/ShopIgnite/shop_ignite_logo-removebg-preview_xh9wzp.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
<body>
    <?php include('navbar.php'); ?>
    <main class="container">
    <?php include('flash.php'); ?>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($show_products_result)): ?>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="assets/images/<?= $row['image_filename']; ?>" class="img-responsive" alt="<?= $row['name']; ?>">
                    </div>
                    <div class="panel-footer">
                        <h3><?= $row['name']; ?></h3>
                        <p><?= $row['category']; ?></p>
                        <h4 class="text-muted"> PHP <?= number_format($row['price'], 2); ?></h4>
                        <div class="btn-group btn-group-justified">
                                <a href="show.php?id=<?= $row['id']; ?>" class="btn btn-default">
                                    <span class="glyphicon glyphicon-list-alt"></span> Overview
                                </a>
                                <a href="/shop_ignite/?addtocart=<?= $row['id']; ?>" class="btn btn-default">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to cart
                                </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>