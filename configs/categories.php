<?php
$config = [
  "name" => "categories",
  "id" => "categoryid",
  "title" => "Categories",
  "fields" => ["name"],
  "fieldsAlias" => [
    "name" => "Name",
  ],
  "inputConfig" => [
    "name" => ["type" => "text", "required" => true],
  ],
  "actions" => function ($row) {
    echo "<div class='d-flex flex-row gap-1'>";
    echo "<a class='btn btn-info btn-sm' href='detail.php?id=".$row['categoryid']."'>Detail</a>";
    echo "<a class='btn btn-warning btn-sm' href='form.php?view=edit&id=".$row['categoryid']."'>Ubah</a>";
    echo "</div>";
  },
  "allowCreate" => true
]
?>