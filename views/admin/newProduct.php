<div class="container">   
<form method="POST" class="form-inline my-2 my-lg-0" enctype="multipart/form-data">
<input name="productname" class="form-control mr-sm-2" type="text" placeholder="Name">
<input name="productprice" class="form-control mr-sm-2" type="number" placeholder="Price">
<input name="productdesc" class="form-control mr-sm-2" type="text" placeholder="Description">
<input name="productcategory" class="form-control mr-sm-2" type="text" placeholder="Category">
<input name="photos[]" class="form-control mr-sm-2" type="file" accept="image/x-png,image/gif,image/jpeg" required multiple/>
<button class="btn btn-success" type="submit">Send</button>
</form>