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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="/img/admin/default.png" alt="User profile picture">
                            </div>
                            <input type="hidden" id="id_member" value="<?= $member['id_member'] ?>">
                            <h3 class="profile-username text-center"><?= $member['name'] ?></h3>

                            <p class="text-muted text-center"><?= $saldo ?></p>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tentang Anggota</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Tgl Lahir</strong>

                            <p class="text-muted">
                                <?= tanggal(date($member['date_of_birth'])); ?>
                            </p>

                            <hr>
                            <strong><i class="fas fa-book mr-1"></i> Jenis Kelamin</strong>

                            <p class="text-muted"> <?= ($member['gender'] == 'male') ? 'Laki-laki' : 'Perempuan'; ?> </p>

                            <hr>
                            <strong><i class="fas fa-pencil-alt mr-1"></i> No Telp</strong>

                            <p class="text-muted">
                                <?= $member['phone']; ?>
                            </p>

                            <hr>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat </strong>

                            <p class="text-muted"> <?= $member['address']; ?></p>

                            <hr>



                            <strong><i class="far fa-file-alt mr-1"></i> Tanggal pendaftaran</strong>

                            <p class="text-muted"><?= tanggal(date($member['created_at'])); ?></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#saving" data-toggle="tab">Setor</a></li>
                                <li class="nav-item"><a class="nav-link" href="#withdraw" data-toggle="tab">Penarikkan</a></li>
                                <li class="nav-item"><a class="nav-link" href="#loan" data-toggle="tab">Pinjaman</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="saving">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="saving-id" class="table table-bordered table-hover">
                                                    <?= csrf_field() ?>
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>ID Simpanan</th>
                                                            <th>Nama</th>
                                                            <th>Tipe Simpanan</th>
                                                            <th>Nominal</th>
                                                            <th>Tgl Simpan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <?php $request = \Config\Services::request(); ?>

                                                    <tbody id="<?= $request->uri->getSegment(2); ?>">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>ID Simpanan</th>
                                                            <th>Nama</th>
                                                            <th>Tipe Simpanan</th>
                                                            <th>Nominal</th>
                                                            <th>Tgl Simpan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="withdraw">
                                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="wd-id" class="table table-bordered table-hover">
                                                    <?= csrf_field() ?>
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>ID Penarikan</th>
                                                            <th>Nama</th>
                                                            <th>Nominal</th>
                                                            <th>Tgl Penarikan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <?php $request = \Config\Services::request(); ?>

                                                    <tbody id="<?= $request->uri->getSegment(2); ?>">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>ID Penarikan</th>
                                                            <th>Nama</th>
                                                            <th>Nominal</th>
                                                            <th>Tgl Penarikan</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="loan">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
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