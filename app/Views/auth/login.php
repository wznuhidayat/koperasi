<?= $this->extend('auth_template') ?>

<?= $this->section('content') ?>
<div class="login-box">
  <div class="login-logo">
    <h2>Koperasi Indonesia</h2>
  </div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login</p>
      <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
          <?= session()->getFlashdata('error'); ?>
        </div>
      <?php endif ?>
      <form action="<?= site_url('auth/loginprocess') ?>" method="post">
        <?= csrf_field() ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control <?= ($validation->hasError('id_admin')) ? 'is-invalid' : '' ?>" placeholder="ID Admin" name="id_admin" id="InputAdmin">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-id-card"></span>
            </div>
          </div>
          <span id="InputAdmin-error" class="error invalid-feedback"><?= $validation->getError('id_admin'); ?></span>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" placeholder="Password" name="password" id="exampleInputPassword1">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <span id="exampleInputPassword1-error" class="error invalid-feedback"><?= $validation->getError('password'); ?></span>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <!-- <p class="mb-3 mt-2">
        <a href="forgot-password.html">Lupa password?</a>
      </p>
       -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<?= $this->endSection() ?>