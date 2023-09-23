<?php
  require_once('../../lib/db.php');
  $res = db_query("SELECT * FROM {$config['name']}");
?>

<?php require('../../lib/layouts/header.php') ?>
<div class="card mt-5">
  <div class="card-header"><?php echo $config['title'] ?></div>
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
              echo "<td>";
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
