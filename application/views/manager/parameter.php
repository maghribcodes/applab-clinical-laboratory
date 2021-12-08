                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Parameter</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <?php echo $this->session->flashdata('message') ?>
                    
                    <!--<div class="row">
                        <div class="col-lg-8"> -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-8">
                                            <?php echo anchor('manager/parameter/add', '<button class="btn btn-outline-dark m-0"><i class="fas fa-plus fa-sm"></i> Tambah Parameter</button>') ?>
                                        </div>

                                        <div class="col-sm-12 col-md-4">
                                            <form method="post" action="<?php echo base_url('manager/parameter') ?>">
                                                <div class="input-group">
                                                    <input type="text" name="keyword" class="form-control" placeholder="Cari parameter..." autocomplete="off">
                                                    <div class="input-group-append">
                                                        <input class="btn btn-dark" type="submit" name="submit" value="Submit">
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
                                                <th style="text-align: center; vertical-align: middle;">Nama Parameter</th>
                                                <th style="text-align: center; vertical-align: middle;">Satuan</th>
                                                <th style="text-align: center; vertical-align: middle;">Nilai Rujukan</th>
                                                <th style="text-align: center; vertical-align: middle;">Metoda</th>
                                                <th style="text-align: center; vertical-align: middle;">Nama Paket</th>
                                                <th style="text-align: center; vertical-align: middle;">Biaya</th>
                                                <th colspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                            </tr>

                                                <?php 
                                                    if(empty($viewParameters)): ?>
                                                    <tr>
                                                        <td colspan=9>
                                                            <div class="alert alert-dark" role="alert">
                                                                Data tidak ditemukan.
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endif;
                                                    
                                                    foreach ($viewParameters as $vp): ?>
                                                    <tr>
                                                        <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $vp->parameterName ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $vp->unit ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $vp->referenceValue ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $vp->method ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $vp->packageName ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <?php 
                                                                echo number_format($vp->parameterCost, 2, ',', '.'); 
                                                            ?>
                                                        </td>
                                                        <td width="20px"><?php echo anchor('manager/parameter/edit/'.$vp->parameterId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
                                                        <td width="20px"><div class="btn btn-sm btn-danger" data-toggle="modal" onclick="confirm_modal('<?php echo site_url("manager/parameter/delete/".$vp->parameterId);?>','Title');" data-target="#deleteModal"><i class="fa fa-trash"></i></div></td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <!-- Delete Modal-->
                                                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">Apa anda yakin untuk menghapus data ini?</div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-secondary" type="button" id="delete_cancel_link" data-dismiss="modal">Batal</button>
                                                                    <a class="btn btn-danger" id="delete_link_m_n" href="">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                        </thead>
                                    </table>
                                
                                    <?php echo $this->pagination->create_links(); ?>

                                </div>
                            </div>
                    <!--    </div>
                    </div> -->

                <script>	
                    function confirm_modal(delete_url,title)
                    {
                        jQuery('#modal_delete_m_n').modal('show', {backdrop: 'static',keyboard :false});
                        jQuery("#modal_delete_m_n .grt").text(title);
                        document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
                        document.getElementById('delete_link_m_n').focus();
                    }
                </script>