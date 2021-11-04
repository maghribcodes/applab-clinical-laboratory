                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(78, 115, 223, 1);">
                    
                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Hasil Uji</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>
                        
                    <!-- flash data for successfully insert data -->
 	                    <?php echo $this->session->flashdata('message') ?>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-4">
                                            <form method="post" action="<?php echo base_url('doctor/result') ?>">
                                                <div class="input-group">
                                                    <input type="text" name="keyword" class="form-control" placeholder="Cari pasien..." autocomplete="off">
                                                    <div class="input-group-append">
                                                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <?php
                                        if(empty($viewResult))
                                        { ?>
                                            <div class="alert alert-primary" role="alert">
                                                Data tidak ditemukan.
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
                                                            <th style="text-align: center; vertical-align: middle;">Usia</th>
                                                            <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                                                            <th style="text-align: center; vertical-align: middle;">Kontak</th>
                                                            <th style="text-align: center; vertical-align: middle;">Alamat</th>
                                                            <th style="text-align: center; vertical-align: middle;">Kiriman</th>
                                                            <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                                            <th colspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                        </tr>

                                                        <?php
                                                        foreach ($viewResult as $vr): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                            <td style="vertical-align: middle;"><?php echo $vr->custName ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php 
                                                                $birth = new DateTime($vr->birthDate);
                                                                $now = new DateTime();
                                                                $age = $now->diff($birth);
                                                                echo $age->y;
                                                            ?>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vr->gender ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vr->contact ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vr->address ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vr->sender ?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php 
                                                                    if($vr->statusId == 0)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-warning">Menunggu hasil lab</span><?php
                                                                    }
                                                                    else if($vr->statusId == 1)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-danger">Belum diverifikasi</span><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?><span class="badge badge-pill badge-success">Sudah diverifikasi</span><?php
                                                                    }
                                                                ?>
                                                            </td>

                                                            <?php 
                                                            if($vr->statusId == 0)
                                                            {
                                                                ?> 
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                <?php
                                                            }
                                                            else if($vr->statusId == 1)
                                                            {
                                                                ?> 
                                                                    <td width="20px"><?php echo anchor('doctor/result/verification/'.$vr->orderId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
                                                                <?php
                                                            }
                                                            else
                                                            {
                                                                ?> 
                                                                    <td width="20px"><?php echo anchor('reporting/dashboard/print/'.$vr->orderId, '<div class="btn btn-sm btn-success"><i class="fas fa-eye"></i></div>') ?></td>

                                                                <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </thead>
                                                </table>

                                                <?php echo $this->pagination->create_links(); ?>

                                            </div>
                                        <?php
                                        } ?>
                                </div>
                            </div>
                        