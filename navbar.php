<?php
if (isset($_SESSION['user_data'])) {
    $cart_badge_query = "SELECT * FROM carts WHERE user_id = " . $_SESSION['user_data']['id'];
    $cart_badge_result = mysqli_query($conn, $cart_badge_query);

    if ($cart_badge_result) {
        $cart_badge = true;
    }
}
?>


<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Shop Ignite</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="#">About</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="cart.php">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Cart
                    <?php if (isset($cart_badge)): ?>
                        <?php if ($cart_badge): ?>
                        <span class="badge"><?= mysqli_num_rows($cart_badge_result); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </a>
            </li>
            <?php if (!isset($_SESSION['loggedIn'])): ?>
                <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php else: ?>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>