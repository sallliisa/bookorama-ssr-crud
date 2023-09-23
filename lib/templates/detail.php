<?php
  require_once('../../lib/db.php');
  $id = $_GET['id'];

  $relationJoin = "";
  $relationQuery = "";
  foreach ($config['fieldRelation'] as $key => $value) {
    $linkTable = $value['linkTable'];
    $aliasTable = $value['aliasTable'];
    $linkField = $value['linkField'];
    $selectValue = $value['selectValue'];
    $relationJoin .= " LEFT JOIN $linkTable $aliasTable ON {$config['name']}.$key = $aliasTable.$linkField";
    foreach ($value['selectFields'] as $selectField) {
      $relationQuery .= ", $aliasTable.$selectField AS $selectValue";
    }
  }
  $res = db_single("SELECT {$config['name']}.* $relationQuery FROM {$config['name']} $relationJoin WHERE {$config['name']}.{$config['id']}='{$id}'");
?>

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
