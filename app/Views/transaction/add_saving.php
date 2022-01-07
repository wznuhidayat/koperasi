<?= $this->extend('main_template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="min-height: 2080.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setor Tunai</h1>
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
                            <h3 class="card-title">Setor Tunai</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group input-group ">
                                        <input type="text" class="form-control" placeholder="Masukkan ID Anggota!" id="id_member">
                                        <span class="input-group-append ml-1">
                                            <button type="button" class="btn btn-info btn-flat search-saving"><i class="fas fa-search"></i></button>
                                        </span>
                                        <span class="error invalid-feedback"> ID anggota tidak ditemukkan! </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name_member" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name_member" placeholder="Nama Anggota" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">No Telp</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="telp" placeholder="No telp" disabled>
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
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-10 gender">
                                            <select class="form-control" disabled="">
                                                <option value="null">- not selected -</option>
                                                <option value="male">Laki-laki</option>
                                                <option value="female">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-2 col-form-label">Tgl lahir</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="birth" placeholder="Tanggal lahir" disabled>
                                        </div>
                                    </div>
                                    <hr>
                                    <form action="/main/addsaving/save" method="post">
                                        <?= csrf_field() ?>
                                        <div class="form-group row">
                                            <input type="hidden" id="id_member_hidden" name="id_member">
                                            <input type="hidden" id="id_admin" name="id_admin" value="<?= session()->get('id_admin') ?>">
                                            <label for="deposit" class="col-sm-2 col-form-label">Setor</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control  <?= ($validation->hasError('amount')) ? 'is-invalid' : '' ?>" id="telp" placeholder="Masukkan nominal" name="amount">
                                                <span class="error invalid-feedback"><?= $validation->getError('amount'); ?></span>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="" class="col-sm-2 col-form-label">Jenis </label>
                                            <div class="col-sm-10">
                                                <?= form_dropdown('id_saving_type', $type, $selected, ['class' => 'form-control show-tick', 'required' => 'required']) ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-sm-2 col-form-label">Note</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" rows="3" placeholder="Deskripsi" id="description" name="description"></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block">Setor</button>
                                    </form>
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