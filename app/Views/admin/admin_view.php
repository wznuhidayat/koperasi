<?= $this->extend('main_template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="min-height: 2080.12px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Admin</li>
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
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Daftar Admin</h3>
                                <div class="float-sm-right">
                                    <a href="<?= base_url('main/admin/create') ?>" class="btn btn-sm btn-info"><i class="nav-icon fas fa-plus"></i> Tambah Admin</a>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <?= $this->include('messege') ?>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12 table-responsive">
                                        <table id="table" class="table table-bordered table-hover">
                                            <?= csrf_field() ?>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>IMG</th>
                                                    <th>ID Admin</th>
                                                    <th>Nama</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Role</th>
                                                    <th>No telp</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1 ?>
                                                <?php foreach ($admin as $admins) : ?>
                                                    <tr id="<?php echo $admins['id_admin']; ?>">
                                                        <td>
                                                            <?= $i++; ?>
                                                        </td>
                                                        <td><img src="/img/admin/<?= $admins['img']; ?>" alt="" width="45"></td>
                                                        <td><?= $admins["id_admin"] ?></td>
                                                        <td><?= $admins["name"] ?></td>
                                                        <td><?= ($admins["gender"] == 'male') ? 'Laki-laki' : 'Perempuan' ?></td>
                                                        <td><?= $admins["role"] ?></td>
                                                        <td><?= $admins["phone"] ?></td>
                                                        <td class="project-actions">
                                                           
                                                            <a class="btn btn-info btn-sm" href="/main/admin/edit/<?= $admins['id_admin'] ?>">
                                                                <i class="fas fa-pencil-alt">
                                                                </i>
                                                                Edit
                                                            </a>
                                                            <a class="btn btn-danger btn-sm btn-delete" href="/main/admin/delete/<?= $admins['id_admin'] ?>">
                                                                <i class="fas fa-trash">
                                                                </i>
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>

                                                <?php endforeach ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Tipe</th>
                                                    <th>Nama Tipe</th>
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
    <!-- /.content -->
</div>
<?= $this->endSection() ?>