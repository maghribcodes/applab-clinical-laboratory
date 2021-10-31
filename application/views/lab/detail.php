                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(54, 185, 204, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Hasil Uji</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <?php
                        $parameterIds=array();
                        $parameterNames=array();
                        $results=array();
                        $methods=array();

                        foreach($viewSample as $vs)
                        {
                            $parameterIds[] = $vs->parameterId;
                            $parameterNames[] = $vs->parameterName;
                            $results[] = $vs->result;
                            $methods[]= $vs->method;

                            $combined2 = array_combine($parameterNames, $methods);
                            $combined3 = array_combine($parameterNames, $results);
                        }
                    ?>

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
                                                    <span class="input-group-text m-0 text-secondary"><?php echo $method ?></span>
                                                        <br>
                                                    </div>
                                                <?php endforeach; ?>
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
                                                    <span class="input-group-text m-0 text-secondary"><?php echo $result ?></span>
                                                        <br>
                                                    </div>
                                                <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>