                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-info"><b>Hasil Uji</b></h2>
                        <h6 class="m-0 font-weight text-info">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>
                        <?php
                            $samples=array();
                            $sampleTypes=array();
                            $parameterIds=array();
                            $parameterNames=array();
                            $units=array();
                            $references=array();
                            $results=array();
                            $methods=array();
                        ?>
                            <?php
                                if($labName == "Hematologi")
                                {
                                    foreach($viewSampleA as $vs)
                                    {
                                        $samples[] = $vs->noSample;
                                        $sampleTypes[] = $vs->sampleType;
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $units[] = $vs->unit;
                                        $references[]= $vs->referenceValue;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined1 = array_combine($samples, $sampleTypes);
                                        $combined2 = array_combine($parameterNames, $units);
                                        $combined3 = array_combine($parameterNames, $references);
                                        $combined4 = array_combine($parameterNames, $methods);
                                        $combined5 = array_combine($parameterNames, $results);

                                        $samp = array_unique($samples);
                                        $pid = array_unique($parameterIds);
                                        $param = array_unique($parameterNames);
                                    } ?>
                                    
                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo implode(', ', $samp); ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $pid); ?>">

                                            <div class="card-body">
                                                <div class="card mb-4">
                                                    <div class="card-header py-2">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <?php foreach($combined1 as $noSample => $sampleType): ?>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $noSample ?></span>
                                                            </div>
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $sampleType ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach;?>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan Klinisi</label>
                                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <?php 
                                                                        if($vs->clinicalNotes == NULL)
                                                                        {
                                                                            echo "-";
                                                                        }
                                                                        else
                                                                        {
                                                                            echo $vs->clinicalNotes;
                                                                        }
                                                                        ?>
                                                                    </span>
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
                                                        <div class="col-sm-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                    <?php $no=1; foreach($param as $pn): 
                                                                        if($pn == "Analisa Sperma")
                                                                        {  
                                                                            ?>
                                                                                <div>
                                                                                    <span class="input-group-text m-0 text-secondary">
                                                                                        <small>
                                                                                            <?php echo $no++; ?>. <?php echo $pn ?>
                                                                                            <div align="left">
                                                                                                <div> - Warna</div>
                                                                                                <div> - Bau</div>
                                                                                                <div> - pH</div>
                                                                                                <div> - Viskositas</div>
                                                                                                <div> - Volume</div>
                                                                                                <div> - Jumlah Total/ml</div>
                                                                                                <div> - Jumlah Motil/ml</div>
                                                                                                <div> - % Motil</div>
                                                                                                <div> - Bukan bentuk oval</div>
                                                                                                <div> - Eritrosit/LPB</div>
                                                                                                <div> - Leukosit</div>
                                                                                                <div> - Sel Epitel/LPB</div>
                                                                                                <div> - Sel Muda</div>
                                                                                            </div>
                                                                                        </small>
                                                                                    </span>
                                                                                    <br>
                                                                                </div>
                                                                            <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            ?> 
                                                                                <div>
                                                                                    <span class="input-group-text m-0 text-secondary"><small><?php echo $no++; ?>. <?php echo $pn ?></small></span>
                                                                                    <br>
                                                                                </div>
                                                                            <?php
                                                                        }
                                                                    endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Satuan</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined2 as $parameterName => $unit):
                                                                    if($parameterName == "Analisa Sperma")
                                                                        {  
                                                                            ?>
                                                                                <div>
                                                                                    <span class="input-group-text m-0 text-secondary">
                                                                                        <small>
                                                                                            <div>
                                                                                                <div class="mt-4 mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                                <br>
                                                                                                <div class="mb-3"> - </div>
                                                                                            </div>
                                                                                        </small>
                                                                                    </span>
                                                                                    <br>
                                                                                </div>
                                                                            <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                                <div>
                                                                                    <span class="input-group-text m-0 text-secondary"><small><?php echo $unit ?></small></span>
                                                                                    <br>
                                                                                </div>
                                                                            <?php
                                                                        }
                                                                endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Nilai Referensi</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined3 as $parameterName => $ref):
                                                                    if($parameterName == "Analisa Sperma")
                                                                    {  
                                                                        ?>
                                                                            <div>
                                                                                <span class="input-group-text m-0 text-secondary">
                                                                                    <small>
                                                                                        <div align="left">
                                                                                            <div class="mt-4 mb-3">Putih Keruh</div>
                                                                                            <br>
                                                                                            <div class="mb-3">Khas</div>
                                                                                            <br>
                                                                                            <div class="mb-3">7 - 8</div>
                                                                                            <br>
                                                                                            <div class="mb-3">Kental</div>
                                                                                            <br>
                                                                                            <div class="mb-3">2 - 5 mL</div>
                                                                                            <br>
                                                                                            <div class="mb-3">> 20 juta</div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3">> 50%</div>
                                                                                            <br>
                                                                                            <div class="mb-3">< 50%</div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                        </div>
                                                                                    </small>
                                                                                </span>
                                                                                <br>
                                                                            </div>
                                                                        <?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                            <div>
                                                                                <span class="input-group-text m-0 text-secondary"><small><?php echo $ref ?></small></span>
                                                                                <br>
                                                                            </div>
                                                                        <?php
                                                                    }
                                                                endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined4 as $parameterName => $method):
                                                                    if($parameterName == "Analisa Sperma")
                                                                    {  
                                                                        ?>
                                                                            <div>
                                                                                <span class="input-group-text m-0 text-secondary">
                                                                                    <small>
                                                                                        <div align="left">
                                                                                            <div class="mt-4 mb-3">Makroskopis</div>
                                                                                            <br>
                                                                                            <div class="mb-3">tes</div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3">Makroskopis</div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3"> - </div>
                                                                                            <br>
                                                                                            <div class="mb-3">Mikroskopis</div>
                                                                                            <br>
                                                                                            <div class="mb-3">Mikroskopis</div>
                                                                                            <br>
                                                                                            <div class="mb-3">Mikroskopis</div>
                                                                                            <br>
                                                                                            <div class="mb-3">Mikroskopis</div>
                                                                                            <br>
                                                                                            <div class="mb-3">Mikroskopis</div>
                                                                                            <br>
                                                                                            <div class="mb-3">Mikroskopis</div>
                                                                                        </div>
                                                                                    </small>
                                                                                </span>
                                                                                <br>
                                                                            </div>
                                                                        <?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                            <div>
                                                                                <span class="input-group-text m-0 text-secondary"><small><?php echo $method ?></small></span>
                                                                                <br>
                                                                            </div>
                                                                        <?php
                                                                    }
                                                                endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined5 as $parameterName => $result):
                                                                    if($parameterName == "Analisa Sperma")
                                                                    {
                                                                        $r1 = explode(', ', $result);
                                                                        ?><br><?php
                                                                        foreach($r1 as $r2)
                                                                        {
                                                                            ?>
                                                                                <div class="form-group">
                                                                                    <input type="text" value="<?php echo set_value('resultA[]', $r2); ?>" class="form-control" autocomplete="off">
                                                                                </div>
                                                                            <?php
                                                                        }
                                                                        ?><br><?php
                                                                    }
                                                                    else
                                                                    {
                                                                        ?>
                                                                            <div class=small>  
                                                                                <input type="text" name="result[]" value="<?php echo set_value('result[]', $result); ?>" class="form-control" autocomplete="off">
                                                                                <br>
                                                                            </div>
                                                                        <?php
                                                                    }
                                                                endforeach; ?>
                                                                <?php echo form_error('result[]', '<div class="text-danger small">','</div>') ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                    <div class="row">
                                                        <!-- First Column -->
                                                        <div class="col-lg-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Tanggal Pengujian</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div>   
                                                                        <input type="date" name="testTime" value="<?php echo set_value('testTime', $vs->testTime); ?>" class="form-control" autocomplete="off">
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
                                    foreach($viewSampleB as $vs)
                                    {
                                        $samples[] = $vs->noSample;
                                        $sampleTypes[] = $vs->sampleType;
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $units[] = $vs->unit;
                                        $references[]= $vs->referenceValue;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined1 = array_combine($samples, $sampleTypes);
                                        $combined2 = array_combine($parameterNames, $units);
                                        $combined3 = array_combine($parameterNames, $references);
                                        $combined4 = array_combine($parameterNames, $methods);
                                        $combined5 = array_combine($parameterNames, $results);

                                        $samp = array_unique($samples);
                                        $pid = array_unique($parameterIds);
                                        $param = array_unique($parameterNames);
                                    } ?>
                                    
                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo implode(', ', $samp); ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $pid); ?>">

                                            <div class="card-body">
                                                <div class="card mb-4">
                                                    <div class="card-header py-2">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <?php foreach($combined1 as $noSample => $sampleType): ?>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $noSample ?></span>
                                                            </div>
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $sampleType ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach;?>
                                                </div>

                                                <div class="card-header py-2">
                                                    <h6 class="m-0 font-weight-bold text-info">DATA HASIL UJI</h6>
                                                </div>

                                                <div class="card-body">
                                                    <!-- Content Row -->
                                                    <div class="row">

                                                        <!-- First Column -->
                                                        <div class="col-sm-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                    <?php $no=1; foreach($param as $pn): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $no++; ?>. <?php echo $pn ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Satuan</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined2 as $parameterName => $unit): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $unit ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Nilai Referensi</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined3 as $parameterName => $ref): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $ref ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined4 as $parameterName => $method): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $method ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined5 as $parameterName => $result): ?>
                                                                    <div class=small>  
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
                                                        <div class="col-lg-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Tanggal Pengujian</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div>   
                                                                        <input type="date" name="testTime" value="<?php echo set_value('testTime', $vs->testTime); ?>" class="form-control" autocomplete="off">
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
                                else if($labName == "Serologi")
                                {
                                    foreach($viewSampleC as $vs)
                                    {
                                        $samples[] = $vs->noSample;
                                        $sampleTypes[] = $vs->sampleType;
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $units[] = $vs->unit;
                                        $references[]= $vs->referenceValue;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined1 = array_combine($samples, $sampleTypes);
                                        $combined2 = array_combine($parameterNames, $units);
                                        $combined3 = array_combine($parameterNames, $references);
                                        $combined4 = array_combine($parameterNames, $methods);
                                        $combined5 = array_combine($parameterNames, $results);

                                        $samp = array_unique($samples);
                                        $pid = array_unique($parameterIds);
                                        $param = array_unique($parameterNames);
                                    } ?>
                                    
                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo implode(', ', $samp); ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $pid); ?>">

                                            <div class="card-body">
                                                <div class="card mb-4">
                                                    <div class="card-header py-2">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <?php foreach($combined1 as $noSample => $sampleType): ?>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $noSample ?></span>
                                                            </div>
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $sampleType ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach;?>
                                                </div>

                                                <div class="card-header py-2">
                                                    <h6 class="m-0 font-weight-bold text-info">DATA HASIL UJI</h6>
                                                </div>

                                                <div class="card-body">
                                                    <!-- Content Row -->
                                                    <div class="row">

                                                        <!-- First Column -->
                                                        <div class="col-sm-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                    <?php $no=1; foreach($param as $pn): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $no++; ?>. <?php echo $pn ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Satuan</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined2 as $parameterName => $unit): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $unit ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Nilai Referensi</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined3 as $parameterName => $ref): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $ref ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined4 as $parameterName => $method): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $method ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined5 as $parameterName => $result): ?>
                                                                    <div class=small>  
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
                                                        <div class="col-lg-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Tanggal Pengujian</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div>   
                                                                        <input type="date" name="testTime" value="<?php echo set_value('testTime', $vs->testTime); ?>" class="form-control" autocomplete="off">
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
                                else if($labName == "Mikrobiologi")
                                {
                                    foreach($viewSampleD as $vs)
                                    {
                                        $samples[] = $vs->noSample;
                                        $sampleTypes[] = $vs->sampleType;
                                        $parameterIds[] = $vs->parameterId;
                                        $parameterNames[] = $vs->parameterName;
                                        $units[] = $vs->unit;
                                        $references[]= $vs->referenceValue;
                                        $results[] = $vs->result;
                                        $methods[]= $vs->method;

                                        $combined1 = array_combine($samples, $sampleTypes);
                                        $combined2 = array_combine($parameterNames, $units);
                                        $combined3 = array_combine($parameterNames, $references);
                                        $combined4 = array_combine($parameterNames, $methods);
                                        $combined5 = array_combine($parameterNames, $results);

                                        $samp = array_unique($samples);
                                        $pid = array_unique($parameterIds);
                                        $param = array_unique($parameterNames);
                                    } ?>
                                    
                                    <form method="post" action="<?php echo base_url('lab/dashboard/inputResult/'.$vs->orderId) ?>">
                                        <div class="card shadow mb-4">

                                            <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                            <input type="hidden" name="noSample" value="<?php echo implode(', ', $samp); ?>">
                                            <input type="hidden" name="parameterId" value="<?php echo implode(', ', $pid); ?>">

                                            <div class="card-body">
                                                <div class="card mb-4">
                                                    <div class="card-header py-2">
                                                        <h6 class="m-0 font-weight-bold text-info">DATA SAMPEL</h6>
                                                    </div>
                                                <div class="card-body">
                                                    <?php foreach($combined1 as $noSample => $sampleType): ?>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Sampel</label>
                                                            <div class="col-sm-4 mb-3 mb-sm-0">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $noSample ?></span>
                                                            </div>
                                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                                                            <div class="col-sm-4">
                                                                <span class="input-group-text" id="basic-addon1"><?php echo $sampleType ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach;?>
                                                </div>

                                                <div class="card-header py-2">
                                                    <h6 class="m-0 font-weight-bold text-info">DATA HASIL UJI</h6>
                                                </div>

                                                <div class="card-body">
                                                    <!-- Content Row -->
                                                    <div class="row">

                                                        <!-- First Column -->
                                                        <div class="col-sm-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Parameter</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                    <?php $no=1; foreach($param as $pn): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $no++; ?>. <?php echo $pn ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Satuan</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined2 as $parameterName => $unit): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $unit ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-3">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Nilai Referensi</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined3 as $parameterName => $ref): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $ref ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Metode</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined4 as $parameterName => $method): ?>
                                                                    <div>
                                                                        <span class="input-group-text m-0 text-secondary"><small><?php echo $method ?></small></span>
                                                                        <br>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="card mb-4">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Hasil</h6>
                                                                </div>
                                                                <div class="card-body pl-2 pr-2 px-2">
                                                                <?php foreach($combined5 as $parameterName => $result): ?>
                                                                    <div class=small>  
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
                                                        <div class="col-lg-3">
                                                            <div class="card mb-3">
                                                                <div class="card-header py-1">
                                                                    <h6 class="m-0 font-weight-bold text-info">Tanggal Pengujian</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div>   
                                                                        <input type="date" name="testTime" value="<?php echo set_value('testTime', $vs->testTime); ?>" class="form-control" autocomplete="off">
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
                            ?>