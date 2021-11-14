<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
    
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon">
                    <br></br>
                    <img src="<?php echo base_url() ?>assets/img/sumbar.png" width=70px height=80px>
                </div>
                <!--<div class="sidebar-brand-text mx-3">Labkes</div>-->
            </a> 
            
            <!-- Divider -->
            <!--<hr class="sidebar-divider my-0">-->
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('manager/dashboard') ?>">
                    <br></br>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('manager/approval') ?>">
                    <i class="fas fa-folder fa-cog"></i>
                    <span>Data Hasil Uji</span></a>
            </li>

            <!-- Divider 
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?php //echo base_url('manager/package') ?>">
                    <i class="fas fa-folder fa-cog"></i>
                    <span>Data Paket</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('manager/parameter') ?>">
                    <i class="fas fa-folder fa-cog"></i>
                    <span>Data Parameter</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('manager/staff') ?>">
                    <i class="fas fa-folder fa-cog"></i>
                    <span>Data Staff</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">Apa anda yakin untuk logout?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <a class="btn btn-dark" href="<?php echo base_url('auth/logout') ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">