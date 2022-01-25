<?= $this->extend('main_template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="min-height: 2080.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
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
                                <h3 class="card-title">Tambah anggota</h3>
                                <div class="float-sm-right">
                                    <a href="<?= base_url('main/member') ?>" class="btn btn-sm btn-info"><i class="nav-icon fas fa-arrow-left"></i> Back</a>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/main/member/update/<?= $member['id_member']; ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" value="<?= $member['id_member'] ?>" name="id">
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text" id="inputName" class="form-control  <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" name="name" value="<?= $member['name'] ?>">
                                    <span class="error invalid-feedback"><?= $validation->getError('name'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Jenis Kelamin</label>
                                    <select id="inputStatus" class="form-control custom-select <?= ($validation->hasError('gender')) ? 'is-invalid' : '' ?>" name="gender">
                                        <option selected disabled>Select one</option>
                                        <option value="male" <?php echo ($member['gender'] == "male" ? 'selected="selected "' : ''); ?>>Laki-laki</option>
                                        <option value="female" <?php echo ($member['gender'] == "female" ? 'selected="selected "' : ''); ?>>Perempuan</option>
                                    </select>
                                    <span class="error invalid-feedback"><?= $validation->getError('gender'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal lahir</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input <?= ($validation->hasError('birth')) ? 'is-invalid' : '' ?>" data-target="#reservationdate" name="birth" value="<?= $member['date_of_birth'] ?>" />
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <span class="error invalid-feedback"><?= $validation->getError('birth'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Nomor Telp</label>
                                    <input type="text" id="phone" class="form-control <?= ($validation->hasError('phone')) ? 'is-invalid' : '' ?>" name="phone" value="<?= $member['phone'] ?>">
                                    <span class="error invalid-feedback"><?= $validation->getError('phone'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputaddress">Alamat</label>
                                    <textarea id="inputaddress" class="form-control <?= ($validation->hasError('address')) ? 'is-invalid' : '' ?>" rows="4" name="address"><?= $member['address'] ?></textarea>
                                    <span class="error invalid-feedback"><?= $validation->getError('address'); ?></span>
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