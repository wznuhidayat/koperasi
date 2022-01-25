<?= $this->extend('auth_template') ?>

<?= $this->section('content') ?>
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>/assets/template/index2.html"><b>Koperasi</b></a>
  </div>
  <div class="flash-data-amount-error" data-flashdata="<?= session()->getFlashdata('amount-error'); ?>"></div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login</p>

      <form action="<?= site_url('auth/loginprocess')?>" method="post">
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