                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Hasil Uji</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <?php echo $this->session->flashdata('message') ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <form method="post" action="<?php echo base_url('manager/approval') ?>">
                                        <div class="input-group">
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari hasil uji..." autocomplete="off">
                                            <div class="input-group-append">
                                                <input class="btn btn-dark" type="submit" name="submit" value="Submit">
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
                                                            <th style="text-align: center; vertical-align: middle;">Tanggal Order</th>
                                                            <th style="text-align: center; vertical-align: middle;">Kiriman</th>
                                                            <th style="text-align: center; vertical-align: middle;">Lab Terkait</th>
                                                            <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                                            <th style="text-align: center; vertical-align: middle;">Hasil Uji via Email</th>
                                                            <th colspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                        </tr>

                                                        <?php
                                                        foreach ($viewResult as $vr): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vr->custName ?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php 
                                                                    $date = new DateTime($vr->orderTime);
                                                                    $date = $date->format('d F Y');
                                                                    echo $date;
                                                                ?>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vr->sender ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vr->packageName ?></td>
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
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php 
                                                                    if($vr->email == '')
                                                                    {
                                                                        ?><span> - </span><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        if($vr->statusId == 3)
                                                                        {
                                                                            ?><span class="badge badge-pill badge-success">Sudah disetujui</span><?php
                                                                        }
                                                                        else
                                                                        {
                                                                            ?><span class="badge badge-pill badge-danger">Belum disetujui</span><?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </td>
                                                            <?php 
                                                            if($vr->statusId == 0)
                                                            {
                                                                ?> 
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                <?php
                                                            }
                                                            else if($vr->statusId == 1)
                                                            {
                                                                ?> 
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                <?php
                                                            }
                                                            else if($vr->statusId == 2)
                                                            {
                                                                if($vr->email == '')
                                                                {
                                                                    ?>
                                                                        <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo anchor('reporting/dashboard/print/'.$vr->orderId, '<div class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></div>') ?></td>
                                                                        <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?> 
                                                                        <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo anchor('reporting/dashboard/print/'.$vr->orderId, '<div class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></div>') ?></td>
                                                                        <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo anchor('manager/approval/approval/'.$vr->orderId, '<div class="btn btn-sm btn-dark"><i class="fas fa-user-check"></i></div>') ?></td>
                                                                    <?php
                                                                }
                                                            }
                                                            else if($vr->statusId == 3)
                                                            {
                                                                ?> 
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo anchor('reporting/dashboard/print/'.$vr->orderId, '<div class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></div>') ?></td>
                                                                    <td width="20px" style="text-align: center; vertical-align: middle;"> - </td>
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