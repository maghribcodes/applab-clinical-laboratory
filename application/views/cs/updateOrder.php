<div class="container-fluid">

<!-- Page Heading -->
    <div>
        <br>
        <h2 class="m-0 font-weight text-danger"><b>Update Order</b></h2>
        <h6 class="m-0 font-weight text-danger">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>

    <?php
        $samples=array();
        $parameters=array();

        foreach($updateOrder as $uo)
        {
            $samples[] = $uo->noSample;
            $sampleTypes[] = $uo->sampleType;
            $parameters[] = $uo->parameterId;
            $samp = array_unique($samples);
            $type = array_unique($sampleTypes);
            $param = array_unique($parameters);
        }?>
        
    <form method="post" action="<?php echo base_url('cs/order/updateOrder/'.$uo->orderId) ?>">
        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">DATA PASIEN</h6>
            </div>

            <div class="card-body">
                <div class="alert alert-danger" role="alert">
                    Nomor sampel: <?php echo implode(', ', $samp); ?>
                </div>
                <form>
                    <div class="form-group row">
                        <input type="hidden" name="orderId" value="<?php echo $uo->orderId ?>">
                        <input type="hidden" name="custId" value="<?php echo $uo->custId ?>">
                        <input type="hidden" name="samples" value="<?php echo implode(', ', $samp); ?>">
                        <input type="hidden" name="types" value="<?php echo implode(', ', $type); ?>">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tipe Sampel</label>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input autocomplete="off" type="text" name="sampleType" class="form-control" value="<?php echo set_value('sampleType', implode(', ', $type)); ?>">
                                <?php echo form_error('sampleType', '<div class="text-danger small">','</div>') ?>
                            </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Pengirim</label>
                            <div class="col-sm-4">
                                <input autocomplete="off" type="name" name="sender" value="<?php echo set_value('sender', $uo->sender)?>" class="form-control" id="inputEmail3">
                                <?php echo form_error('sender', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
                            <div class="col-sm-4">
                                <input autocomplete="off" type="text" name="custName" class="form-control" value="<?php echo set_value('custName', $uo->custName) ?>">
                                <?php echo form_error('custName', '<div class="text-danger small">','</div>') ?>
                            </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input autocomplete="off" type="date" name="birthDate" class="form-control" id="inputEmail3" value="<?php echo set_value('birthDate', $uo->birthDate) ?>">
                                <?php echo form_error('birthDate', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Kontak</label>
                            <div class="col-sm-4">
                                <input autocomplete="off" type="name" name="contact" class="form-control" id="inputEmail3" value="<?php echo set_value('contact', $uo->contact) ?>">
                                <?php echo form_error('contact', '<div class="text-danger small">','</div>') ?>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-4">
                                <input autocomplete="off" type="name" name="address" class="form-control" id="inputEmail3" value="<?php echo set_value('address', $uo->address) ?>">
                                <?php echo form_error('address', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios1" 
                                            value="Laki-laki" <?php echo set_value('gender', $uo->gender) == 'Laki-laki' ? "checked" : ""; ?>>
                                            <label class="form-check-label" for="gridRadios1">
                                                Laki-laki
                                            </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gridRadios2" 
                                            value="Perempuan" <?php echo set_value('gender', $uo->gender) == 'Perempuan' ? "checked" : ""; ?>>
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
                                <textarea name="clinicalNotes" class="form-control"><?php echo set_value('clinicalNotes', $uo->clinicalNotes); ?></textarea>
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

                        <!-- First Column -->
                        
                        <div class="col-lg-4">

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Hematologi</h6>
                                </div>
                                
                                <div class="card-body">
                                
                                <?php 
                                    $no=1; foreach($viewParameterA as $hematologi) :
                                        $s=FALSE;
                                        if(in_array($hematologi->parameterId, $param))
                                        {
                                            $s=TRUE;
                                        }
                                        if($hematologi->reagenId == 1)
                                        {
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parameterId[]"
                                                value="<?php echo $hematologi->parameterId; ?>"
                                                <?php echo set_checkbox('parameterId[]', $hematologi->parameterId, $s); ?>
                                                id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    <?php echo $no++ ?>. <?php echo $hematologi->parameterName ?>
                                                </label>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                                            <label class="form-check-label" for="defaultCheck2">
                                                <?php echo $no++ ?>. <?php echo $hematologi->parameterName ?>
                                            </label>
                                        </div>
                                    <?php } endforeach; ?>

                                </div>

                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Mikrobiologi</h6>
                                </div>
                                
                                <div class="card-body">

                                <?php
                                    $no=1; foreach($viewParameterD as $mikrobiologi) :
                                        $s=FALSE;
                                        if(in_array($mikrobiologi->parameterId, $param))
                                        {
                                            $s=TRUE;
                                        }
                                        if($mikrobiologi->reagenId == 1){
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parameterId[]"
                                                value="<?php echo $mikrobiologi->parameterId; ?>" 
                                                <?php echo set_checkbox('parameterId[]', $mikrobiologi->parameterId, $s); ?>
                                                id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    <?php echo $no++ ?>. <?php echo $mikrobiologi->parameterName ?>
                                                </label>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                                            <label class="form-check-label" for="defaultCheck2">
                                                <?php echo $no++ ?>. <?php echo $mikrobiologi->parameterName ?>
                                            </label>
                                        </div>
                                    <?php } endforeach; ?>
                                    <?php echo form_error('parameterId[]', '<div class="text-danger small">','</div>') ?>
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
                                    
                                <?php $no=1; foreach($viewParameterB as $kimiaklinik) :
                                        $s=FALSE;
                                        if(in_array($kimiaklinik->parameterId, $param))
                                        {
                                            $s=TRUE;
                                        }
                                        if($kimiaklinik->reagenId == 1){
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parameterId[]"
                                                    value="<?php echo $kimiaklinik->parameterId; ?>" 
                                                    <?php echo set_checkbox('parameterId[]', $kimiaklinik->parameterId, $s); ?>
                                                    id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    <?php echo $no++ ?>. <?php echo $kimiaklinik->parameterName ?>
                                                </label>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                                            <label class="form-check-label" for="defaultCheck2">
                                                <?php echo $no++ ?>. <?php echo $kimiaklinik->parameterName ?>
                                            </label>
                                        </div>
                                    <?php } endforeach; ?>

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

                                <?php $no=1; foreach($viewParameterC as $serologi) :
                                        $s=FALSE;
                                        if(in_array($serologi->parameterId, $param))
                                        {
                                            $s=TRUE;
                                        }
                                        if($serologi->reagenId == 1){
                                        ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="parameterId[]"
                                                value="<?php echo $serologi->parameterId; ?>" 
                                                <?php echo set_checkbox('parameterId[]', $serologi->parameterId, $s); ?> 
                                                id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    <?php echo $no++ ?>. <?php echo $serologi->parameterName ?>
                                                </label>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                                            <label class="form-check-label" for="defaultCheck2">
                                                <?php echo $no++ ?>. <?php echo $serologi->parameterName ?>
                                            </label>
                                        </div>
                                    <?php } endforeach; ?>
                        
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="card-body">
                <button type="submit" class="btn btn-danger btn-lg btn-block">UPDATE</button>
            </div>

        </div>

    </form>
</div>