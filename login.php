<?php
session_name('client');
session_start();

require('dbconnect.php');

if (isset($_POST['login'])) {

    $email      = $_POST['email'];
    $password   = $_POST['password'];

    $login_query = "SELECT id, name, email FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['loggedIn'] = true;
        $_SESSION['user_data'] = mysqli_fetch_assoc($result);
        header('location: index.php');
        exit;
    } else {
        $invalid_acc = true;
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
    <title>Shop Ignite | Sign In</title>
    <link rel="icon" href="img/shop_ignite_logo.jpg">
</head>
<body>
    <div class="container">
    <br><br><br><br><br><br><br><br><br><br><br>
    <div class="row text-center">
    <div class="col-sm-4 col-sm-offset-4">

        <h2>Sign in to Shop Ignite</h2>
        <?php if (isset($invalid_acc)): ?>
            <?php if($invalid_acc): ?>
            <div class="alert alert-danger">
                <strong>Error!</strong>
                Invalid email/password!
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <a href="register.php">Create Account</a><br><br>
            <a href="index.php">Visit without logging in</a><br><br>
            <button type="submit" name="login" class="btn btn-danger">
                Sign In
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