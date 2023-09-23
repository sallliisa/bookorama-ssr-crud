<?php
$config = [
  "name" => "categories",
  "id" => "id",
  "title" => "Categories",
  "fields" => ["name"],
  "fieldsAlias" => [
    "name" => "Name",
  ],
  "inputConfig" => [
    "name" => ["type" => "text", "required" => true],
  ],
  "fieldSearchable" => ["name"],
  "actions" => function ($row) {
    echo "<div class='d-flex flex-row gap-1'>";
    echo "<a class='btn btn-info btn-sm' href='detail.php?id=".$row['id']."'>Detail</a>";
    echo "<a class='btn btn-warning btn-sm' href='form.php?view=edit&id=".$row['id']."'>Ubah</a>";
    echo "<a class='btn btn-danger btn-sm' href='delete.php?&id=".$row['isbn']."'>Delete</a>";
    echo "</div>";
  },
  "allowCreate" => true
]
?>