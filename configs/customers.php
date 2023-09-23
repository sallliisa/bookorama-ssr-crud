<?php
$config = [
  "name" => "customers",
  "title" => "Customers",
  "fields" => ["name", "address", "city"],
  "fieldsAlias" => [
    "name" => "Name",
    "address" => "Address",
    "city" => "City",
  ],
  "inputConfig" => [
    "name" => ["type" => "text", "required" => true],
    "address" => ["type" => "textarea", "required" => true],
    "city" => ["type" => "text", "required" => true],
  ],
  "actions" => function ($row) {
    echo "<a class='btn btn-warning btn-sm' href='/edit_customer.php?id=".$row['customerid']."'>Edit</a>";
    echo "<a class='btn btn-danger btn-sm' href='/confirm_delete_customer.php?id=".$row['customerid']."'>Delete</a>";
  },
  "allowCreate" => true,
]
?>