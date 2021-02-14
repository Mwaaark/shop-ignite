<?php if (isset($addtocart_success)): ?>
    <?php if($addtocart_success): ?>
    <div class="alert alert-success">
        <strong>Success!</strong>
        Product added to cart
    </div>
    <?php elseif(!$addtocart_success): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>
        Failed to add to cart
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($checkout_success)): ?>
    <?php if($checkout_success): ?>
    <div class="alert alert-success">
        <strong>Success!</strong>
        Successfully checked out. Kindly verify your email for confirmation!
    </div>
    <?php elseif(!$checkout_success): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>
        Failed to check out
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($invalid_acc)): ?>
    <?php if($invalid_acc): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>
        Invalid email/password!
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($failed_reg)): ?>
    <?php if($failed_reg): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>
        Password do not match!
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (isset($delete_success)): ?>
    <?php if($delete_success): ?>
    <div class="alert alert-success">
        <strong>Success!</strong>
        Product successfully Deleted
    </div>
    <?php elseif(!$delete_success): ?>
    <div class="alert alert-danger">
        <strong>Error!</strong>
        Failed to delete product
    </div>
    <?php endif; ?>
<?php endif; ?>