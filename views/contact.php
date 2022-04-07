<?php include '../views/partials/navbar.php'; ?>


<div class="container py-5">
  <h1>Welcome in  <?= $title ?> </h1>
  <br>
  <form action="/contact" method="post" >
    <div class="mb-3">
      <label>Email address</label>
      <input type="email" class="form-control" name="email">
    </div>
    <div class="mb-3">
      <label>Subject</label>
      <input type="text" name="subject" class="form-control">
    </div>
    <div class="mb-3">
      <label>Body</label>
      <textarea name="body" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
