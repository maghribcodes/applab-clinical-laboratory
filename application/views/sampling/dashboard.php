                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:250px; background-color: rgba(133, 135, 150, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Dashboard</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <div class="card mb-4 px-2">

                        <div class="card-body">

                            <div class="row no-gutters align-items-right">
                                <div class="col">
                                    <div class="text-xs font-weight-bold mb-1 text-secondary"><h4><b>Selamat Datang!</b><h4></div>
                                    <div class="text-xs font-weight text-gray-800"><h6>Hello, 
                                        <span class="badge badge-secondary"><?php echo $empName; ?>.</span>
                                         Anda login sebagai <span class="badge badge-secondary"><?php echo $roleName; ?>.</span><h6></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- flash data for successfully insert data -->
 	                <?php echo $this->session->flashdata('message') ?>

                     <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-secondary">DATA SAMPEL</h6>
                                </div>

                                <div class="card-body">
                                    <?php
                                        if(empty($viewSamples))
                                        { ?>
                                            <div class="alert alert-secondary" role="alert">
                                                Tidak ada data sampel baru.
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
                                                            <th style="text-align: center; vertical-align: middle;">Nomor Sampel</th>
                                                            <th style="text-align: center; vertical-align: middle;">Nama Pasien</th>
                                                            <th style="text-align: center; vertical-align: middle;">Tanggal Order</th>
                                                            <th style="text-align: center; vertical-align: middle;">Jam Order</th>
                                                            <th style="text-align: center; vertical-align: middle;">Status Sampel</th>
                                                            <th colspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                        </tr>

                                                        <?php
                                                        $no=1;
                                                        foreach ($viewSamples as $vs): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo $no++; ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vs->Samples ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vs->custName ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php 
                                                                    $date = new DateTime($vs->orderTime);
                                                                    $date = $date->format('d F Y');
                                                                    echo $date;
                                                                ?>
                                                                </td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php 
                                                                    $time = new DateTime($vs->orderTime);
                                                                    $time = $time->format('H:i:s A');
                                                                    echo $time;
                                                                ?>
                                                                </td>
                                                            <td style="text-align: center; vertical-align: middle;"><span class="badge badge-pill badge-danger">Menunggu</span></td>
                                                            <td width="20px"><?php echo anchor('sampling/dashboard/input/'.$vs->orderId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
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