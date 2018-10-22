<?php ?>
<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th>Login</th>
      <th>Email</th>
      <th>Permission</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($users as $user) 
      { ?>
    <tr>
      <th scope="row"><?=$user->Name?></th>
      <td><?=$user->Email?></td>
      <td>
        <form method="POST">
            <input name="id" type="hidden" value="<?=$user->IDUser?>"/>
            <div class="form-check">
                <label class="form-check-label">
                    <input name="permission" value="0" type="radio" class="form-check-input" <?php if ($user->Admin == false) { ?> checked <?php }?>/>User
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input name="permission" value="1" type="radio" class="form-check-input" <?php if ($user->Admin == true) { ?> checked <?php }?>/>Admin
                </label>
            </div>
            <button type="submit" class="btn btn-success form-inline">Save</button>
      </form>
      </td>
    </tr> 
    <?php }?>
  </tbody>
</table>