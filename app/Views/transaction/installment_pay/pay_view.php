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
    <div>
    </div>
    <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Ansuran</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group input-group ">
                                        <input type="text" class="form-control" placeholder="Masukkan ID Anggota!" id="id_member" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                        <span class="input-group-append ml-1">
                                            <button type="button" class="btn btn-info btn-flat search-installment"><i class="fas fa-search"></i></button>
                                        </span>
                                        <span class="error invalid-feedback"> ID anggota tidak ditemukkan! </span>
                                    </div>
                                </div>

                            </div>
                            <!-- <div class="form-group row">
                                <label for="name_member" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name_member" placeholder="Nama Anggota" disabled>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <form id="form-installment" method="POST">
                                        <pre id="view-row"></pre>
                                       
                                        <table class="table table-bordered table-hover" id="listloantable">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>No Transaksi</th>
                                                    <th>No Pinjaman</th>
                                                    <th>Period</th>
                                                    <th>Nominal Ansuran</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>

                                        </table>
                                        <button class="btn btn-info"  type="button">Select</button>
                                    </form>
                                </div>
                            </div>


                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <?= $this->endSection() ?>