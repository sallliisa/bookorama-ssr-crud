<?php
$config = [
  "name" => "orders",
  "id" => "orderid",
  "title" => "Orders",
  "fields" => ["customerid", "amount", "date"],
  "fieldRelation" => [
    "customerid" => [
      "linkTable" => "customers",
      "aliasTable" => "C",
      "linkField" => "customerid",
      "selectFields" => ["name"],
      "selectValue" => "customerid"
    ]
  ],
  "fieldsAlias" => [
    "customerid" => "Customer",
    "amount" => "Amount",
    "date" => "Date"
  ],
  "fieldSearchable" => ["C.customerid", "amount", "date"],
  "inputConfig" => [
    "isbn" => ["type" => "text", "required" => true],
    "author" => ["type" => "text", "required" => true],
    "title" => ["type" => "text", "required" => true],
    "price" => ["type" => "text", "required" => true],
    "category_id" => ["type" => "lookup", "modelAPI" => "categories", "view" => "name", "pick" => "id", "required" => true]
  ],
  "fieldFilterable" => [
    "date" => ["type" => "value-range", "inputType" => 'date', "placeholder" => ['Tanggal Awal', 'Tanggal Akhir']],
  ],
  "formatter" => [
    "amount" => function ($value) {return "\${$value}";}
  ],
  "actions" => function ($row) {
    echo "<div class='d-flex flex-row gap-1'>";
      echo "<a class='btn btn-info btn-sm' href='detail.php?id=".$row['orderid']."'>Detail</a>";
    echo "</div>";
  }
]
?>