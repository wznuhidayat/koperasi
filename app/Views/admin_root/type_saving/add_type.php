<?= $this->extend('main_template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="min-height: 2080.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipe Simpanan</h1>
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
                            <h3 class="card-title">Tambah Tipe Simpanan</h3>
                            <div class="float-sm-right">
                                <a href="<?= base_url('main/typesaving') ?>" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/main/typesaving/save" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text" id="inputName" class="form-control  <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" name="name">
                                    <span class="error invalid-feedback"><?= $validation->getError('name'); ?></span>
                                </div>
                             
                                <div class="form-group">
                                    <label for="inputdescription">Deskripsi</label>
                                    <textarea id="inputdescription" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>" rows="4" name="description"></textarea>
                                    <span class="error invalid-feedback"><?= $validation->getError('description'); ?></span>
                                </div>
                               

                                <button type="submit" class="btn btn-md btn-primary"><i class="nav-icon fas fa-save"></i> Simpan</button>
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