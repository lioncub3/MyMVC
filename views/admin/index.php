<?php require_once("core/connection.php"); ?>
<div class="conteiner">
    <a href="admin/newCategory" class="btn btn-light">New category</a>
    <a href="admin/newProduct" class="btn btn-light">New product</a>
    <a href="admin/editUsers" class="btn btn-light">Edit user</a>
</div>
<div class="row">
    <?php
        $db = DB::connect();
        $products = $db->query("SELECT * FROM products")->fetchAll();
    foreach ($products as $row) {
        $photos = $db->query("SELECT * FROM `photos` WHERE IDProduct = $row->IDProduct")->fetchAll();
        ?>
        <div class="col-sm-4">
            <div class="card">
            <div id="photo-carousel" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner">
                              <?php
                                foreach ($photos as $index => $photo) {
                                    if ($index == 0) {
                                        ?>
                                      <div class="carousel-item active">
                                           <img class="img-product" src="<?="photos/" . $photo->Path?>" alt="Card image cap">
                                     </div>
                                      <?php
                                    } else { ?>
                               <div class="carousel-item">
                                           <img class="img-product" src="<?="photos/" . $photo->Path?>" alt="Card image cap">
                                     </div>
                                    <?php }}
                             ?>
                              </div>
                             </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $row->Name ?></h5>
                    <p class="card-text"><?= $row->Desc ?></p>
                    <a href="#" class="btn btn-primary"><?= $row->Price ?> ₴</a>
                    <form action="admin/editProduct" class="form-inline" method="POST">
                        <input class="d-none" name="idedit" type="number" value="<?= $row->IDProduct ?>"/>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                    <form class="form-inline" method="POST">
                        <input class="d-none" name="iddelete" type="number" value="<?= $row->IDProduct ?>"/>
                        <button @click="addPageShowModal" type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>