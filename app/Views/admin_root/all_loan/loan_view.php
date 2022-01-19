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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Daftar Pinjaman</h3>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <?= $this->include('messege') ?>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="allloan-table" class="table table-bordered table-hover">
                                            <?= csrf_field() ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID Pinjaman</th>
                                                    <th>Nama</th>
                                                    <th>Jumlah Ansuran</th>
                                                    <th>Nominal Pinjaman</th>
                                                    <th>Tgl Pinjaman</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php $request = \Config\Services::request(); ?>

                                            <tbody id="<?= $request->uri->getSegment(2); ?>">
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID Pinjaman</th>
                                                    <th>Nama</th>
                                                    <th>Jumlah Ansuran</th>
                                                    <th>Nominal Pinjaman</th>
                                                    <th>Tgl Pinjaman</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
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
 
    <?= $this->endSection() ?>