                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Paket</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Tambah Data Paket</h6>
                        </div>
                        
                        <form method="post" action="<?php echo base_url('manager/package/addPackage') ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Paket</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="packageId" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Paket</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="packageName" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div>
                                    <button class="btn btn-dark" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>