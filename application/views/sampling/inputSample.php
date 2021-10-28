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
                    $parameterIds=array();
                    $parameterNames=array();
                    $units=array();
                    $references=array();

                    foreach($viewSample as $vs)
                    {
                        $samples[] = $vs->noSample;
                        $sampleTypes[] = $vs->sampleType;
                        $parameterIds[] = $vs->parameterId;
                        $parameterNames[] = $vs->parameterName;
                        $units[] = $vs->unit;
                        $references[]= $vs->reference;

                        $combined1 = array_combine($samples, $sampleTypes);
                        $combined2 = array_combine($parameterNames, $units);
                        $combined3 = array_combine($parameterNames, $references);

                        $samp = array_unique($samples);
                        $param1 = array_unique($parameterIds);
                    }?>

                <form method="post" action="<?php echo base_url('sampling/dashboard/inputSample/'.$vs->orderId) ?>">
                    <div class="card mb-4">
                        
                        <div class="card-body">

                            <!-- Content Row -->
                            <div class="row">

                                <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-secondary">DATA SAMPEL</h6>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo implode(', ', $samp); ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $param1); ?>">
                                            <?php foreach($combined1 as $noSample => $sampleType): ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><?php echo $noSample ?></span>
                                                    </div>
                                                    <input type="text" name="type[]" class="form-control" value="<?php echo set_value('type[]', $sampleType); ?>" placeholder="Tipe sampel..." aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            <?php endforeach;?>
                                            <?php echo form_error('type[]', '<div class="text-danger small">','</div>') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-secondary">DATA PARAMETER</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <?php foreach($combined2 as $parameterName => $unit): ?>
                                                        <label class="m-0 font-weight-bold text-secondary"><?php echo $parameterName ?></label>
                                                        <input type="text" name="unit[]" value="<?php echo set_value('unit[]', $unit); ?>" placeholder="Satuan..." class="form-control">
                                                        <br>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <?php foreach($combined3 as $parameterName => $reference): ?>
                                                        <br>
                                                        <input type="text" name="reference[]" value="<?php echo set_value('reference[]', $reference); ?>" placeholder="Nilai rujukan..." class="form-control">
                                                        <br>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <br>
                                            <?php echo form_error('unit[]', '<div class="text-danger small">','</div>') ?>
                                            <?php echo form_error('reference[]', '<div class="text-danger small">','</div>') ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-warning btn-lg btn-block">SIMPAN</button>
                        </div>
                    </div>
                </form>