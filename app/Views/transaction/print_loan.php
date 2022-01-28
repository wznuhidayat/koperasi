<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    h2 {
      font-size: 35px;
      font-weight: 700;
      margin-bottom: -10px;
    }

    table,
    th,
    td {
      border: 1px solid black;
    }

    hr {
      border: 1px solid black;
    }

    th {
      text-align: center;
      background-color: grey;
      color: white;
    }

    td {
      text-align: left;
      padding-left: 5px;
      padding-right: 5px;
    }

    td:first-child {
      text-align: center;
    }


    .detail {
      width: 100%;

    }

    .detail-left {
      width: 50%;
      float: left;
    }

    .detail-right {
      width: 50%;
      display: inline;
    }

    .signature {
      margin-top: 10px;
      width: 250px;
      float: right;
      padding-right: 5px;
      padding-left: 5px;
      text-align: center;
    }
  </style>
</head>

<body>
  <h2 class="text-center"><?= $setting['title'] ?></h2>
  <h4 class="text-center">
    <?= $setting['address'] ?>
    <br>
    <?= $setting['contact'] ?>
  </h4>
  <hr>
  <div class="detail">
    <div class="detail-left">
      <p>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $invoice['name'] ?> </p>
      <p>Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= ($invoice['gender'] == 'male') ? "Laki-laki" : "Perempuan" ?> </p>
      <p>Tgl Lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= tanggal(date($invoice['date_of_birth'])) ?> </p>
    </div>
    <div class="detail-right">
      <p>No Telp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $invoice['phone'] ?> </p>
      <p>Transaksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>Pinjam Tunai</b> </p>
      <p>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= date('H:m', strtotime($invoice['loan_created'])); ?> </p>
    </div>
  </div>
  <div>
    <div>
      <table style="width: 100%;">
        <thead>
          <tr>
            <th style="width: 10%;">ID Transaksi</th>
            <th style="width: 20%;">Kebutuhan</th>
            <th style="width: 20%;">Jumlah Pinjaman</th>
            <th style="width: 20%;">Lama Ansuran</th>
            <th style="width: 10%;">Bunga</th>
            <th style="width: 20%;">Ansuran Perbulan</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="width: 10%;"><?= $invoice['id_loan'] ?></td>
            <td style="width: 20%;"><?= $invoice['name'] ?></td>
            <td style="width: 20%;">Rp. <span style="float: right;"><?= number_format($invoice['amount'], 0, ',', '.') ?></td>
            <td style="width: 20%;"><?= $invoice['installment_term']; ?> <span style="float: right;">kali</span></td>
            <td style="width: 10%;"><span style="float: right;"><?= $invoice['installment_fee']; ?> %</span></td>
            <td style="width: 20%;">Rp. <span style="float: right;"><?= number_format($invoice['installment_amount'], 0, ',', '.') ?> </span></td>
          </tr>

        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="signature">
    <p>Gresik, <?= tanggal(date($invoice['created_at'])) ?></p>
    <br><br><br><br>
    <p>(................................)</p>
    <p><?= $invoice['admin_name']; ?></p>
  </div>

</body>

</html>