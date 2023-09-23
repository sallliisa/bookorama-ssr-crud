<?php 
// File         : delete_cart.php
// Deskripsi    : untuk menghapus session

session_start();

$_SESSION['cart'] = null;

header("Location: /show_cart.php");