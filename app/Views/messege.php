<?php if (session()->getFlashdata('success')) : ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Saved.</h5>
    <?= session()->getFlashdata('success'); ?>
</div>
<?php endif ?>
<?php if (session()->getFlashdata('edited')) : ?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-pencil-alt"></i> Edited.</h5>
    <?= session()->getFlashdata('edited'); ?>
</div>
<?php endif ?>
<?php if (session()->getFlashdata('deleted')) : ?>
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-trash"></i> Deleted!</h5>
    <?= session()->getFlashdata('deleted'); ?>
</div>
<?php endif ?>