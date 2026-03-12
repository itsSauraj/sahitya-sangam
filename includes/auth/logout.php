<?php
require_once __DIR__ . '/../config/init.php';

session_unset();
session_destroy();

/* Redirect to homepage */
header("Location: ../../index.php");
exit();
?>