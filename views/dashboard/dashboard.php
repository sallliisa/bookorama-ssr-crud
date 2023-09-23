<?php
require_once('../../lib/db.php');
$bookCategoryAggregate = db_list("SELECT
                                    categories.name AS category_name,
                                    COUNT(*) AS count
                                  FROM books LEFT JOIN categories ON books.category_id = categories.id
                                  GROUP BY books.category_id
                              ");

$bookCategoryList = db_list("SELECT
                              c.name AS category_name,
                              b.isbn AS book_isbn,
                              b.title AS book_title,
                              b.author as book_author,
                              b.price as book_price
                            FROM categories c
                            LEFT JOIN books b ON c.id = b.category_id
                            ORDER BY c.name, b.title
                          ");

$orderCategoryAggregate = db_list("SELECT
                                    categories.name AS category_name,
                                    COUNT(*) AS count
                                  FROM order_items LEFT JOIN books ON order_items.isbn = books.isbn LEFT JOIN categories ON books.category_id = categories.id
                                  GROUP BY books.category_id
                                ");
?>

<?php require('../../lib/layouts/header.php'); ?>
<h4 class="text-primary">Dashboard</h4>
<div class="card mt-5">
  <div class="card-header">Buku per Kategori</div>
  <div class="card-body">
    <canvas id="category-chart"></canvas>
    <table class="table table-striped">
      <tr>
        <th>Category</th>
        <th>ISBN</th>
        <th>Title</th>
        <th>Author</th>
        <th>Price</th>
      </tr>
      <?php
        $currentCategory = null;
        foreach ($bookCategoryList as $row) {
          if ($currentCategory !== $row['category_name']) {
            echo '<tr>';
            echo "<td>{$row['category_name']}</td>";
            $currentCategory = $row['category_name'];
          } else {
            echo '<tr>';
            echo '<td></td>';
          }
          echo "<td>{$row['book_isbn']}</td>";
          echo "<td>{$row['book_title']}</td>";
          echo "<td>{$row['book_author']}</td>";
          echo "<td>\${$row['book_price']}</td>";
          echo '</tr>';
        }
      ?>
    </table>
  </div>
</div>
<div class="card mt-4">
  <div class="card-header">Order per Kategori</div>
  <div class="card-body">
    <canvas id="order-chart"></canvas>
  </div>
</div>

<script>
var categoryCtx = document.getElementById('category-chart').getContext('2d');
var categoryChart = new Chart(categoryCtx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode(array_map(function ($item) {return $item['category_name'];}, $bookCategoryAggregate)); ?>,
      datasets: [{
        label: 'Total Books',
        data: <?php echo json_encode(array_map(function ($item) {return $item['count'];}, $bookCategoryAggregate)); ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Number of Books'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Category'
          }
        }
      }
    }
});

var orderCtx = document.getElementById('order-chart').getContext('2d');
var orderChart = new Chart(orderCtx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode(array_map(function ($item) {return $item['category_name'];}, $orderCategoryAggregate)); ?>,
      datasets: [{
        label: 'Total Books',
        data: <?php echo json_encode(array_map(function ($item) {return $item['count'];}, $orderCategoryAggregate)); ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Number of Books'
          }
        },
        x: {
          title: {
            display: true,
            text: 'Category'
          }
        }
      }
    }
});
</script>

<?php require('../../lib/layouts/footer.php'); ?>