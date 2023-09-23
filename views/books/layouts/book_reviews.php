<?php
  $res = db_list("SELECT * FROM book_reviews WHERE book_id='".$_GET['id']."'");

  if (isset($_POST["submit"])) {
    db_insert('book_reviews', ["book_id" => $_GET['id'], "review" => $_POST['review']]);
  }
?> 


<div class="card mt-4">
  <div class="card-header">Reviews</div>
  <div class="card-body d-flex flex-column gap-4">
    <form method="POST" action="<?= 'detail.php?id=' . $_GET['id'] ?>">
      <div class="input-group d-flex align-items-center gap-2">
        <textarea class="form-control" name="review" placeholder="Write a review..." required></textarea>
        <div class="input-group-append">
          <button type="submit" class="btn btn-primary mt-4" name="submit" value="submit">Submit</button>
        </div>
      </div>
    </form>
    <div class="d-flex flex-column gap-2">
      <?php
        foreach ($res as $row) {
          echo "<div class='card font-italic bg-light p-2'>";
          echo '"'.$row['review'].'"';
          echo "</div>";
        }
      ?>
    </div>
  </div>
</div>