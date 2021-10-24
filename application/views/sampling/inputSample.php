                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:250px; background-color: rgba(133, 135, 150, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Input Sampel</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>
                    <br>

                    <?php
                    $samples=array();
                    $parameterIds=array();
                    $parameterNames=array();

                    foreach($viewSample as $vs)
                    {
                        $samples[] = $vs->noSample;
                        $parameterIds[] = $vs->parameterId;
                        $parameterNames[] = $vs->parameterName;
                        $samp = array_unique($samples);
                        $param1 = array_unique($parameterIds);
                        $param2 = array_unique($parameterNames);
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
                                            <?php foreach($samp as $s): ?>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><?php echo $s ?></span>
                                                    </div>
                                                    <input type="text" name="type[]" class="form-control" placeholder="Tipe sampel..." value="<?php echo set_value('type[]'); ?>" aria-label="Username" aria-describedby="basic-addon1">
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
                                            <?php foreach($param2 as $p): ?>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label><?php echo $p ?></label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" name="unit[]" placeholder="Satuan..." value="<?php echo set_value('unit[]'); ?>" class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="reference[]" placeholder="Nilai rujukan..." value="<?php echo set_value('reference[]'); ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                            <?php endforeach; ?>
                                            <?php echo form_error('unit[]', '<div class="text-danger small">','</div>') ?>
                                            <?php echo form_error('reference[]', '<div class="text-danger small">','</div>') ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-secondary btn-lg btn-block">SIMPAN</button>
                        </div>
                    </div>
                </form>