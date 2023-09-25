<?php
  require_once('../../lib/db.php');
  $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
  $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
  $offset = ($page - 1) * $limit;

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

  $finalQuery = "SELECT {$config['name']}.* $relationQuery FROM {$config['name']} $relationJoin  ";

  if (isset($_GET['submit'])) {
    if (isset($config['fieldSearchable'])) {
      $searchableList = [];
      foreach ($config['fieldSearchable'] as $field) {
        $searchableList[] = " UPPER($field) LIKE '%{$_GET['search']}%' ";
      }
    }
    if (isset($config['fieldFilterable'])) {
      $filterableList = [];
      foreach ($config['fieldFilterable'] as $field => $fieldConfig) {
        if ($fieldConfig['type'] == 'lookup') {
          if ($_GET[$field]) {
            $filterableList[] = "{$field}='{$_GET[$field]}'";
          }
        } elseif ($fieldConfig['type'] == 'value-range') {
          if ($_GET[$field][0] && $_GET[$field][1]) {
            if ($fieldConfig['inputType'] == 'number') {
              $filterableList[] = "{$field} BETWEEN {$_GET[$field][0]} AND {$_GET[$field][1]}";
            } else {
              $filterableList[] = "{$field} BETWEEN '{$_GET[$field][0]}' AND '{$_GET[$field][1]}'";
            }
          }
        }
      }
    }
    $finalQuery .= " WHERE TRUE " . " AND (" . implode(" OR ", $searchableList) . ")";
    if (isset($filterableList) && count($filterableList)) {
      $finalQuery .= " AND (". implode(" AND ", $filterableList) .")";
    }
  }

  $finalQuery .= " LIMIT $limit OFFSET $offset";
  $res = db_list($finalQuery);

?>

<div class="card mt-5">
  <div class="card-header d-flex flex-row justify-content-between">
    <div class="d-flex flex-row align-items-center gap-4">
      <div><?php echo $config['title'] ?></div>
      <form method="GET" action="">
        <div class="input-group d-flex align-items-center gap-2">
          <input type="text" class="form-control" name="search" placeholder="Search..." <?php echo "value='{$_GET['search']}'" ?>>
          <?php
            foreach ($config['fieldFilterable'] as $field => $fieldConfig) {
              if ($fieldConfig['type'] == 'lookup') {
                $lookup_data = db_list("SELECT * FROM {$fieldConfig['modelAPI']}");
                echo "<select class='form-control' name='{$field}' id='{$field}'>";
                echo "<option value='' selected>--{$fieldConfig['placeholder']}--</option>";
                foreach ($lookup_data as $row) {
                  echo "<option value='{$row[$fieldConfig['pick']]}'". ($_GET[$field] == $row[$fieldConfig['pick']] ? 'selected' : '') .">{$row[$fieldConfig['view']]}</option>";
                }
                echo "</select>";
              } elseif ($fieldConfig['type'] == 'value-range') {
                echo "<input class='form-control' type='{$fieldConfig['inputType']}' placeholder='{$fieldConfig['placeholder'][0]}' name='{$field}[0]' value='".$_GET[$field][0]."'></input>";
                echo "-";
                echo "<input class='form-control' type='{$fieldConfig['inputType']}' placeholder='{$fieldConfig['placeholder'][1]}' name='{$field}[1]' value='".$_GET[$field][1]."'></input>";
              }
            }
          ?>
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" value="submit" name="submit">Filter</button>
          </div>
        </div> 
      </form>
    </div>
    <?php
      if ($config['allowCreate']) {
        echo "<a class='btn btn-primary btn-sm d-flex align-items-center justify-content-center' href='form.php?view=create'>+ Tambah</a>";
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
          if (isset($res)) {
            echo "Total Rows: ". count($res);
          }
        ?>
  </div>
</div>