<?php
session_name('admin');
session_start();

session_destroy();

header('location: login.php');
exit;
?>