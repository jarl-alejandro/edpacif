<?php
session_start();

$_SESSION["3188768e18a5c00164bbe22d1749a30e4626a114"] = "";
$_SESSION["f9f011a553550aef31a8ee2690e1d1b5f261c9ff"] = "";
$_SESSION["a88b7dcd1a9e3e17770bbaa6d7515b31a2d7e85d"] = "";
$_SESSION["9c3bb49ffea1144231cbe02d904b8d9018744e9d"] = "";

session_destroy();
$insertGoTo = "../index.php";
header(sprintf("Location: %s", $insertGoTo));
