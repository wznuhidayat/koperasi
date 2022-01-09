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
                <p>Nama &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; : <?= $invoice['name'] ?> </p>
                <p>Jenis Kelamin &emsp;  : <?= ($invoice['phone'] == 'male') ? "Laki-laki" : "Perempuan" ?> </p>
                <p>Tgl Lahir &emsp;&emsp;&emsp;&nbsp; : <?= tanggal(date($invoice['date_of_birth'])) ?> </p>
              </div>
              <div class="col-6 detail-right">
                <p>No Telp &emsp;&emsp;&ensp;&nbsp; : <?= $invoice['phone'] ?> </p>
                <p>Transaksi &emsp;&emsp; : <b>Setor tunai</b> </p>
                <p>Jam &emsp;&emsp;&emsp;&emsp;&nbsp; : <?= date('H:m', strtotime($invoice['loan_created'])); ?> </p>
              </div>
            </div>
            <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No Transaksi</th>
                      <th>Kebutuhan</th>
                      <th>Jumlah Uang</th>
                      <th>Jumlah Ansuran</th>
                      <th>Bunga</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?= $invoice['id_loan'] ?></td>
                      <td><?= $invoice['name'] ?></td>
                      <td>Rp. <?= number_format($invoice['amount'], 0, ',', '.') ?></td>
                      <td><?= $invoice['installment_term'] ?></td>
                      <td><?= $invoice['installment_fee'] ?>%</td>
                    </tr>

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
                <p class="foot text-center"><?= $invoice['admin_name']; ?></p>

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="/main/printloan/<?= $invoice['id_loan']; ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                <button type="button" class="btn btn-success float-right"><i class="far fa-check-circle"></i> Done
                </button>
                <button type="button" class="btn btn-info float-right" style="margin-right: 5px;">
                  <i class="fas fa-print"></i> Print
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