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
                    $parameters=array();

                    foreach($viewSample as $vs)
                    {
                        $samples[] = $vs->noSample;
                        $parameters[] = $vs->parameterName;
                        $samp = array_unique($samples);
                        $param = array_unique($parameters);
                    }?>

                <form method="post" action="<?php echo base_url('sampling/dashboard/inputSample') ?>">
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
                                            <?php foreach($samp as $s): ?>
                                                <div class="input-group mb-3">
                                                <input type="hidden" name="orderId" value="<?php echo $vs->orderId ?>">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><?php echo $s ?></span>
                                                    </div>
                                                    <input type="text" name="type[]" class="form-control" placeholder="Tipe sampel..." aria-label="Username" aria-describedby="basic-addon1">
                                                </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 mb-4">
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-secondary">DATA PARAMETER</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php foreach($param as $p): ?>
                                                <div class="row">
                                                    <label class="col-sm-4"><?php echo $p ?></label>
                                                    <div class="dropdown col-sm-2">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Unit
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">%</a>
                                                            <a class="dropdown-item" href="#">g/dL</a>
                                                            <a class="dropdown-item" href="#">/uL</a>
                                                            <a class="dropdown-item" href="#">mm/Jam</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="custName" placeholder="Nilai rujukan..." class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-secondary btn-lg btn-block">SIMPAN</button>
                        </div>
                    </div>
                </form>