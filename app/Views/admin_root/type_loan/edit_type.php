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
                            <h3 class="card-title">Tambah anggota</h3>
                            <div class="float-sm-right">
                                <a href="<?= base_url('main/typeloan') ?>" class="btn btn-sm btn-primary"><i class="nav-icon fas fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="/main/typeloan/update/<?= $type['id_loan_type']; ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" value="<?= $type['id_loan_type'] ?>" name="id">
                                <div class="form-group">
                                    <label for="inputName">Nama</label>
                                    <input type="text" id="inputName" class="form-control  <?= ($validation->hasError('name_type')) ? 'is-invalid' : '' ?>" name="name" value="<?= $type['name_type'] ?>">
                                    <span class="error invalid-feedback"><?= $validation->getError('name_type'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputLoanTerm">Lama Angsuran</label>
                                    <input type="text" id="inputLoanTerm" class="form-control  <?= ($validation->hasError('loan_term')) ? 'is-invalid' : '' ?>" name="loan_term" value="<?= $type['loan_term'] ?>">
                                    <span class="error invalid-feedback"><?= $validation->getError('loan_term'); ?></span>
                                </div>
                                <div class="form-group">
                                    <label for="inputdescription">Alamat</label>
                                    <textarea id="inputdescription" class="form-control <?= ($validation->hasError('description')) ? 'is-invalid' : '' ?>" rows="4" name="description" ><?= $type['description'] ?></textarea>
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