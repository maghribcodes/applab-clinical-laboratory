                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(246, 194, 62, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Input Sampel</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>
                    <br>

                    <?php
                    $samples=array();
                    $sampleTypes=array();
                    $parameterNames=array();
                    $units=array();
                    $references=array();
                    $labIds=array();

                    foreach($viewSample as $vs)
                    {
                        $samples[] = $vs->noSample;
                        $sampleTypes[] = $vs->sampleType;
                        $parameterNames[] = $vs->parameterName;
                        $units[] = $vs->unit;
                        $references[]= $vs->referenceValue;
                        $labIds[] = $vs->labId;

                        $combined1 = array_combine($samples, $sampleTypes);
                        $combined2 = array_combine($parameterNames, $units);
                        $combined3 = array_combine($parameterNames, $references);

                        $samp = array_unique($samples);
                        $lab = array_unique($labIds);
                        $param = array_unique($parameterNames);
                    }
                    ?>

                <form method="post" action="<?php echo base_url('sampling/dashboard/inputSample/'.$vs->orderId) ?>">
                    
                    <div class="card mb-4">
                        
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-12 col-md-12">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-secondary">LAB TERKAIT</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                            <?php foreach($lab as $l) : 
                                                if($l == 2)
                                                { ?>
                                                    <div class="col-lg-3">
                                                        <div class="card bg-danger text-white shadow">
                                                            <div class="card-body">
                                                                Hematologi
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                                elseif($l == 3){ ?>
                                                    <div class="col-lg-3">
                                                        <div class="card bg-primary text-white shadow">
                                                            <div class="card-body">
                                                                Kimia Klinik
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                                elseif($l == 4){ ?>
                                                    <div class="col-lg-3">
                                                        <div class="card bg-warning text-white shadow">
                                                            <div class="card-body">
                                                                Serologi
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                                elseif($l == 5){ ?>
                                                    <div class="col-lg-3">
                                                        <div class="card bg-success text-white shadow">
                                                            <div class="card-body">
                                                                Mikrobiologi
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php } endforeach; ?>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                            <!-- Content Row -->
                            <div class="row">
                                
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-secondary">DATA SAMPEL</h6>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId; ?>">
                                            <input type="hidden" name="noSample" value="<?php echo implode(', ', $samp); ?>">
                                            <?php foreach($combined1 as $noSample => $sampleType): ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><?php echo $noSample ?></span>
                                                    </div>
                                                    <input type="text" name="type[]" class="form-control" value="<?php echo set_value('type[]', $sampleType); ?>" placeholder="Tipe sampel..." aria-label="Username" aria-describedby="basic-addon1" autocomplete="off">
                                                </div>
                                            <?php endforeach;?>
                                            <?php echo form_error('type[]', '<div class="text-danger small">','</div>') ?>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="statusId">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Sampel telah diambil.
                                                </label>
                                                <?php echo form_error('statusId', '<div class="text-danger small">','</div>') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-8 col-md-6 mb-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-secondary">DATA PARAMETER</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label class="m-0 font-weight-bold text-secondary">Nama Parameter</label>
                                                    <?php foreach($param as $pn): ?>
                                                        <br>
                                                        <fieldset disabled><input type="text" value="<?php echo $pn; ?>" class="form-control"></fieldset>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label class="m-0 font-weight-bold text-secondary">Satuan</label>
                                                    <?php foreach($combined2 as $parameterName => $unit): ?>
                                                        <br>
                                                        <fieldset disabled><input name="unit[]" value="<?php echo set_value('unit[]', $unit); ?>" class="form-control"></fieldset>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="col-sm-5">
                                                    <label class="m-0 font-weight-bold text-secondary">Nilai Referensi</label>
                                                    <?php foreach($combined3 as $parameterName => $reference): ?>
                                                        <br>
                                                        <fieldset disabled><input type="text" name="reference[]" value="<?php echo set_value('reference[]', $reference); ?>" class="form-control"></fieldset>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-warning btn-lg btn-block">SIMPAN</button>
                        </div>
                    </div>
                </form>