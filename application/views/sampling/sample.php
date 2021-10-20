                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:250px; background-color: rgba(133, 135, 150, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Sampel</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <!-- flash data for successfully insert data -->
 	                <?php echo $this->session->flashdata('message') ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">

                                <div class="col-sm-12 col-md-4">
                                    <form method="post" action="<?php echo base_url('sampling/sample') ?>">
                                        <div class="input-group">
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari nomor sampel..." autocomplete="off">
                                            <div class="input-group-append">
                                                <input class="btn btn-secondary" type="submit" name="submit" value="Submit">
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
                                            <th style="text-align: center; vertical-align: middle;">No. Sampel</th>
                                            <th style="text-align: center; vertical-align: middle;">Tanggal Order</th>
                                            <th style="text-align: center; vertical-align: middle;">Jam Order</th>
                                            <th style="text-align: center; vertical-align: middle;">Tanggal Sampel</th>
                                            <th style="text-align: center; vertical-align: middle;">Jam Sampel</th>
                                            <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                        </tr>

                                            <?php 
                                                if(empty($viewOrder)): ?>
                                                <tr>
                                                    <td colspan=9>
                                                        <div class="alert alert-danger" role="alert">
                                                            Data tidak ditemukan.
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endif;
                                                
                                                foreach ($viewOrder as $vo): ?>
                                                <tr>
                                                    <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                    <td style="vertical-align: middle;"><?php
                                                        echo $vo->Samples;
                                                    ?></td>
                                                    <td style="vertical-align: middle;"><?php 
                                                            $date = new DateTime($vo->orderTime);
                                                            $date = $date->format('d F Y');
                                                            echo $date;
                                                        ?>
                                                        </td>
                                                    <td style="vertical-align: middle;"><?php 
                                                            $time = new DateTime($vo->orderTime);
                                                            $time = $time->format('H:i:s A');
                                                            echo $time;
                                                        ?>
                                                        </td>
                                                    <td style="vertical-align: middle;"><?php 
                                                            $date = new DateTime($vo->sampleTime);
                                                            $date = $date->format('d F Y');
                                                            echo $date;
                                                        ?>
                                                        </td>
                                                    <td style="vertical-align: middle;"><?php 
                                                            $time = new DateTime($vo->sampleTime);
                                                            $time = $time->format('H:i:s A');
                                                            echo $time;
                                                        ?>
                                                        </td>
                                                    <td width="20px"><?php echo anchor('cs/order/nota/'.$vo->orderId, '<div class="btn btn-sm btn-success"><i class="far fa-eye"></i></div>') ?></td>
                                                    <td width="20px"><?php echo anchor('cs/order/update/'.$vo->orderId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
                                                        
                                                </tr>
                                                <?php endforeach; ?>
                                        </thead>
                                    </table>

                                    <?php echo $this->pagination->create_links(); ?>

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