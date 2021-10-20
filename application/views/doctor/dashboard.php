                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:250px; background-color: rgba(78, 115, 223, 1);">

                    <br>

                    <div class="card mb-4 px-2">

                        <div class="card-body">

                            <div class="row no-gutters align-items-right">
                                <div class="col">
                                    <div class="text-xs font-weight-bold mb-1 text-primary"><h4><b>Selamat Datang!</b><h4></div>
                                    <div class="text-xs font-weight text-gray-800"><h6>Hello, 
                                        <span class="badge badge-primary"><?php echo $empName; ?>.</span>
                                         Anda login sebagai <span class="badge badge-primary"><?php echo $roleName; ?>.</span><h6></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <?php echo $this->session->flashdata('message') ?>
                    
                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DATA KLINISI</h6>
                                </div>

                                <div class="card-body">
                                    <?php
                                        if(empty($viewClinical))
                                        { ?>
                                            <div class="alert alert-primary" role="alert">
                                                Tidak ada data klinisi baru.
                                            </div>
                                        <?php
                                        }
                                        else
                                        { ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; vertical-align: middle;">No.</th>
                                                            <th style="text-align: center; vertical-align: middle;">Nama Pasien</th>
                                                            <th style="text-align: center; vertical-align: middle;">Status Klinisi</th>
                                                            <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                        </tr>

                                                        <?php
                                                        $no=1;
                                                        foreach ($viewClinical as $vc): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo $no++; ?></td>
                                                            <td style="vertical-align: middle;"><?php echo $vc->custName ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><span class="badge badge-pill badge-danger">Menunggu</span></td>
                                                            <td width="20px"><?php echo anchor('doctor/dashboard/input/'.$vc->orderId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </thead>
                                                </table>
                                            </div>
                                        <?php
                                        } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">DATA HASIL UJI</h6>
                                </div>

                                <div class="card-body">
                                    <?php
                                        if(empty($viewResult))
                                        { ?>
                                            <div class="alert alert-primary" role="alert">
                                                Semua hasil uji sudah diverifikasi.
                                            </div>
                                        <?php
                                        }
                                        else
                                        { ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; vertical-align: middle;">No.</th>
                                                            <th style="text-align: center; vertical-align: middle;">Nama Pasien</th>
                                                            <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                                            <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                        </tr>

                                                        <?php
                                                        $no=1;
                                                        foreach ($viewResult as $vr): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo $no++; ?></td>
                                                            <td style="vertical-align: middle;"><?php echo $vr->custName ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><span class="badge badge-pill badge-danger">Belum diverifikasi</span></td>
                                                            <td width="20px"><?php echo anchor('doctor/dashboard/update/'.$vc->custId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </thead>
                                                </table>
                                            </div>
                                        <?php
                                        } ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>