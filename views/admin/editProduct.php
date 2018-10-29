<?php ?>
<form method="POST">
    <input name="productid" type="hidden" value="<?=$p->IDProduct?>">
  <div class="form-group">
    <input placeholder="Name" name="productname" type="text" class="form-control" 
    value="<?=$p->Name?>">
  </div>
  <div class="form-group">
    <input name="productprice" type="number" class="form-control" placeholder="Price"
    value="<?=$p->Price?>">
  </div>
  <div class="form-group">
    <input name="productcount" type="text" class="form-control" placeholder="Count"
    value="<?=$p->Count?>">
  <div class="form-group">
    <input name="productdesc" type="text" class="form-control" placeholder="Desc"
    value="<?=$p->Desc?>">
  </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Categorys</label>
        <select name="productcategory" class="form-control" id="exampleFormControlSelect1">
            <?php foreach ($categorys as $category)
            { ?>
                <option><?=$category->NameCategory?></option>
            <?php } ?>
        </select>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>