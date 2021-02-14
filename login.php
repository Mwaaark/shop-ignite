<?php
session_start();
require('dbconnect.php');

if (isset($_POST['login'])) {
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $login_query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $login_query);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_data'] = mysqli_fetch_assoc($result);
        if ($_SESSION['user_data']['is_admin'] == 1) {
          header('location: admin/');
          exit;
        } else {
          header('location: index.php');
          exit;
        }
    } else {
        $invalid_acc = true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Ignite | Sign In</title>
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
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-default btn-block" type="submit" name="login">Sign in</button>
        <a href="register.php">Create Account</a>
      </form>
    </main> <!-- /container -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>
</html>