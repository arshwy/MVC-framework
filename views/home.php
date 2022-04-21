<?php include '../views/partials/navbar.php'; ?>

<br><br><br>
<div class="text-center m-auto" style="max-width: 400px;">
    <?php if(flash('fail')): ?>
        <div class="alert alert-danger"><?= flash('danger') ?></div>
    <?php endif ?>

    <?php if(flash('warning')): ?>
        <div class="alert alert-warning"><?= flash('warning') ?></div>
    <?php endif ?>

    <?php if(flash('success')): ?>
        <div class="alert alert-success"><?= flash('success') ?></div>
    <?php endif ?>
</div>

<div class="container py-5">
    <h1 class="text-center">Hello, world! this is <?= $title?> </h1>
</div>