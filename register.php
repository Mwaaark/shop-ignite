<?php
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
        $login_query = "SELECT id, name, email FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $login_query);
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_data'] = mysqli_fetch_assoc($result);
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Ignite | Sign Up</title>
    <link rel="icon" type="image/png" href="https://res.cloudinary.com/dzfkuznwb/image/upload/v1613193824/ShopIgnite/shop_ignite_logo-removebg-preview_xh9wzp.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
<body>
    <main class="container">
        <form class="form-signin" method="POST">
            <a href="index.php">
                <img class="center-block"  src="https://res.cloudinary.com/dzfkuznwb/image/upload/w_120/v1613193824/ShopIgnite/shop_ignite_logo-removebg-preview_xh9wzp.png" alt="">
            </a>
            <?php include('flash.php'); ?>
            <h2 class="form-signin-heading">Create account</h2>
            <div class="form-group">
            <input type="text" id="inputName" class="form-control" placeholder="Name" name="name" required>
            </div>
            <div class="form-group">
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" required>
            </div>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" name="password2" required>
            <button class="btn btn-lg btn-default btn-block" type="submit" name="register">Sign Up</button>
            <p>Already have an account? <a href="login.php">Sign In</a></p>
        </form>
    </main>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>