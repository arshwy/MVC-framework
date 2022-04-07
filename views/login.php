


<div class="container py-5">
  <div class="row justify-content-center my-5 py-5">
    <div class="col-lg-5 col-md-6 col-sm-8">
      <h2 class="text-center"><?= $title ?></h2> <br><br>
      <form action="/check" method="post">
        <div class="mb-3">
          <label>Email address</label>
          <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>