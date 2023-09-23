<?php
  require_once('../../lib/db.php');
  $res = db_list("SELECT * FROM {$config['name']}");
?>

<?php require('../../lib/layouts/header.php') ?>
<div class="card mt-5">
  <div class="card-header d-flex flex-row justify-content-between">
    <div><?php echo $config['title'] ?></div>
    <?php
      if ($config['allowCreate']) {
        echo "<a class='btn btn-primary btn-sm' href='form.php?view=create'>+ Tambah</a>";
      }
    ?>
  </div>
  <div class="card-body">
      <table class="table table-striped">
        <tr>
          <?php
            foreach ($config['fields'] as $field) {
              echo "<th>";
              if (isset($config["fieldsAlias"][$field])) {
                echo $config["fieldsAlias"][$field];
              } else {
                echo $field;
              }
              echo "</th>";
            }
            if (isset($config['actions'])) {
              echo "<th>Action</th>";
            }
          ?>
        </tr>
        <?php
          foreach ($res as $row) {
            echo '<tr>';
            foreach ($config['fields'] as $field) {
              echo "<td>";
              if (isset($config['formatter'][$field])) {
                echo $config['formatter'][$field]($row[$field]);
              } else {
                echo $row[$field];
              }
              echo "</td>";
            }
            if (isset($config['actions'])) {
              echo "<td class='d-flex flex-row align-items-center gap-1'>";
              echo $config['actions']($row);
              echo "</td>";
            }
            echo '</tr>';
          }
          echo '</table>';
          echo '<br />';
          echo "Total Rows: ". count($res);
        ?>
  </div>
</div>
<?php require('../../lib/layouts/footer.php') ?>
