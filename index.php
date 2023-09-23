<?php
  if (!isset($_SESSION['username'])) {
    header('Location: login.php');
  } else {
    header('Location: admin.php');
  }
?>