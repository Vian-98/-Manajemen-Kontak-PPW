<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"] ?? -1;

if (isset($_SESSION["kontak"][$id])) {
    unset($_SESSION["kontak"][$id]);
    $_SESSION["kontak"] = array_values($_SESSION["kontak"]); 
}

header("Location: dashboard.php");
exit;