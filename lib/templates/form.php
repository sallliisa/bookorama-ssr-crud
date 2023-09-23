<?php
  require_once('../../lib/db.php');
  if (isset($_GET['view'])) {
    if ($_GET['view'] == 'edit') {
      $id = $_GET['id'];
      $res = db_query("SELECT * FROM {$config['name']} WHERE {$config['id']}='{$id}'");
    }
  }
?>

<?php require('../../lib/layouts/header.php') ?>
<div class="card mt-5">
  <div class="card-header"><?php echo $config['title'] ?></div>
  <div class="card-body">
    <div class="d-flex flex-column gap-4">
      <?php
        foreach ($config['fieldAdd'] as $field) {
          echo "<div>";
          echo $field;
          echo "</div>";
        }
      ?>
    </div>
  </div>
</div>
<?php require('../../lib/layouts/footer.php') ?>