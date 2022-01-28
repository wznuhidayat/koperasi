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
            <p>Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $member['name'] ?> </p>
            <p>Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= ($member['gender'] == 'male') ? "Laki-laki" : "Perempuan" ?> </p>
            <p>Tgl Lahir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= tanggal(date($member['date_of_birth'])) ?> </p>
        </div>
        <div class="detail-right">
            <p>No Telp &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $member['phone'] ?> </p>
            <p>Transaksi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b>Ansura Pinjaman </p>
            <p>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= date('H:m', strtotime($invoice[0]['paid_at'])); ?> </p>
        </div>
    </div>
    <div>
        <div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 10%;">ID Transaksi</th>
                        <th style="width: 30%;">Periode</th>
                        <th style="width: 30%;">Status</th>
                        <th style="width: 30%;">Nominal Ansuran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoice as $invoices) : ?>
                        <tr>
                            <td style="width: 10%;"><?= $invoices['id_installment'] ?></td>
                            <td style="width: 30%;"><?= $invoices['period'] ?></td>
                            <td style="width: 30%;"><b>Lunas</b></td>
                            <td style="width: 30%;">Rp. <span style="float: right;"><?= number_format($invoices['amount'], 0, ',', '.') ?> </span></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="signature">
        <p>Gresik, <?= tanggal(date($invoice[0]['paid_at'])) ?></p>
        <br><br><br><br>
        <p>(................................)</p>
        <p><?= $admin['name']; ?></p>
    </div>

</body>

</html>