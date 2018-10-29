<?php ?>
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
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(product, index) in products">
        <td>{{product.idproduct}}</td>
        <td>{{product.name}}</td>
        <td>{{product.desc}}</td>
        <td>{{product.price}}</td>
        <td>{{product.count}}</td>
        <td>{{product.category}}</td>
        <td><button @click="deleteProduct" class="btn btn-danger">X</button></td>
      </tr> 
    </tbody>
  </table>
</div>
<div class="container">
  <form method="POST">
    <input name="userid" type="hidden" value="<?=$_SESSION["id"]?>"/>
    <input name="productsbasket" type="hidden" v-bind:value="string_products"/>
    <button class="btn btn-success" type="submit">Buy</button>
  </form>
</div>