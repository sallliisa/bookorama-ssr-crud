<?php
  require_once('../../lib/db.php');

  $formErrors = array();
  $formData = array();
  
  if (isset($_GET['view'])) {
    if ($_GET['view'] == 'edit') {
      $id = $_GET['id'];
      $formData = db_single("SELECT * FROM {$config['name']} WHERE {$config['id']}='{$_GET['id']}'");
    }
  }

  if (isset($_POST["submit"])) {
    $valid = true;
    $formData = array();
    foreach ($config['fields'] as $field) {
      $formData[$field] = $_POST[$field];
      if (isset($config['inputConfig'][$field]['validator'])) {
        $valid = $config['inputConfig'][$field]['validator']($_POST[$field]);
      }
    }
    if ($valid) {
      if ($_GET['view'] == 'edit') {
        db_update($config['name'], $config['id'], $_GET['id'], $formData);
      } else {
        db_insert($config['name'], $formData);
      }
      header("Location: list.php");
    }
  }
?>

<?php require('../../lib/layouts/header.php') ?>
<div class="card mt-5">
  
  <div class="card-header"><?php echo $config['title'] ?></div>
  <div class="card-body">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $_GET['id'] . '&view=' . $_GET['view'] ?>" method="POST" autocomplete="on" class="d-flex flex-column gap-4">
      <?php
        foreach ($config['fields'] as $field) {
          echo "<div class='form-group'>";
            if (isset($config['fieldsAlias'][$field])) {
              echo "<label for='{$field}'>{$config['fieldsAlias'][$field]}:</label>";  
            } else {
              echo "<label for='{$field}'>{$field}</label>";
            }

            if ($config['inputConfig'][$field]['type'] == 'text') {
              echo "<input class='form-control' type='{$config['inputConfig'][$field]['type']}' name='{$field}' id='{$field}' value='{$formData[$field]}'". ($config['inputConfig'][$field]['required'] ? 'required' : '') ."></input>";
            } elseif ($config['inputConfig'][$field]['type'] == 'textarea') {
              echo "<textarea class='form-control' type='{$config['inputConfig'][$field]['type']}' name='{$field}' id='{$field}'". ($config['inputConfig'][$field]['required'] ? 'required' : '') .">{$formData[$field]}</textarea>";
            }
            
            if (isset($formErrors[$field])) {
              echo "<div class='error'>{$formErrors[$field]}</div>";
            }
          echo "</div>";
        }
      ?>
      <button type="submit" class="btn btn-primary mt-4" name="submit" value="submit">Submit</button>
    </form>
  </div>
</div>
<?php require('../../lib/layouts/footer.php') ?>