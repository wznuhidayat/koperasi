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
    <!-- Main content -->
    <div class="flash-data-success" data-flashdata="<?= session()->getFlashdata('success'); ?>"></div>
    <div class="flash-data-amount-error" data-flashdata="<?= session()->getFlashdata('amount-error'); ?>"></div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Setting Aplikasi</h3>
                </div>
                <div class="card-body">
                    <form action="/main/settings/update" method="post">
                        <div class="form-group row">
                            <label for="inputNameApp" class="col-sm-2 col-form-label">Nama Aplikasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputNameApp" value="<?= $setting['title']?>" name="title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputaddress" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea id="inputaddress" class="form-control " rows="4" name="address"><?= $setting['address']?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputcontact" class="col-sm-2 col-form-label">Contact</label>
                            <div class="col-sm-10">
                                <textarea id="inputcontact" class="form-control " rows="4" name="contact"><?= $setting['contact']?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger float-right">Save</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?= $this->endSection() ?>