<div class="container">   
<form method="POST" enctype="multipart/form-data">
<div class="form-group">
<input name="productname" class="form-control" type="text" placeholder="Name">
</div>
<div class="form-group">
<input name="productprice" class="form-control" type="number" placeholder="Price">
</div>
<div class="form-group">
<input name="productdesc" class="form-control mr-sm-2" type="text" placeholder="Description">
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
  <div class="form-group">

</div>
<input name="photos[]" class="form-control mr-sm-2" type="file" accept="image/x-png,image/gif,image/jpeg" required multiple/>
<button class="btn btn-success" type="submit">Send</button>
</form>