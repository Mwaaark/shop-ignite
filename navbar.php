<?php
if (isset($_SESSION['user_data'])) {
    $cart_badge_query = "SELECT * FROM carts WHERE user_id = " . $_SESSION['user_data']['id'];
    $cart_badge_result = mysqli_query($conn, $cart_badge_query);
    if ($cart_badge_result) {
        $cart_badge = true;
    }
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/shop_ignite">Shop Ignite</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/shop_ignite">Home</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">About Us</a></li>
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
            <li><a href="register.php"><span class="glyphicon glyphicon-edit"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
        <?php else: ?>
          <?php if (isset($_SESSION['user_data']['is_admin'])): ?>
            <?php if ($_SESSION['user_data']['is_admin'] == 1): ?>
              <li><a href="admin/"><span class="glyphicon glyphicon-lock"></span> Admin Dashboard</a></li>
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?= $_SESSION['user_data']['name'] ?></a></li>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php endif; ?>
          <?php else: ?>
              <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?= $_SESSION['user_data']['name'] ?></a></li>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>