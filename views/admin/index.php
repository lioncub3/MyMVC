<div class="conteiner">
    <a href="admin/newCategory" class="btn btn-light">New category</a>
    <a href="admin/newProduct" class="btn btn-light">New product</a>
</div>
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
        <h5 class="card-title"><?php echo $row["Name"]; ?></h5>
        <p class="card-text"><?php echo $row["Desc"]; ?></p>
        <a href="#" class="btn btn-primary"><?php echo $row["Price"]; ?></a>
        <form class="form-inline" method="POST">
        <input class="d-none" name="idedit" type="number" value="<?php echo $row["IDProduct"];?>"/>
        <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        <form class="form-inline" method="POST">
        <input class="d-none" name="iddelete" type="number" value="<?php echo $row["IDProduct"];?>"/>
        <button @click="addPageShowModal" type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
  <div class="modal" v-bind:style="{display:showEditModalDisplay}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit</h4>
                                            <button @click="hideAddPageModal" type="button" data-dismiss="modal">&times;</button>
                                        </div>

                                        <form method="POST">
                                        <div class="modal-body">
                                            <input name="name" value="<?php echo $row["Name"];?>" class="form-control" placeholder="Name" />
                                            <input name="price" value="<?php echo $row["Price"];?>" class="form-control" placeholder="Price" />
                                            <input name="desc" value="<?php echo $row["Desc"];?>" class="form-control" placeholder="Desc" />
                                        </div>

                                        <div class="modal-footer">
                                            <button @click="hideAddPageModal" type="submit" class="btn btn-primary">Change</button>
                                        </div>
                                        </form>

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