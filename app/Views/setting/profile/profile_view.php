<?= $this->extend('main_template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="min-height: 2080.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= ucfirst($title) ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= ucfirst($menu) ?></a></li>
                        <li class="breadcrumb-item active"><?= ucfirst($title) ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
    <div class="flash-data-amount-error" data-flashdata="<?= session()->getFlashdata('amount-error'); ?>"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/assets/template/dist/img/user4-128x128.jpg" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $admin['name'] ?></h3>

                            <p class="text-muted text-center"><?= $admin['role'] ?></p>

                            <a href="#" class="btn btn-primary btn-block"><b>Koperasi Indonesia</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane active" id="settings">
                                    <form class="form-horizontal" action="/main/profile/update/<?= $admin['id_admin']; ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $admin['id_admin']; ?>">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" id="inputName" placeholder="Name" value="<?= $admin['name'] ?>" name="name">
                                                <span class="error invalid-feedback"><?= $validation->getError('name'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                            <div class="col-sm-10">
                                                <select id="inputStatus" class="form-control custom-select <?= ($validation->hasError('gender')) ? 'is-invalid' : '' ?>" name="gender">
                                                    <option selected disabled>Select one</option>
                                                    <option value="male" <?php echo ($admin['gender'] == "male" ? 'selected="selected "' : ''); ?>>Laki-laki</option>
                                                    <option value="female" <?php echo ($admin['gender'] == "female" ? 'selected="selected "' : ''); ?>>Perempuan</option>
                                                </select>
                                                <span class="error invalid-feedback"><?= $validation->getError('gender'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPhone" class="col-sm-2 col-form-label">Telp</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : '' ?>" id="inputPhone" placeholder="Phone" value="<?= $admin['phone'] ?>" name="phone">
                                                <span class="error invalid-feedback"><?= $validation->getError('phone'); ?></span>
                                            </div>
                                        </div>
                                       
                                       
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="inputPassword" placeholder="Password" name="password">
                                                <span class="error invalid-feedback"><?= $validation->getError('password'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword2" class="col-sm-2 col-form-label">Konfir Password</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control <?= ($validation->hasError('passconf')) ? 'is-invalid' : '' ?>" id="inputPassword2" placeholder="Konfirmasi Password" name="passconf">
                                                <span class="error invalid-feedback"><?= $validation->getError('passconf'); ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <?= $this->endSection() ?>