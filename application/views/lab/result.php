                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(54, 185, 204, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Hasil Uji</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>
                        <?php //var_dump($labName);?>
                            <?php
                                if($labName == "Hematologi")
                                {
                                    $parameterIds=array();
                                    $parameterNames=array();
                                    $results=array();
                                    $methods=array();

                                    foreach($viewSampleA as $vs)
                                    {
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined2 = array_combine($parameterNames, $methods);
                                        $combined3 = array_combine($parameterNames, $results);
                                    } ?>

                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId.'/'.$vs->noSample) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo $vs->noSample ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $parameterIds); ?>">

                                            <div class="card-body">
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-2">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->noSample ?></span>
                                                            </div>
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->sampleType ?></span>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="card-header py-2">
                                                    <h6 class="m-0 font-weight-bold text-info">DATA HASIL UJI</h6>
                                                </div>

                                                <div class="card-body">
                                                    <!-- Content Row -->
                                                    <div class="row">

                                                        <!-- First Column -->
                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <?php foreach($parameterNames as $pn): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 font-weight-bold text-secondary"><?php echo $pn ?></span>
                                                                    <br>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined2 as $parameterName => $method): ?>
                                                                    <div>
                                                                        <fieldset disabled><input type="text" name="method[]" value="<?php echo set_value('method[]', $method); ?>" class="form-control"></fieldset>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined3 as $parameterName => $result): ?>
                                                                    <div>   
                                                                        <input type="text" name="result[]" value="<?php echo set_value('result[]', $result); ?>" class="form-control" autocomplete="off">
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php echo form_error('result[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="row">
                                                        <!-- First Column -->
                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Tanggal Pengujian</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div>   
                                                                        <input type="date" name="testTime" value="<?php echo set_value('testTime'); ?>" class="form-control" autocomplete="off">
                                                                        <?php echo form_error('testTime', '<div class="text-danger small">','</div>') ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                </div>

                                                <button type="submit" class="btn btn-info btn-lg btn-block">SIMPAN</button>

                                            </div>
                                        
                                        </div>
                                    </form> <?php
                                }
                                else if($labName == "Kimia Klinik dan Urinalisa")
                                {
                                    $parameterIds=array();
                                    $parameterNames=array();
                                    $results=array();
                                    $methods=array();

                                    foreach($viewSampleB as $vs)
                                    {
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined2 = array_combine($parameterNames, $methods);
                                        $combined3 = array_combine($parameterNames, $results);
                                    } ?>

                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId.'/'.$vs->noSample) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo $vs->noSample ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $parameterIds); ?>">

                                            <div class="card-body">
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->noSample ?></span>
                                                            </div>
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->sampleType ?></span>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-info">DATA HASIL UJI</h6>
                                                </div>

                                                <div class="card-body">
                                                    <!-- Content Row -->
                                                    <div class="row">

                                                        <!-- First Column -->
                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <?php foreach($parameterNames as $pn): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 font-weight-bold text-secondary"><?php echo $pn ?></span>
                                                                    <br>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined2 as $parameterName => $method): ?>
                                                                    <div>
                                                                        <input type="text" name="method[]" value="<?php echo set_value('method[]', $method); ?>"class="form-control">
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php echo form_error('method[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined3 as $parameterName => $result): ?>
                                                                    <div>   
                                                                        <input type="text" name="result[]" value="<?php echo set_value('result[]', $result); ?>"class="form-control">
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php echo form_error('result[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-info btn-lg btn-block">SIMPAN</button>

                                            </div>
                                        
                                        </div>
                                    </form> <?php
                                }
                                else if($labName == "Serologi")
                                {
                                    $parameterIds=array();
                                    $parameterNames=array();
                                    $results=array();
                                    $methods=array();

                                    foreach($viewSampleC as $vs)
                                    {
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined2 = array_combine($parameterNames, $methods);
                                        $combined3 = array_combine($parameterNames, $results);
                                    } ?>

                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId.'/'.$vs->noSample) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo $vs->noSample ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $parameterIds); ?>">

                                            <div class="card-body">
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->noSample ?></span>
                                                            </div>
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->sampleType ?></span>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-info">DATA HASIL UJI</h6>
                                                </div>

                                                <div class="card-body">
                                                    <!-- Content Row -->
                                                    <div class="row">

                                                        <!-- First Column -->
                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <?php foreach($parameterNames as $pn): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 font-weight-bold text-secondary"><?php echo $pn ?></span>
                                                                    <br>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined2 as $parameterName => $method): ?>
                                                                    <div>
                                                                        <input type="text" name="method[]" value="<?php echo set_value('method[]', $method); ?>"class="form-control">
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php echo form_error('method[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined3 as $parameterName => $result): ?>
                                                                    <div>   
                                                                        <input type="text" name="result[]" value="<?php echo set_value('result[]', $result); ?>"class="form-control">
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php echo form_error('result[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-info btn-lg btn-block">SIMPAN</button>

                                            </div>
                                        
                                        </div>
                                    </form> <?php
                                }
                                else if($labName == "Mikrobiologi")
                                {
                                    $parameterIds=array();
                                    $parameterNames=array();
                                    $results=array();
                                    $methods=array();

                                    foreach($viewSampleD as $vs)
                                    {
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined2 = array_combine($parameterNames, $methods);
                                        $combined3 = array_combine($parameterNames, $results);
                                    } ?>

                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId.'/'.$vs->noSample) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo $vs->noSample ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $parameterIds); ?>">

                                            <div class="card-body">
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->noSample ?></span>
                                                            </div>
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $vs->sampleType ?></span>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-info">DATA HASIL UJI</h6>
                                                </div>

                                                <div class="card-body">
                                                    <!-- Content Row -->
                                                    <div class="row">

                                                        <!-- First Column -->
                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <?php foreach($parameterNames as $pn): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 font-weight-bold text-secondary"><?php echo $pn ?></span>
                                                                    <br>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined2 as $parameterName => $method): ?>
                                                                    <div>
                                                                        <input type="text" name="method[]" value="<?php echo set_value('method[]', $method); ?>"class="form-control">
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php echo form_error('method[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                <?php foreach($combined3 as $parameterName => $result): ?>
                                                                    <div>   
                                                                        <input type="text" name="result[]" value="<?php echo set_value('result[]', $result); ?>"class="form-control">
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                <?php echo form_error('result[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-info btn-lg btn-block">SIMPAN</button>

                                            </div>
                                        
                                        </div>
                                    </form> <?php
                                }
                            ?>