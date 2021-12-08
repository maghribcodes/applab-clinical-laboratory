                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Parameter</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <?php foreach($viewParam as $vpa){} ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Tambah Data Parameter</h6>
                        </div>
                        
                        <form method="post" action="<?php echo base_url('manager/parameter/editParameter/'.$vpa->parameterId) ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <input type="hidden" name="parameterId" value="<?php echo $vpa->parameterId ?>">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Paket</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <select id="packageId" name="packageId" class="form-control" required>
                                                <option value="">Pilih paket...</option>
                                                <?php foreach($viewPackages as $vp) : ?>
                                                    <option value="<?php echo $vp->packageId ?>"
                                                        <?php if($vp->packageId == $vpa->packageId): ?> selected <?php endif; ?>>
                                                        <?php echo $vp->packageName ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Parameter</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="parameterName" value="<?php echo $vpa->parameterName ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="unit" value="<?php echo $vpa->unit ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nilai Rujukan</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="referenceValue" value="<?php echo $vpa->referenceValue ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Metode</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="method" value="<?php echo $vpa->method ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Biaya</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="parameterCost" value="<?php echo $vpa->parameterCost ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div>
                                    <button class="btn btn-dark" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>