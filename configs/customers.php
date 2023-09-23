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
  "actions" => function ($row) {
    echo "<a class='btn btn-warning btn-sm' href='/edit_customer.php?id=".$row['customerid']."'>Edit</a>";
    echo "<a class='btn btn-danger btn-sm' href='/confirm_delete_customer.php?id=".$row['customerid']."'>Delete</a>";
  }
]
?>