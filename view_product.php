<?php
session_name('client');
session_start();

require('dbconnect.php');

// if(isset($_GET['addtocart'])) {

//     if (!isset($_SESSION['user_data'])) {
//         header('location: login.php');
//         die;
//     } else {
//         $addtocart_id = $_GET['addtocart'];

//         $addtocart_query = "
//             INSERT INTO
//                 carts (
//                 user_id,
//                 product_id
//             )
//             VALUES (
//                 " . $_SESSION['user_data']['id'] . ",
//                 $addtocart_id
//             )
//             ";
//         $addtocart_result = mysqli_query($conn, $addtocart_query);

//         if ($addtocart_result) {
//             $addtocart_success = true;
//         } else {
//             $addtocart_success = false;
//         }
//     }
// }

$id = $_GET['id'];

$show_query = "
    SELECT
        id,
        name,
        price,
        quantity,
        image_name
    FROM
        products
    WHERE
        id=$id;
    ";
$show_result = mysqli_query($conn, $show_query);
$show_product = mysqli_fetch_assoc($show_result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Shop Ignite | View Product</title>
    <link rel="icon" href="img/shop_ignite_logo.jpg">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
            <div class="well">
                <img src="img/<?= $show_product['image_name']; ?>" class="img-responsive" style="width:100%" alt="Image">
                </div>
            </div>
            <div class="col-sm-5">
            <div class="well">
                <h2><?= $show_product['name']; ?></h2>
                <h4>
                    Price <small>PHP <?= number_format($show_product['price'], 2); ?></small>
                </h4>
                <a href="#" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-shopping-cart"></span> Add to cart</a>
                <h4>Product description</h4>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dignissim tincidunt ex vel ultricies. Mauris blandit eros ipsum, consectetur venenatis odio accumsan ut. Proin pellentesque facilisis tristique. Aenean volutpat posuere consectetur. Curabitur ullamcorper nisi felis. Donec enim quam, convallis ut erat sed, pretium feugiat tortor. Nunc quis hendrerit neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec consequat sem quis arcu viverra ornare. Donec consequat tristique sagittis. Etiam ornare lacinia odio sed suscipit.
                </p>
                <p>
                Quisque aliquam diam ex, quis sodales metus condimentum convallis. Phasellus scelerisque mauris non lorem maximus suscipit. Nulla eu iaculis leo, non laoreet sem. Mauris hendrerit, diam nec interdum porta, eros turpis porta tellus, vel convallis augue augue in sem. Nullam ornare suscipit urna, semper sodales odio consectetur et. Praesent ac neque dignissim, dictum est ac, mattis nibh. Donec egestas orci orci. Nunc efficitur felis a placerat consectetur.
                </p>
            </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>