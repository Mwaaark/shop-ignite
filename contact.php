<?php
session_name('client');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Shop Ignite | Contact Us</title>
    <link rel="icon" href="img/shop_ignite_logo.jpg">
</head>
<body>
    <?php include('navbar.php'); ?>
    <div class="container">
        <h2>Contact Us</h2>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae quo placeat nam ea provident doloribus nesciunt corporis. Dolore fugiat consectetur nulla natus est quaerat vel enim, laudantium alias animi nostrum!
        </p>

        <form method="POST">
            <div class="form-group">
                <input type="name" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="5" placeholder="Your message here"></textarea>
            </div>
                <button type="submit" class="btn btn-danger" name="submit">
                    Submit
                </button>
        </form>
    </div>
</body>
</html>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>