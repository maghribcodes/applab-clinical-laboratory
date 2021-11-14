                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Paket</b></h2>
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
                                            <?php echo anchor('manager/package/add', '<button class="btn btn-outline-dark m-0"><i class="fas fa-plus fa-sm"></i> Tambah Paket</button>') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle;">No.</th>
                                                <th style="text-align: center; vertical-align: middle;">Nama Paket</th>
                                                <th style="text-align: center; vertical-align: middle;">Kode Paket</th>
                                                <th colspan="2" style="text-align: center; vertical-align: middle;">Aksi</th>
                                            </tr>

                                                <?php 
                                                    if(empty($viewPackages)): ?>
                                                    <tr>
                                                        <td colspan=9>
                                                            <div class="alert alert-dark" role="alert">
                                                                Data tidak ditemukan.
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endif;
                                                    $no=1;
                                                    foreach ($viewPackages as $vp): ?>
                                                    <tr>
                                                        <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo $no++ ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $vp->packageName ?></td>
                                                        <td style="text-align: center; vertical-align: middle;"><?php echo $vp->packageId ?></td>
                                                        <td width="20px"><?php echo anchor('manager/package/edit/'.$vp->packageId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
                                                        <td width="20px"><div class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></div></td>

                                                            <!-- Delete Modal-->
                                                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">Apa anda yakin untuk menghapus data ini?</div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                                            <?php echo anchor('manager/package/delete/'.$vp->packageId,'<div class="btn btn-dark">Hapus</div>') ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                    </tr>
                                                <?php endforeach; ?>
                                        </thead>
                                    </table>

                                </div>
                            </div>
                    <!--    </div>
                    </div> -->