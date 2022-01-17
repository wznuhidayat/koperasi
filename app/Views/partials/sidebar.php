<?php $request = \Config\Services::request(); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url() ?>/assets/template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Koperasi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url() ?>/assets/template/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= ucwords(session()->get('name'))?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('/main')?>" class="nav-link <?= $menu == 'Dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/main/member')?>" class="nav-link  <?= $menu == 'Member' ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Anggota
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="<?= base_url('/main/typesaving')?>" class="nav-link  ">

                        <i class="nav-icon fas fa-hashtag"></i>
                        <p>
                            Root Menu
                        </p>
                    </a>
                </li> -->
                <li class="nav-item  <?= $menu == 'Transaction' ? 'menu-is-opening menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $menu == 'Transaction' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transaksi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="<?= base_url('/main/addsaving')?>" class="nav-link <?= $request->uri->getSegment(2) == 'addsaving' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Setor Tunai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/main/withdraw')?>" class="nav-link <?= $request->uri->getSegment(2) == 'withdraw' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Penarikan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/main/loan')?>" class="nav-link <?= $request->uri->getSegment(2) == 'loan' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pinjam Tunai</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/main/installmentpay')?>" class="nav-link <?= $request->uri->getSegment(2) == 'installmentpay' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Angsur Pinjaman</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="nav-item  <?= $menu == 'Master' ? 'menu-is-opening menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $menu == 'Master' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Data Master
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="<?= base_url('/main/typesaving')?>" class="nav-link <?= $request->uri->getSegment(2) == 'typesaving' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Simpanan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/main/typeloan')?>" class="nav-link <?= $request->uri->getSegment(2) == 'typeloan' ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Pinjaman</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>