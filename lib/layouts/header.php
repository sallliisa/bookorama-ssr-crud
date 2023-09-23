<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Bookorama</title>
</head>

<body>
    <div class="w-100 p-4 bg-light d-flex flex-row justify-content-between align-items-center">
        <div>Bookorama</div>
        <div class="d-flex flex-row align-items-center gap-2">
            <?php
                $menu = [
                    "Dashboard" => "/views/dashboard/dashboard.php",
                    "Books" => "/views/books/list.php",
                    "Customers" => "/views/customers/list.php",
                    "Orders" => "/views/orders/list.php",
                    "Categories" => "/views/categories/list.php",
                ];
                foreach ($menu as $name => $url) {
                    echo "<a class='nav-link' href='{$url}'>{$name}</a>";
                }
            ?>
        </div>
    </div>
    <div class="container">