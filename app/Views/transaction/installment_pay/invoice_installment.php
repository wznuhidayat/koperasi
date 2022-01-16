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


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- Table row -->
                        <h2 class="text-center">Koperasi Indonesia</h2>
                        <h4 class="text-center">From
                            Admin, Inc.
                            795 Folsom Ave, Suite 600
                            San Francisco, CA 94107
                            Phone: (804) 123-5432
                            Email: info@almasaeedstudio.com</h4>
                        <hr>
                        <div class="detail row">
                            <div class="col-6 detail-left">
                                <p>Nama &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : <?= $member['name'] ?> </p>
                                <p>Jenis Kelamin &emsp; : <?= ($member['gender'] == 'male') ? "Laki-laki" : "Perempuan" ?> </p>
                                <p>Tgl Lahir &emsp;&emsp;&emsp;&nbsp; : <?= tanggal(date($member['date_of_birth'])) ?> </p>
                            </div>
                            <div class="col-6 detail-right">
                                <p>No Telp &emsp;&emsp;&ensp;&nbsp; : <?= $member['phone'] ?> </p>
                                <p>Transaksi &emsp;&emsp; : <b>Ansuran Pinjaman</b> </p>
                                <p>Jam &emsp;&emsp;&emsp;&emsp;&nbsp; : <?= date('H:m', strtotime($invoice[0]['paid_at'])); ?> </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No Transaksi</th>
                                            <th>Periode</th>
                                            <th>Status</th>
                                            <th>Nominal Ansuran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($invoice as $invoices) : ?>
                                            <tr>
                                                <td><?= $invoices['id_installment'] ?></td>
                                                <td><?= $invoices['period'] ?></td>
                                                <td><span class='badge badge-success'>Lunas</span></td>
                                                <td>Rp. <?= number_format($invoices['amount'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <hr>
                        <div class="row mt-4">
                            <!-- accepted payments column -->
                            <div class="col-4">

                            </div>
                            <div class="col-4"></div>
                            <!-- /.col -->
                            <div class="col-4">
                                <p class="lead text-center">Admin</p>
                                <br><br><br><br>
                                <p class="text-center">(.....................................)</p>
                                <p class="foot text-center"><?= $admin['name']; ?></p>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <form action="/main/printinstallment/" method="POST">
                                    <input type="hidden" name="id_admin" value="<?= $admin['id_admin'] ?>">
                                    <?php foreach ($invoice as $invoices) : ?>
                                        <input type="hidden" name="id[]" value="<?= $invoices['id_installment'] ?>">
                                    <?php endforeach ?>
                                    <input type="hidden" name="id_member" value="<?= $member['id_member'] ?>">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-print"></i></button>
                                </form>
                                <button type="button" class="btn btn-success float-right"><i class="far fa-check-circle"></i> Done
                                </button>

                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <?= $this->endSection() ?>