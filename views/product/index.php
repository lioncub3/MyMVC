<div class="row">
<?php 
require_once("db.config.php");

try {
  $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password);
  $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $products = $dbh->query("SELECT * FROM products")->fetchAll();
} catch (Exception $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}

  foreach ($products as $row) {
    ?>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?=$row->Name?></h5>
        <p class="card-text"><?=$row->Desc?></p>
        <a href="#" class="btn btn-primary"><?=$row->Price ?></a>
      </div>
    </div>
  </div>
  <?php

}
$dbh = null;
?>
</div>