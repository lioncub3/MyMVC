<?php require_once("core/connection.php"); ?>
<div id="accordion">
<?php foreach ($orders as $key => $order):
    $db = DB::connect();
    $user = $db->query("SELECT Name FROM `users` WHERE IDUser = " . $order->IDUser . "")->fetch();
    $idproducts = $db->query("SELECT IDProduct FROM `productsorders` WHERE IDOrder = " . $order->IDOrder . "")->fetchAll();
    ?>
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#<?=$key?>" aria-expanded="true" aria-controls="<?=$key?>">
          <?= $order->IDOrder ?> <?= $user->Name ?>
        </button>
      </h5>
    </div>

    <div id="<?=$key?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
            <div class="conteiner">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>IDProduct</th>
                            <th>Name</th>
                            <th>Desc</th>
                            <th>Price</th>
                            <th>Count</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($idproducts as $idproduct): 
                            $product = $db->query("SELECT * FROM `products` WHERE IDProduct = " . $idproduct . "")->fetch();
                            var_dump($product);
                            ?>
                            <tr>
                                <td><?=$product->IDProduct?></td>
                                <td><?=$product->Name?></td>
                                <td><?=$product->Desc?></td>
                                <td><?=$product->Price?></td>
                                <td><?=$product->Count?></td>
                                <td><?=$product->Category?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
      </div>
    </div>
  </div>
<?php endforeach;?>
</div>