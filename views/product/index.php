<div class="row">
    <?php
        $db = DB::connect();
        $products = $db->query("SELECT * FROM products")->fetchAll();
    foreach ($products as $row) {
        $photos = $db->query("SELECT * FROM `photos` WHERE IDProduct = $row->IDProduct")->fetchAll();
        $json = json_encode($row);
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
                    <div class="d-none product_data"><?= $json ?></div>
                    <button @click="addProdBasket('<?=$row->IDProduct?>', '<?=$row->Name?>', 
                    '<?=$row->Desc?>', '<?=$row->Price?>', '<?=$row->CategoryName?>')"
                    class="btn btn-success"><?= $row->Price ?> ₴</button>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>