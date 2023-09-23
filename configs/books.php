<?php
$config = [
  "name" => "books",
  "id" => "isbn",
  "title" => "Books",
  "fields" => ["isbn", "author", "title", "price"],
  "fieldsAlias" => [
    "isbn" => "ISBN",
    "author" => "Author",
    "title" => "Title",
    "price" => "Price"
  ],
  "inputConfig" => [
    "isbn" => ["type" => "text", "required" => true],
    "author" => ["type" => "text", "required" => true],
    "title" => ["type" => "text", "required" => true],
    "price" => ["type" => "text", "required" => true],
  ],
  "formatter" => [
    "price" => function ($value) {return "\${$value}";}
  ],
  "actions" => function ($row) {
    echo "<div class='d-flex flex-row gap-1'>";
    echo "<a class='btn btn-info btn-sm' href='detail.php?id=".$row['isbn']."'>Detail</a>";
    echo "<a class='btn btn-warning btn-sm' href='form.php?view=edit&id=".$row['isbn']."'>Ubah</a>";
    echo "<a class='btn btn-primary btn-sm' href='/show_cart.php?id=".$row['isbn']."'>Add to Cart</a>";
    echo "</div>";
  },
  "allowCreate" => true
]
?>