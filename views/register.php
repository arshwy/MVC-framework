

<div class="container py-5">
  <div class="row justify-content-center py-5">
    <div class="col-lg-5 col-md-6 col-sm-8">
      <h2 class="text-center"><?= $title ?></h2> <br><br>

      <form action="/create" method="post" >

        <div class="mb-3">
          <label>First Name</label>
          <input type="text" name="first_name" class="form-control <?=isset($errors['first_name']) ? "is-invalid": '';?>" 
                 value="<?= isset($old["first_name"])? $old["first_name"]: ''; ?>">
          <?php if(isset($errors['first_name'])): ?>
            <div class="text text-danger"><?= $errors['first_name'] ?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Last Name</label>
          <input type="text" name="last_name"  class="form-control <?=isset($errors['last_name']) ? "is-invalid": '';?>"
                 value="<?= isset($old["last_name"])? $old["last_name"]: ''; ?>">
          <?php if(isset($errors['last_name'])): ?>
            <div class="text text-danger"><?= $errors['last_name'] ?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Email address</label>
          <input type="email" name="email"  class="form-control <?=isset($errors['email']) ? "is-invalid": '';?>"
                 value="<?= isset($old["email"])? $old["email"]: ''; ?>">
          <?php if(isset($errors['email'])): ?>
            <div class="text text-danger"><?= $errors['email'] ?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control <?=isset($errors['password']) ? "is-invalid": '';?>" 
                 value="<?= isset($old["password"])? $old["password"]: ''; ?>">
          <?php if(isset($errors['password'])): ?>
            <div class="text text-danger"><?= $errors['password'] ?></div>
          <?php endif ?>
        </div>

        <div class="mb-3">
          <label>Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control <?=isset($errors['password_confirmation']) ? "is-invalid": '';?>"
                 value="<?= isset($old["password_confirmation"])? $old["password_confirmation"]: '';?>">
            <?php if(isset($errors['password_confirmation'])): ?>
            <div class="text text-danger"><?= $errors['password_confirmation'] ?></div>
          <?php endif ?>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>
</div>
