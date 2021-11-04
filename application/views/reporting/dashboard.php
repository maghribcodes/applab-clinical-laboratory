                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(28, 200, 138, 1);">

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
                                    <div class="text-xs font-weight-bold mb-1 text-success"><h4><b>Selamat Datang!</b><h4></div>
                                    <div class="text-xs font-weight text-gray-800"><h6>Hello, 
                                        <span class="badge badge-success"><?php echo $empName; ?>.</span>
                                         Anda login sebagai <span class="badge badge-success"><?php echo $roleName; ?>.</span><h6></div>
                                </div>
                                <div class="col-auto">
                                    <div class="card border-left-success h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark mb-1">
                                                        Hasil Uji yang sudah diverifikasi</div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $countLhu ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-paste fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <?php echo $this->session->flashdata('message') ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">

                                <div class="col-sm-12 col-md-4">
                                    <form method="post" action="<?php echo base_url('reporting/dashboard') ?>">
                                        <div class="input-group">
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari pasien..." autocomplete="off">
                                            <div class="input-group-append">
                                                <input class="btn btn-success" type="submit" name="submit" value="Submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                            <div class="card-body">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; vertical-align: middle;">No.</th>
                                            <th style="text-align: center; vertical-align: middle;">Nama Pasien</th>
                                            <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                            <th style="text-align: center; vertical-align: middle;">Lab Terkait</th>
                                            <th style="text-align: center; vertical-align: middle;">Kiriman</th>
                                            <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                        </tr>

                                            <?php 
                                                if(empty($viewOrders)): ?>
                                                <tr>
                                                    <td colspan=9>
                                                        <div class="alert alert-success" role="alert">
                                                            Data tidak ditemukan.
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endif;
                                                
                                                foreach ($viewOrders as $vo): ?>
                                                <tr>
                                                    <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $vo->custName ?></td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <?php 
                                                            if($vo->statusId == 0)
                                                            {
                                                                ?><span class="badge badge-pill badge-warning">Menunggu hasil lab</span><?php
                                                            }
                                                            else if($vo->statusId == 1)
                                                            {
                                                                ?><span class="badge badge-pill badge-danger">Belum diverifikasi</span><?php
                                                            }
                                                            else if($vo->statusId == 2)
                                                            {
                                                                ?><span class="badge badge-pill badge-success">Sudah diverifikasi</span><?php
                                                            }
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $vo->packageName ?></td>
                                                    <td style="text-align: center; vertical-align: middle;"><?php echo $vo->sender ?></td>
                                                    <?php 
                                                            if($vo->statusId == 0)
                                                            {
                                                                ?> 
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                <?php
                                                            }
                                                            if($vo->statusId == 1)
                                                            {
                                                                ?> 
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                <?php
                                                            }
                                                            if($vo->statusId == 2  || $vo->statusId == 3)
                                                            {
                                                                if($vo->email == NULL)
                                                                {
                                                                    ?>
                                                                        <td width="20px"><?php echo anchor('reporting/dashboard/print/'.$vo->orderId, '<div class="btn btn-sm btn-success"><i class="fa fa-print"></i></div>') ?></td>
                                                                        <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?> 
                                                                        <td width="20px"><?php echo anchor('reporting/dashboard/print/'.$vo->orderId, '<div class="btn btn-sm btn-success"><i class="fa fa-print"></i></div>') ?></td>
                                                                        <td width="20px"><?php echo anchor('reporting/dashboard/mail/'.$vo->orderId, '<div class="btn btn-sm btn-success"><i class="fas fa-envelope-open-text"></i></div>') ?></td>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                </tr>
                                                <?php endforeach; ?>
                                        </thead>
                                    </table>

                                    <?php echo $this->pagination->create_links(); ?>

                            </div>
                        
                    </div>