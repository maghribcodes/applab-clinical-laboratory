<div class="container-fluid" style="height:250px; background-color: rgba(195,0,0,1.48);">

<!-- Page Heading -->
    <div>
        <br></br>
        <h2 class="m-0 font-weight text-light"><b>Update Order</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>

<?php foreach($updateOrder as $uo) : ?>

    <form method="post" action="<?php echo base_url('cs/order/updateOrder') ?>">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">DATA PASIEN</h6>
            </div>

            <div class="card-body">

                <form>
                    <div class="form-group row">
                        <input type="hidden" name="orderId" value="<?php echo $uo->orderId ?>">
                        <?php ?>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No. Sampel</label>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="text" name="noSample" class="form-control"
                                        value="<?php 
                                                    echo $uo->noSample;
                                                ?>">
                                <?php echo form_error('noSample', '<div class="text-danger small">','</div>') ?>
                            </div>
                        <?php ?>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pengirim</label>
                            <div class="col-sm-4">
                                <input type="name" name="sender" value="<?php echo $uo->sender ?>" class="form-control" id="inputEmail3">
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
                            <div class="col-sm-4">
                                <input type="text" name="custName" class="form-control" value="<?php echo $uo->custName ?>">
                                <?php echo form_error('custName', '<div class="text-danger small">','</div>') ?>
                            </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input type="date" name="birthDate" class="form-control" id="inputEmail3" value="<?php echo $uo->birthDate ?>">
                                <?php echo form_error('birthDate', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kontak</label>
                            <div class="col-sm-4">
                                <input type="name" name="contact" class="form-control" id="inputEmail3" value="<?php echo $uo->contact ?>">
                                <?php echo form_error('contact', '<div class="text-danger small">','</div>') ?>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-4">
                                <input type="name" name="address" class="form-control" id="inputEmail3" value="<?php echo $uo->address ?>">
                                <?php echo form_error('address', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="<?php echo $uo->gender ?>" <?php if($uo->gender=='Laki-laki') echo 'checked="checked"' ?>>
                                            <label class="form-check-label" for="gridRadios1">
                                                Laki-laki
                                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="<?php echo $uo->gender ?>" <?php if($uo->gender=='Perempuan') echo 'checked="checked"' ?>>
                                            <label class="form-check-label" for="gridRadios2">
                                                Perempuan
                                            </label>
                                    </div>
                                    <?php echo form_error('gender', '<div class="text-danger small">','</div>') ?>
                                </div>
                        </div>
                    </fieldset>
                </form>

            </div>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">LAB UJI TERKAIT</h6>
            </div>

            <div class="card-body">

                <div class="container-fluid">
                <!-- Content Row -->
                    <div class="row">
                    <?php $check = $uo->parameterId ?>
                    <?php //foreach($checks as $check) : ?>
                        <!-- First Column -->
                        <div class="col-lg-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Hematologi</h6>
                                </div>
                                
                                <div class="card-body">

                                    <?php $no=1; foreach($viewParameterA as $hematologi) : ?>
                                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]" value="<?php echo $hematologi->parameterId; ?>" 
                                            <?php if($check == $hematologi->parameterId){echo 'checked="checked"'; } ?> id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <?php echo $no++ ?>. <?php echo $hematologi->parameterName ?>
                                            </label>
                                    </div>
                                    
                                    <?php endforeach; ?>

                                </div>

                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Mikrobiologi</h6>
                                </div>
                                
                                <div class="card-body">

                                    <?php $no=1; foreach($viewParameterD as $mikrobiologi) : ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]" value="<?php echo $mikrobiologi->parameterId; ?>" 
                                        <?php if($check == $mikrobiologi->parameterId){echo 'checked="checked"'; } ?> id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <?php echo $no++ ?>. <?php echo $mikrobiologi->parameterName ?>
                                            </label>
                                    </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>

                        </div>

                        <!-- Second Column -->
                        <div class="col-lg-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Kimia Klinik</h6>
                                </div>
                                
                                <div class="card-body">
                                    
                                    <?php $no=1; foreach($viewParameterB as $kimiaklinik) : ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]" value="<?php echo $kimiaklinik->parameterId; ?>" 
                                        <?php if($check == $kimiaklinik->parameterId){echo 'checked="checked"'; } ?> id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <?php echo $no++ ?>. <?php echo $kimiaklinik->parameterName ?>
                                            </label>
                                    </div>
                                    
                                    <?php endforeach; ?>

                                </div>
                            </div>

                        </div>

                        <!-- Third Column -->
                        <div class="col-lg-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Serologi</h6>
                                </div>
                                
                                <div class="card-body">

                                    <?php $no=1; foreach($viewParameterC as $serologi) : ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]" value="<?php echo $serologi->parameterId; ?>" 
                                        <?php if($check == $serologi->parameterId){echo 'checked="checked"'; } ?> id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <?php echo $no++ ?>. <?php echo $serologi->parameterName ?>
                                            </label>
                                    </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                    <?php //endforeach; ?>
                    </div>
                </div>

            </div>

            <div class="card-body">
                <button type="submit" class="btn btn-danger btn-lg btn-block">SIMPAN</button>
                <!--<button type="submit" class="btn btn-secondary btn-lg btn-block">BATAL</button>-->
            </div>

        </div>

    </form>
<?php endforeach; ?>
</div>