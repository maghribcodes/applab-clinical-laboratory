<div class="container-fluid" style="height:250px; background-color: rgba(78, 115, 223, 1);">

<!-- Page Heading -->
    <div>
        <br></br>
        <h2 class="m-0 font-weight text-light"><b>Data Klinisi</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>
    <?php
    foreach($updateClinical as $uc){}
    foreach($lastSample as $ls){}
    ?>

    <form method="post" action="<?php echo base_url('doctor/dashboard/inputClinical/'.$uc->orderId) ?>">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DATA PASIEN</h6>
            </div>

            <div class="card-body">
                <div class="alert alert-primary" role="alert">
                    Nomor sampel terakhir: <?php echo $ls->noSample ?>
                </div>

                <form>
                    <div class="form-group row">
                        <input type="hidden" name="orderId" value="<?php echo $uc->orderId ?>">
                        <input type="hidden" name="custId" value="<?php echo $uc->custId ?>">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No. Sampel</label>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="text" name="noSample" class="form-control" value="<?php echo set_value('noSample'); ?>">
                                <?php echo form_error('noSample', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
                            <div class="col-sm-4">
                                <input type="text" name="custName" class="form-control" value="<?php echo set_value('custName', $uc->custName) ?>">
                                <?php echo form_error('custName', '<div class="text-danger small">','</div>') ?>
                            </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input type="date" name="birthDate" class="form-control" id="inputEmail3" value="<?php echo set_value('birthDate', $uc->birthDate) ?>">
                                <?php echo form_error('birthDate', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kontak</label>
                            <div class="col-sm-4">
                                <input type="name" name="contact" class="form-control" id="inputEmail3" value="<?php echo set_value('contact', $uc->contact) ?>">
                                <?php echo form_error('contact', '<div class="text-danger small">','</div>') ?>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-4">
                                <input type="name" name="address" class="form-control" id="inputEmail3" value="<?php echo set_value('address', $uc->address) ?>">
                                <?php echo form_error('address', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" 
                                            value="Laki-laki" <?php echo set_value('gender', $uc->gender) == 'Laki-laki' ? "checked" : ""; ?>>
                                            <label class="form-check-label" for="gridRadios1">
                                                Laki-laki
                                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" 
                                            value="Perempuan" <?php echo set_value('gender', $uc->gender) == 'Perempuan' ? "checked" : ""; ?>>
                                            <label class="form-check-label" for="gridRadios2">
                                                Perempuan
                                            </label>
                                    </div>
                                    <?php echo form_error('gender', '<div class="text-danger small">','</div>') ?>
                                </div>
                        </div>
                    </fieldset>

                    <fieldset class="form-group">
                        <div class="row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan Klinisi</label>
                            <div class="col-sm-10">
                                <textarea name="clinicalNotes" class="form-control"><?php echo set_value('clinicalNotes', $uc->clinicalNotes); ?></textarea>
                            </div>
                        </div>
                    </fieldset>

                </form>
    <?php //} ?>
            </div>

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">LAB UJI TERKAIT</h6>
            </div>

            <div class="card-body">

                <div class="container-fluid">
                <!-- Content Row -->
                    <div class="row">

                        <!-- First Column -->
                        
                        <div class="col-lg-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Hematologi</h6>
                                </div>
                                
                                <div class="card-body">
                                
                                    <?php $no=1; foreach($viewParameterA as $hematologi) : ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]"
                                            value="<?php echo $hematologi->parameterId; ?>"
                                            <?php echo set_checkbox('parameterId[]', $hematologi->parameterId); ?> id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <?php echo $no++ ?>. <?php echo $hematologi->parameterName ?>
                                            </label>
                                    </div>
                                    
                                    <?php endforeach; ?>

                                </div>

                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Mikrobiologi</h6>
                                </div>
                                
                                <div class="card-body">

                                    <?php $no=1; foreach($viewParameterD as $mikrobiologi) : ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]"
                                            value="<?php echo $mikrobiologi->parameterId; ?>" 
                                            <?php echo set_checkbox('parameterId[]', $mikrobiologi->parameterId); ?> id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <?php echo $no++ ?>. <?php echo $mikrobiologi->parameterName ?>
                                            </label>
                                    </div>

                                    <?php endforeach; ?>
                                    <?php echo form_error('parameterId[]', '<div class="text-danger small">','</div>') ?>
                                </div>
                            </div>

                        </div>

                        <!-- Second Column -->
                        <div class="col-lg-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Kimia Klinik</h6>
                                </div>
                                
                                <div class="card-body">
                                    
                                    <?php $no=1; foreach($viewParameterB as $kimiaklinik) : ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]"
                                                value="<?php echo $kimiaklinik->parameterId; ?>" 
                                                <?php echo set_checkbox('parameterId[]', $kimiaklinik->parameterId); ?> id="defaultCheck1">
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
                                    <h6 class="m-0 font-weight-bold text-primary">Serologi</h6>
                                </div>
                                
                                <div class="card-body">

                                    <?php $no=1; foreach($viewParameterC as $serologi) : ?>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="parameterId[]"
                                            value="<?php echo $serologi->parameterId; ?>" 
                                            <?php echo set_checkbox('parameterId[]', $serologi->parameterId); ?> id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                <?php echo $no++ ?>. <?php echo $serologi->parameterName ?>
                                            </label>
                                    </div>

                                    <?php endforeach; ?>
                        
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-body">
                <button type="submit" class="btn btn-primary btn-lg btn-block">SIMPAN</button>
            </div>

        </div>

    </form>
</div>