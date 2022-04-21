

<div class="container py-5">
  <div class="row justify-content-center py-5">
    <div class="col-lg-5 col-md-6 col-sm-8">
      <h2 class="text-center"><?= $title ?></h2> <br><br>

      <form action="/create" method="post" >

        <div class="mb-3">
          <label>First Name</label>
          <input type="text" name="first_name" class="form-control <?=error("first_name") ? "is-invalid": '';?>" 
                 value="<?=old("first_name");?>">
          <?php if(error("first_name")): ?>
            <div class="text text-danger"><?=error("first_name")?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Last Name</label>
          <input type="text" name="last_name"  class="form-control <?=error("last_name")? "is-invalid": '';?>"
                 value="<?=old("last_name");?>">
          <?php if(error("last_name")):?>
            <div class="text text-danger"><?=error("last_name")?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Email address</label>
          <input type="email" name="email"  class="form-control <?=error("email") ? "is-invalid": '';?>"
                 value="<?=old("email");?>">
          <?php if(error("email")): ?>
            <div class="text text-danger"><?=error("email")?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control <?=error("password") ? "is-invalid": '';?>" 
                 value="<?=old("password");?>">
          <?php if(error("password")): ?>
            <div class="text text-danger"><?=error("password")?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control <?=error("password_confirmation") ? "is-invalid": '';?>"
                 value="<?=old("password_confirmation");?>">
          <?php if(error("password_confirmation")): ?>
            <div class="text text-danger"><?=error("password_confirmation")?></div>
          <?php endif ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>
</div>