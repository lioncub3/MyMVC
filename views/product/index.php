<div class="row">
<?php 
require_once("db.config.php");
try {
  $dbh = new PDO('mysql:host=' . servername . ';dbname=' . database . '', username, password);
  foreach ($dbh->query("SELECT *from Products") as $row) {
    ?>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php print_r($row["Name"]); ?></h5>
        <p class="card-text"><?php print_r($row["Desc"]); ?></p>
        <a href="#" class="btn btn-primary"><?php print_r($row["Price"]); ?></a>
      </div>
    </div>
  </div>
  <?php

}
$dbh = null;
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>
</div>