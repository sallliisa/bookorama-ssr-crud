<?php
  require_once('../../lib/db.php');
  $id = $_GET['id'];
  $res = db_query("SELECT * FROM {$config['name']} WHERE {$config['id']}='{$id}'");
?>

<?php require('../../lib/layouts/header.php') ?>
<div>

</div>
<?php require('../../lib/layouts/footer.php') ?>
