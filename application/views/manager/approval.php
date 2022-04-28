                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Laporan Hasil Uji</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Kirim Laporan Hasil Uji via Email</h6>
                        </div>
                        <?php
                            foreach($viewResult as $vr){}
                        ?>
                        <form method="post" action="<?php echo base_url('manager/approval/approved/'.$vr->orderId) ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <input type="hidden" name="orderId" value="<?php echo $vr->orderId; ?>">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $vr->custName ?></span>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $vr->email ?></span>
                                        </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="statusId">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Saya mengizinkan pengiriman laporan hasil uji via email.
                                    </label>
                                    <?php echo form_error('statusId', '<div class="text-danger small">','</div>') ?>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-dark" type="submit">Setuju</button>
                                </div>
                            </div>
                        </form>
                    </div>

