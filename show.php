<?php
session_start();
require('dbconnect.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

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

$show_query = "
    SELECT
        products.id,
        products.name,
        products.price,
        products.image_filename,
        categories.name AS category
    FROM
        products
    INNER JOIN
        categories
    ON
        categories.id = products.category_id
    WHERE
        products.id=$id;
    ";
$show_result = mysqli_query($conn, $show_query);
$show_product = mysqli_fetch_assoc($show_result);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Ignite | <?= $show_product['name']; ?></title>
    <link rel="icon" type="image/png" href="https://res.cloudinary.com/dzfkuznwb/image/upload/v1613193824/ShopIgnite/shop_ignite_logo-removebg-preview_xh9wzp.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
<body>
    <?php include('navbar.php'); ?>
    <main class="container">
    <?php include('flash.php'); ?>
        <div class="row">
            <div class="col-sm-7">
            <div class="well">
                <img src="assets/images/<?= $show_product['image_filename']; ?>" class="img-responsive" style="width:100%" alt="Image">
                </div>
            </div>
            <div class="col-sm-5">
            <div class="well">
                <h3><?= $show_product['name']; ?></h3>
                <p><?= $show_product['category']; ?></p>
                <h4 class="text-muted"> PHP <?= number_format($show_product['price'], 2); ?></h4>
                <a href="/shop_ignite/show.php?addtocart=<?= $show_product['id']; ?>" class="btn btn-default btn-block"><span class="glyphicon glyphicon-shopping-cart"></span> Add to cart</a>
                <h4>Product description</h4>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque dignissim tincidunt ex vel ultricies. Mauris blandit eros ipsum, consectetur venenatis odio accumsan ut. Proin pellentesque facilisis tristique. Aenean volutpat posuere consectetur. Curabitur ullamcorper nisi felis. Donec enim quam, convallis ut erat sed, pretium feugiat tortor. Nunc quis hendrerit neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec consequat sem quis arcu viverra ornare. Donec consequat tristique sagittis. Etiam ornare lacinia odio sed suscipit.
                </p>
            </div>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>