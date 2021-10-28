                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:250px; background-color: rgba(78, 115, 223, 1);">
                    
                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Hasil Uji</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <?php
                    foreach($viewResult as $vr)
                    {
                        $samples[] = $vr->noSample;
                        $samp = array_unique($samples);

                        $sampleTypes[] = $vr->sampleType;
                        $sampt = array_unique($sampleTypes);
                    }
                    ?>

                    <form method="post" action="<?php echo base_url('doctor/result/verified/'.$vr->orderId) ?>">
                        <div class="card shadow mb-4">

                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">DATA KLINISI</h6>
                            </div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $vr->custName ?></span>
                                        </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pengirim</label>
                                        <div class="col-sm-4">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $vr->sender ?></span>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $vr->gender ?></span>
                                        </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Usia</label>
                                        <div class="col-sm-4">
                                            <span class="input-group-text" id="basic-addon1">
                                                <?php 
                                                    $birth = new DateTime($vr->birthDate);
                                                    $now = new DateTime();
                                                    $age = $now->diff($birth);
                                                    echo $age->y;
                                                ?> Tahun
                                            </span>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kontak</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $vr->contact ?></span>
                                        </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-4">
                                            <span class="input-group-text" id="basic-addon1"><?php echo $vr->address ?></span>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <input type="hidden" name="samples" value="<?php echo implode(', ', $samp); ?>">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <span class="input-group-text" id="basic-addon1"><?php echo implode(', ', $samp) ?></span>
                                        </div>
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                        <div class="col-sm-4">
                                            <span class="input-group-text" id="basic-addon1"><?php echo implode(', ', $sampt) ?></span>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan Klinisi</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <span class="input-group-text" id="basic-addon1">
                                                <?php 
                                                if($vr->clinicalNotes == NULL)
                                                {
                                                    echo "-";
                                                }
                                                else
                                                {
                                                    echo $vr->clinicalNotes;
                                                }
                                                ?>
                                            </span>
                                        </div>
                                </div>
                            </div>

                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">HASIL PENGUJIAN</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center; vertical-align: middle;">No.</th>
                                                <th style="text-align: center; vertical-align: middle;">Parameter</th>
                                                <th style="text-align: center; vertical-align: middle;">Satuan</th>
                                                <th style="text-align: center; vertical-align: middle;">Nilai Rujukan</th>
                                                <th style="text-align: center; vertical-align: middle;">Hasil</th>
                                                <th style="text-align: center; vertical-align: middle;">Spesifikasi Metoda</th>
                                            </tr>

                                            <?php
                                            $no=1;
                                            foreach ($viewParameter as $vp): ?>
                                            <tr>
                                                <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo $no++; ?></td>
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $vp->parameterName ?></td>
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $vp->unit ?></td>
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $vp->reference ?></td>
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $vp->result ?></td>
                                                <td style="text-align: center; vertical-align: middle;"><?php echo $vp->method ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </thead>
                                    </table>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="statusId">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Data klinisi sudah sesuai dengan hasil uji lab.
                                    </label>
                                    <?php echo form_error('statusId', '<div class="text-danger small">','</div>') ?>
                                </div>

                            </div>

                            <div class="card-body">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">VERIFIKASI</button>
                            </div>

                        </div>
                    </form>