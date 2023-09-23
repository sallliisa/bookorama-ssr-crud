<?php
$config = [
  "name" => "books",
  "id" => "id",
  "title" => "Books",
  "fields" => ["isbn", "author", "title", "price", "category_id"],
  "fieldTypes" => [
    "isbn" => "s", 
    "author" => "s", 
    "title" => "s", 
    "price" => "d", 
    "category_id" => "i"
  ],
  "fieldRelation" => [
    "category_id" => [
      "linkTable" => "categories",
      "aliasTable" => "A",
      "linkField" => "id",
      "selectFields" => ["name"],
      "selectValue" => "category_id"
    ]
  ],
  "fieldsAlias" => [
    "isbn" => "ISBN",
    "author" => "Author",
    "title" => "Title",
    "price" => "Price",
    "category_id" => "Category"
  ],
  "fieldSearchable" => ["isbn", "author", "title", "price", "A.id"],
  "fieldFilterable" => [
    "category_id" => ["type" => "lookup", "modelAPI" => "categories", "view" => "name", "pick" => "id", "placeholder" => "Pilih Kategori"],
    "price" => ["type" => "value-range", "inputType" => 'number', "placeholder" => ['Harga Minimum', 'Harga Maksimum']],
  ],
  "formatter" => [
    "price" => function ($value) {return "\${$value}";}
  ],
  "inputConfig" => [
    "isbn" => ["type" => "text", "required" => true],
    "author" => ["type" => "text", "required" => true],
    "title" => ["type" => "text", "required" => true],
    "price" => ["type" => "text", "required" => true],
    "category_id" => ["type" => "lookup", "modelAPI" => "categories", "view" => "name", "pick" => "id", "required" => true]
  ],
  "actions" => function ($row) {
    echo "<div class='d-flex flex-row gap-1'>";
      echo "<a class='btn btn-info btn-sm' href='detail.php?id=".$row['id']."'>Detail</a>";
      echo "<a class='btn btn-warning btn-sm' href='form.php?view=edit&id=".$row['id']."'>Ubah</a>";
      echo "<a class='btn btn-danger btn-sm' href='delete.php?&id=".$row['id']."'>Delete</a>";
      echo "<a class='btn btn-primary btn-sm' href='/show_cart.php?id=".$row['id']."'>Add to Cart</a>";
    echo "</div>";
  },
  "allowCreate" => true
]
?>