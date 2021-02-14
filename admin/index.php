<?php
session_start();

if (!isset($_SESSION['loggedIn'])) {
    header('location: ../login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Shop Ignite | Admin Dashboard</title>
    <link rel="icon" href="../img/shop_ignite_logo.jpg">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            <div class="well">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis fuga inventore reiciendis soluta, quisquam consequatur labore at distinctio. Consectetur ipsa totam sapiente possimus ab saepe hic dolore illo corporis suscipit.
            </div>
            </div>
            <div class="col-sm-9">
            <div class="well">
            <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p>...</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
            </div>
            <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                <span class="sr-only">40% Complete (success)</span>
            </div>
            </div>
            <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                <span class="sr-only">20% Complete</span>
            </div>
            </div>
            <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                <span class="sr-only">60% Complete (warning)</span>
            </div>
            </div>
            <div class="progress">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                <span class="sr-only">80% Complete (danger)</span>
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/popper.min.js"></script>