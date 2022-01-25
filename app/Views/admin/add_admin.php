<?= $this->extend('main_template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="min-height: 2080.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Tambah Admin</h3>
                                <div class="float-sm-right">
                                    <a href="<?= base_url('main/admin') ?>" class="btn btn-sm btn-info"><i class="nav-icon fas fa-arrow-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/main/admin/save" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text" id="inputName" class="form-control  <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" name="name">
                                    <span class="error invalid-feedback"><?= $validation->getError('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Jenis Kelamin</label>
                                    <select id="inputStatus" class="form-control custom-select <?= ($validation->hasError('gender')) ? 'is-invalid' : '' ?>" name="gender">
                                        <option selected disabled>Select one</option>
                                        <option value="male">Laki-laki</option>
                                        <option value="female">Perempuan</option>
                                    </select>
                                    <span class="error invalid-feedback"><?= $validation->getError('gender'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Nomor Telp</label>
                                    <input type="text" id="phone" class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : '' ?>" name="phone">
                                    <span class="error invalid-feedback"><?= $validation->getError('phone'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Role</label>
                                    <select id="inputStatus" class="form-control custom-select <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>" name="role">
                                        <option selected disabled>Select one</option>
                                        <option value="root">Root</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <span class="error invalid-feedback"><?= $validation->getError('role'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputpass">Password</label>
                                    <input type="password" id="inputpass" class="form-control  <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" name="password">
                                    <span class="error invalid-feedback"><?= $validation->getError('password'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="passconf">Konfirmasi Password</label>
                                    <input type="password" id="passconf" class="form-control  <?= ($validation->hasError('passconf')) ? 'is-invalid' : '' ?>" name="passconf">
                                    <span class="error invalid-feedback"><?= $validation->getError('passconf'); ?></span>
                                </div>
                                
                                <button type="submit" class="btn btn-md btn-info"><i class="nav-icon fas fa-save"></i> Simpan</button>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>