<?php
// File         : show_cart.php
// Deskripsi    : Untuk menambahkan item ke shopping cart dan menampilkan isi shopping cart

session_start();
error_reporting(0);

$id = $_GET['id'];
if ($id != '') {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }
}

echo json_encode($_SESSION['cart'])

?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Shopping Cart</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>
            <?php
            require_once('./lib/db.php');
            $sum_qty = 0;
            $sum_price = 0;

            if (is_array($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $res = db_query("SELECT * FROM books WHERE id='$id'");

                    foreach ($res as $row) {
                        echo '<tr>';
                        echo '<td>' . $row['isbn'] . '</td>';
                        echo '<td>' . $row['author'] . '</td>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>$' . $row['price'] . '</td>';
                        echo '<td>' . $qty . '</td>';
                        echo '<td>$' . $row['price'] * $qty . '</td>';
                        echo '</tr>';

                        $sum_qty = $sum_qty + $qty;
                        $sum_price = $sum_price + ($row['price'] * $qty);
                    }
                }
                echo '<tr><td></td><td></td><td></td><td></td><td></td><td>$' . $sum_price . '</td>';
            } else {
                echo '<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';
            }
            ?>
        </table>
        Total items = <?php echo $sum_qty ?><br><br>
        <a class="btn btn-primary" href="/views/books/list.php">Continue Shopping</a>
        <a class="btn btn-danger" href="/lib/services/delete_cart.php">Empty Cart</a>
    </div>
</div>
<?php include('./footer.php') ?>