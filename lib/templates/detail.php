<?php
  require_once('../../lib/db.php');
  $id = $_GET['id'];
  $res = db_single("SELECT * FROM {$config['name']} WHERE {$config['id']}='{$id}'");
?>

<?php require('../../lib/layouts/header.php') ?>
<div class="card mt-5">
  <div class="card-header"><?php echo $config['title'] ?></div>
  <div class="card-body">
    <table>
      <?php
        foreach ($config['fields'] as $field) {
          echo "<tr>";
          if (isset($config['fieldsAlias'][$field])) {
            echo "<td>{$config['fieldsAlias'][$field]}</td>";  
          } else {
            echo "<td>{$field}</td>";
          }
          echo "<td class='px-4'>:</td>";
          echo "<td>{$res[$field]}</td>";
          echo "</tr>";
        }
      ?>
    </table>
  </div>
</div>
<?php require('../../lib/layouts/footer.php') ?>
