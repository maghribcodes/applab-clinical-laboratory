                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Parameter</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Tambah Data Parameter</h6>
                        </div>
                        
                        <form method="post" action="<?php echo base_url('manager/parameter/addParameter') ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Paket</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <select id="labId" name="labId" class="form-control" required>
                                                <option value="">Pilih paket...</option>
                                                <?php foreach($viewPackages as $vp) : ?>
                                                    <option value="<?php echo $vp->labId ?>"><?php echo $vp->labName ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Parameter</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="parameterName" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="unit" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nilai Rujukan</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="referenceValue" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Metode</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="method" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Biaya</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="parameterCost" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-2 pt-0">Status Reagen</legend>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input required class="form-check-input" type="radio" name="reagenId" id="gridRadios1" value="1" <?php echo set_radio('reagenId','1'); ?>>
                                                        <label class="form-check-label" for="gridRadios1">
                                                            Tersedia
                                                        </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="reagenId" id="gridRadios2" value="2" <?php echo set_radio('reagenId','2'); ?>>
                                                        <label class="form-check-label" for="gridRadios2">
                                                            Tidak Tersedia
                                                        </label>
                                                </div>
                                                
                                            </div>
                                    </div>
                                </fieldset>
                                <div>
                                    <button class="btn btn-dark" type="submit">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>