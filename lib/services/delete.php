<?php
  require_once('../db.php');
  db_query("DELETE FROM {$_GET['model']} WHERE {$_GET['identifier']}='{$_GET['id']}'", null, null);
  header("Location: /views/{$_GET['model']}/list.php")
?>