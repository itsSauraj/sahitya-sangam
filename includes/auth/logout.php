<?php
session_start();
session_unset();
session_destroy();

/* 👇 ROOT INDEX pe redirect */
header("Location: ../index.php");
exit();
?>