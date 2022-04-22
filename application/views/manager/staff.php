                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Staff</b></h2>
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
                                            <?php echo anchor('manager/staff/add', '<button class="btn btn-outline-dark m-0"><i class="fas fa-plus fa-sm"></i> Tambah Staff</button>') ?>
                                        </div>

                                        <div class="col-sm-12 col-md-4">
                                            <form method="post" action="<?php echo base_url('manager/staff') ?>">
                                                <div class="input-group">
                                                    <input type="text" name="keyword" class="form-control" placeholder="Cari staff..." autocomplete="off">
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
                                                <th style="text-align: center; vertical-align: middle;">Nama Staff</th>
                                                <th style="text-align: center; vertical-align: middle;">Role</th>
                                                <th colspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                            </tr>

                                                <?php 
                                                    if(empty($viewStaff)): ?>
                                                    <tr>
                                                        <td colspan=9>
                                                            <div class="alert alert-dark" role="alert">
                                                                Data tidak ditemukan.
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endif;
                                                    
                                                    foreach ($viewStaff as $vs): ?>
                                                    <tr>
                                                        <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
                                                        <td width="250px" style="text-align: center; vertical-align: middle;"><?php echo $vs->empName ?></td>
                                                        <td style="text-align: center; vertical-align: middle;">
                                                            <?php 
                                                                if($vs->roleId == 1)
                                                                {
                                                                    ?> <span class="badge badge-pill badge-dark"><?php echo $vs->roleName ?></span> <?php
                                                                }
                                                                else if($vs->roleId == 2)
                                                                {
                                                                    ?> <span class="badge badge-pill badge-danger"><?php echo $vs->roleName ?></span> <?php
                                                                }
                                                                else if($vs->roleId == 3)
                                                                {
                                                                    ?> <span class="badge badge-pill badge-primary"><?php echo $vs->roleName ?></span> <?php
                                                                }
                                                                else if($vs->roleId == 4)
                                                                {
                                                                    ?> <span class="badge badge-pill badge-warning"><?php echo $vs->roleName ?></span> <?php
                                                                }
                                                                else if($vs->roleId == 5)
                                                                {
                                                                    ?> <span class="badge badge-pill badge-info"><?php echo $vs->roleName ?></span> <?php
                                                                }
                                                                else if($vs->roleId == 6)
                                                                {
                                                                    ?> <span class="badge badge-pill badge-success"><?php echo $vs->roleName ?></span> <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td width="20px"><?php echo anchor('manager/staff/edit/'.$vs->empId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
                                                        <td width="20px"><div class="btn btn-sm btn-danger" data-toggle="modal" onclick="confirm_modal('<?php echo site_url("manager/staff/delete/".$vs->empId);?>');" data-target="#deleteModal"><i class="fa fa-trash"></i></div></td>
                                                            
                                                    </tr>
                                                <?php endforeach; ?>
                                        </thead>
                                    </table>
                                
                                    <?php echo $this->pagination->create_links(); ?>

                                </div>
                            </div>
                    <!--    </div>
                    </div> -->

                    <!-- Delete Modal-->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">Apa anda yakin untuk menghapus data ini?</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <a class="btn btn-danger" id="deleteLink" href="">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>	
                        function confirm_modal(delete_url)
                        {
                            jQuery('#deleteModal').modal('show', {backdrop: 'static', keyboard :false});
                            document.getElementById('deleteLink').setAttribute("href", delete_url);
                            document.getElementById('deleteLink').focus();
                        }
                    </script>