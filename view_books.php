<?php
    require_once('./lib/db.php');
    require_once('./configs/books.php');
    $res = db_query("SELECT * FROM books", null, null);
?>

<?php include('./header.php') ?>
<div class="card mt-5">
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <table class="table table-striped">
            <tr>
                <?php
                    foreach ($config['fields'] as $field) {
                        echo "<th>";
                        if (isset($config["fieldsAlias"][$field])) {
                            echo $config["fieldsAlias"][$field];
                        } else {
                            echo $field;
                        }
                        echo "</th>";
                    }
                    if ($config["withAction"]) {
                        echo "<th>Action</th>";
                    }
                ?>
            </tr>
            <?php
                foreach ($res as $row) {
                    echo '<tr>';
                    foreach ($config['fields'] as $field) {
                        echo "<td>";
                        if (isset($config['formatter'][$field])) {
                            echo $config['formatter'][$field]($row[$field]);
                        } else {
                            echo $row[$field];
                        }
                        echo "</td>";
                    }
                    if ($config['withAction']) {
                        echo "<td><a class='btn btn-primary btn-sm' href='show_cart.php?id=".$row['isbn']."'>Add to Cart</a></td>";
                    }
                    echo '</tr>';
                }
                echo '</table>';
                echo '<br />';
                echo "Total Rows: ". count($res);
            ?>
    </div>
</div>
<?php include('./footer.php') ?>