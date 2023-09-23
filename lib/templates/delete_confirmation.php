<?php
  require_once('../../lib/db.php');
  $id = $_GET['id'];
  $res = db_single("SELECT * FROM {$config['name']} WHERE {$config['id']}='{$id}'");
?>

<div class="card mt-5">
  <div class="card-header"><?php echo $config['title'] ?></div>
  <div class="card-body">
    <h4 class="mb-4 text-danger font-weight-bold">Apakah anda yakin ingin menghapus data ini?</h4>
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
    <div class="d-flex flex-row gap-2 mt-4">
      <a class="btn btn-danger" <?php echo "href='/lib/services/delete.php?model={$config['name']}&identifier={$config['id']}&id={$_GET['id']}'" ?>>Hapus</a>
      <a class="btn btn-primary" <?php echo "href='list.php'" ?>>Batal</a>
    </div>
  </div>
</div>