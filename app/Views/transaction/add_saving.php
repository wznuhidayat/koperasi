<?= $this->extend('main_template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="min-height: 2080.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stor Tunai</h1>
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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah anggota</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group input-group ">
                                        <input type="text" class="form-control" placeholder="Masukkan ID Anggota!" id="id_member">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat search"><i class="fas fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name_member" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="name_member" placeholder="Nama Anggota" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name_member" class="col-sm-2 col-form-label">No Telp</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="telp" placeholder="Nama Anggota" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="3" placeholder="Alamat" disabled="" id="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="callout callout-info">
                                        <h5><i class="fas fa-money-bill-wave-alt"></i> Saldo:</h5>
                                        <h3>Rp. 200,000</h3>
                                    </div>
                                </div>
                            </div>

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