<?php
session_name('client');
session_start();

session_destroy();

header('location: login.php');
exit;
?>