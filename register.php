<?php
session_name('client');
session_start();

require('dbconnect.php');

if (isset($_POST['register'])) {
    
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $password2  = $_POST['password2'];

    $register_query = "INSERT INTO users (name, email, password) VALUES
        ('$name', '$email', '$password')";

    if ($password == $password2) {
        $result = mysqli_query($conn, $register_query);
        header('location: index.php');
        exit;
    } else {
        $failed_reg = true;
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Shop Ignite | Create Account</title>
    <link rel="icon" href="img/shop_ignite_logo.jpg">
</head>
<body>
    <div class="container">
    <br><br><br><br><br><br><br><br><br><br><br>
    <div class="row text-center">
    <div class="col-sm-4 col-sm-offset-4">
        <h2>Create your Shop Ignite Account</h2>
        <?php if (isset($failed_reg)): ?>
            <?php if($failed_reg): ?>
            <div class="alert alert-danger">
                <strong>Error!</strong>
                Password do not match!
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <form method="POST">
            <!-- <div class="form-group">
                <input type="text" class="form-control" name="firstname" placeholder="First Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="middlename" placeholder="Middle Name">
            </div> -->
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required>
            </div>
            <a href="login.php">Sign in instead</a><br><br>
            <button type="submit" name="register" class="btn btn-danger">
                Create Account
            </button>
        </form>
    </div>
    </div>
    </div>
</body>
</html>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/popper.min.js"></script>