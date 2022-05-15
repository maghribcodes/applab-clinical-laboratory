                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(54, 185, 204, 1);">

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
                                    <div class="text-xs font-weight-bold mb-1 text-info"><h4><b>Selamat Datang!</b><h4></div>
                                    <div class="text-xs font-weight text-gray-800"><h6>Hello, 
                                        <span class="badge badge-info"><?php echo $empName; ?>.</span>
                                         Anda login sebagai <span class="badge badge-info"><?php echo $roleName; ?> [<?php echo $labName; ?>].</span><h6></div>
                                </div>
                                <div class="col-auto">
                                    <div class="card border-left-info h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark mb-1">
                                                        Data sampel yang belum diuji</div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                        <?php 
                                                            if($labName == "Hematologi")
                                                            {
                                                                echo $countSampA;
                                                            }
                                                            if($labName == "Kimia Klinik dan Urinalisa")
                                                            {
                                                                echo $countSampB;
                                                            }
                                                            if($labName == "Serologi")
                                                            {
                                                                echo $countSampC;
                                                            }
                                                            if($labName == "Mikrobiologi")
                                                            {
                                                                echo $countSampD;
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-bong fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="card border-left-info h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark mb-1">
                                                        LHU yang belum diverifikasi</div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                        <?php 
                                                            if($labName == "Hematologi")
                                                            {
                                                                echo $countLhusA;
                                                            }
                                                            if($labName == "Kimia Klinik dan Urinalisa")
                                                            {
                                                                echo $countLhusB;
                                                            }
                                                            if($labName == "Serologi")
                                                            {
                                                                echo $countLhusC;
                                                            }
                                                            if($labName == "Mikrobiologi")
                                                            {
                                                                echo $countLhusD;
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-file-contract fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- flash data for successfully insert data -->
 	                <?php echo $this->session->flashdata('message') ?>

                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">

                                <div class="col-sm-12 col-md-4">
                                    <form method="post" action="<?php echo base_url('lab/dashboard') ?>">
                                        <div class="input-group">
                                            <input type="text" name="keyword" class="form-control" placeholder="Cari nomor sampel..." autocomplete="off">
                                            <div class="input-group-append">
                                                <input class="btn btn-info" type="submit" name="submit" value="Submit">
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                            <?php
                                if($labName == "Hematologi")
                                { ?>
                                    <div class="card-body">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">No.</th>
                                                    <th style="text-align: center; vertical-align: middle;">Nomor Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                </tr>

                                                    <?php 
                                                        if(empty($viewOrdersA)): ?>
                                                        <tr>
                                                            <td colspan=9>
                                                                <div class="alert alert-info" role="alert">
                                                                    Data tidak ditemukan.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endif;
                                                        
                                                        foreach ($viewOrdersA as $vo): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vo->Samples ?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php if($vo->statusId == 1 || $vo->statusId == 2)
                                                                {
                                                                    ?><span class="badge badge-pill badge-danger">Belum diambil</span><?php
                                                                }
                                                                else if($vo->statusId == 3){
                                                                    ?><span class="badge badge-pill badge-warning">Belum diuji</span><?php
                                                                }
                                                                else{
                                                                    ?><span class="badge badge-pill badge-success">Sudah diuji</span><?php
                                                                } ?>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php 
                                                                    if($vo->statusId == 5 || $vo->statusId == 6)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-success">Sudah diverifikasi</span><?php
                                                                    }
                                                                    else if($vo->statusId == 4)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-danger">Belum diverifikasi</span><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?><span class="badge badge-pill badge-warning">Menunggu hasil lab</span><?php
                                                                    }
                                                                ?>
                                                            </td>
                                                            <?php
                                                                if($vo->statusId == 3)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/input/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else if($vo->statusId == 4)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/update/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else
                                                                {
                                                                    ?> <td width="20px"><div class="btn btn-sm btn-secondary" disabled><i class="fa fa-edit"></i></div></td> <?php
                                                                }
                                                            ?>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                </thead>
                                            </table>

                                            <?php echo $this->pagination->create_links(); ?>

                                    </div> <?php
                                }
                                else if($labName == "Kimia Klinik dan Urinalisa")
                                { ?>
                                    <div class="card-body">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">No.</th>
                                                    <th style="text-align: center; vertical-align: middle;">Nomor Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                </tr>

                                                    <?php 
                                                        if(empty($viewOrdersB)): ?>
                                                        <tr>
                                                            <td colspan=9>
                                                                <div class="alert alert-info" role="alert">
                                                                    Data tidak ditemukan.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endif;
                                                        
                                                        foreach ($viewOrdersB as $vo): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vo->Samples ?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php if($vo->statusId == 1 || $vo->statusId == 2)
                                                                {
                                                                    ?><span class="badge badge-pill badge-danger">Belum diambil</span><?php
                                                                }
                                                                else if($vo->statusId == 3){
                                                                    ?><span class="badge badge-pill badge-warning">Belum diuji</span><?php
                                                                }
                                                                else{
                                                                    ?><span class="badge badge-pill badge-success">Sudah diuji</span><?php
                                                                } ?>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php 
                                                                    if($vo->statusId == 5 || $vo->statusId == 6)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-success">Sudah diverifikasi</span><?php
                                                                    }
                                                                    else if($vo->statusId == 4)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-danger">Belum diverifikasi</span><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?><span class="badge badge-pill badge-warning">Menunggu hasil lab</span><?php
                                                                    }
                                                                ?>
                                                            </td>
                                                            <?php
                                                                if($vo->statusId == 3)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/input/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else if($vo->statusId == 4)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/update/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else
                                                                {
                                                                    ?> <td width="20px"><div class="btn btn-sm btn-secondary" disabled><i class="fa fa-edit"></i></div></td> <?php
                                                                }
                                                            ?>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                </thead>
                                            </table>

                                            <?php echo $this->pagination->create_links(); ?>

                                    </div> <?php
                                }
                                else if($labName == "Serologi")
                                { ?>
                                    <div class="card-body">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">No.</th>
                                                    <th style="text-align: center; vertical-align: middle;">Nomor Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                </tr>

                                                    <?php 
                                                        if(empty($viewOrdersC)): ?>
                                                        <tr>
                                                            <td colspan=9>
                                                                <div class="alert alert-info" role="alert">
                                                                    Data tidak ditemukan.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endif;
                                                        
                                                        foreach ($viewOrdersC as $vo): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vo->Samples ?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php if($vo->statusId == 1 || $vo->statusId == 2)
                                                                {
                                                                    ?><span class="badge badge-pill badge-danger">Belum diambil</span><?php
                                                                }
                                                                else if($vo->statusId == 3){
                                                                    ?><span class="badge badge-pill badge-warning">Belum diuji</span><?php
                                                                }
                                                                else{
                                                                    ?><span class="badge badge-pill badge-success">Sudah diuji</span><?php
                                                                } ?>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php 
                                                                    if($vo->statusId == 5 || $vo->statusId == 6)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-success">Sudah diverifikasi</span><?php
                                                                    }
                                                                    else if($vo->statusId == 4)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-danger">Belum diverifikasi</span><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?><span class="badge badge-pill badge-warning">Menunggu hasil lab</span><?php
                                                                    }
                                                                ?>
                                                            </td>
                                                            <?php
                                                                if($vo->statusId == 3)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/input/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else if($vo->statusId == 4)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/update/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else
                                                                {
                                                                    ?> <td width="20px"><div class="btn btn-sm btn-secondary" disabled><i class="fa fa-edit"></i></div></td> <?php
                                                                }
                                                            ?>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                </thead>
                                            </table>

                                            <?php echo $this->pagination->create_links(); ?>

                                    </div> <?php
                                }
                                else if($labName == "Mikrobiologi")
                                { ?>
                                    <div class="card-body">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: center; vertical-align: middle;">No.</th>
                                                    <th style="text-align: center; vertical-align: middle;">Nomor Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Sampel</th>
                                                    <th style="text-align: center; vertical-align: middle;">Status Hasil Uji</th>
                                                    <th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
                                                </tr>

                                                    <?php 
                                                        if(empty($viewOrdersD)): ?>
                                                        <tr>
                                                            <td colspan=9>
                                                                <div class="alert alert-info" role="alert">
                                                                    Data tidak ditemukan.
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endif;
                                                        
                                                        foreach ($viewOrdersD as $vo): ?>
                                                        <tr>
                                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                            <td style="text-align: center; vertical-align: middle;"><?php echo $vo->Samples ?></td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php if($vo->statusId == 1 || $vo->statusId == 2)
                                                                {
                                                                    ?><span class="badge badge-pill badge-danger">Belum diambil</span><?php
                                                                }
                                                                else if($vo->statusId == 3){
                                                                    ?><span class="badge badge-pill badge-warning">Belum diuji</span><?php
                                                                }
                                                                else{
                                                                    ?><span class="badge badge-pill badge-success">Sudah diuji</span><?php
                                                                } ?>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;">
                                                                <?php 
                                                                    if($vo->statusId == 5 || $vo->statusId == 6)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-success">Sudah diverifikasi</span><?php
                                                                    }
                                                                    else if($vo->statusId == 4)
                                                                    {
                                                                        ?><span class="badge badge-pill badge-danger">Belum diverifikasi</span><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?><span class="badge badge-pill badge-warning">Menunggu hasil lab</span><?php
                                                                    }
                                                                ?>
                                                            </td>
                                                            <?php
                                                                if($vo->statusId == 3)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/input/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else if($vo->statusId == 4)
                                                                {
                                                                    ?> <td width="20px"><?php echo anchor('lab/dashboard/update/'.$vo->orderId.'/'.$vo->noSample, '<div class="btn btn-sm btn-info"><i class="fa fa-edit"></i></div>') ?></td> <?php
                                                                }
                                                                else
                                                                {
                                                                    ?> <td width="20px"><div class="btn btn-sm btn-secondary" disabled><i class="fa fa-edit"></i></div></td> <?php
                                                                }
                                                            ?>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                </thead>
                                            </table>

                                            <?php echo $this->pagination->create_links(); ?>

                                    </div> <?php
                                }
                            ?>
                
                    </div>