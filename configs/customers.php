<?php
$config = [
  "name" => "customers",
  "id" => "customerid",
  "title" => "Customers",
  "fields" => ["name", "address", "city"],
  "fieldsAlias" => [
    "name" => "Name",
    "address" => "Address",
    "city" => "City",
  ],
  "fieldSearchable" => ["name", "address", "city"],
  "inputConfig" => [
    "name" => ["type" => "text", "required" => true],
    "address" => ["type" => "textarea", "required" => true],
    "city" => ["type" => "text", "required" => true],
  ],
  "actions" => function ($row) {
    echo "<a class='btn btn-info btn-sm' href='detail.php?id=".$row['customerid']."'>Detail</a>";
    echo "<a class='btn btn-warning btn-sm' href='form.php?view=edit&id=".$row['customerid']."'>Ubah</a>";
    echo "<a class='btn btn-danger btn-sm' href='delete.php?&id=".$row['customerid']."'>Delete</a>";
  },
  "allowCreate" => true,
]
?>