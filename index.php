<?php
session_name('client');
session_start();

require('dbconnect.php');



// echo $_SESSION['user_data']['name'];
// echo $_SESSION['user_data']['id'];
// echo $_SESSION['user_data']['email'];

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
        id,
        name,
        price,
        image_name
    FROM
        products
    ORDER BY
        id
    DESC
    ";
$show_products_result = mysqli_query($conn, $show_products_query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Shop Ignite | Home</title>
    <link rel="icon" href="img/shop_ignite_logo.jpg">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
    <?php if (isset($addtocart_success)): ?>
        <?php if($addtocart_success): ?>
        <div class="alert alert-success">
            <strong>Success!</strong>
            Product added to cart
        </div>
        <?php elseif(!$addtocart_success): ?>
        <div class="alert alert-danger">
            <strong>Error!</strong>
            Failed to add to cart
        </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($checkout_success)): ?>
        <?php if($checkout_success): ?>
        <div class="alert alert-success">
            <strong>Success!</strong>
            Successfully checked out. Kindly verify your email for confirmation!
        </div>
        <?php elseif(!$checkout_success): ?>
        <div class="alert alert-danger">
            <strong>Error!</strong>
            Failed to check out
        </div>
        <?php endif; ?>
    <?php endif; ?>
        <div class="row">
            <?php while($row = mysqli_fetch_assoc($show_products_result)): ?>
            <div class="col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <img src="img/<?= $row['image_name']; ?>" class="img-responsive" style="width:100%" alt="<?= $row['image_name']; ?>">
                    </div>
                    <div class="panel-footer">
                        <h3 style="margin-top: 0;">
                            <?= $row['name']; ?><small> PHP <?= number_format($row['price'], 2); ?></small>
                        </h3>
                        <div class="btn-group btn-group-justified">
                                <a href="view_product.php?id=<?= $row['id']; ?>" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-list-alt"></span> Overview
                                </a>
                                <a href="index.php?addtocart=<?= $row['id']; ?>" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add to cart
                                </a>
                        </div>
                        <br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi odit culpa illo accusamus optio aperiam nobis veniam distinctio, cumque quam deserunt et ipsam? Sed, placeat ullam. Sunt, saepe! Eius, ipsum?
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>