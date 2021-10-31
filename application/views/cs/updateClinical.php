<div class="container-fluid" style="height:245px; background-color: rgba(255,74,59,1);">

<!-- Page Heading -->
    <div>
        <br>
        <h2 class="m-0 font-weight text-light"><b>Update Data</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>

<?php 
    foreach ($updateClinical as $uc): ?>

<form method="post" action="<?php echo base_url('cs/clinical/updateClinical/'.$uc->custId) ?>">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">DATA PASIEN</h6>
        </div>

        <div class="card-body">

            <form>
                <div class="form-group row">
                    <input type="hidden" name="custId" value="<?php echo $uc->custId ?>">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
                        <div class="col-sm-4">
                            <input type="text" name="custName" class="form-control" value="<?php echo set_value('custName', $uc->custName)?>">
                            <?php echo form_error('custName', '<div class="text-danger small">','</div>') ?>
                        </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-4">
                            <input type="date" name="birthDate" class="form-control" id="inputEmail3" value="<?php echo set_value('birthDate', $uc->birthDate)?>">
                            <?php echo form_error('birthDate', '<div class="text-danger small">','</div>') ?>
                        </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-4">
                            <input type="name" name="contact" class="form-control" id="inputEmail3" value="<?php echo set_value('contact', $uc->contact)?>">
                            <?php echo form_error('contact', '<div class="text-danger small">','</div>') ?>
                        </div>
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-4">
                            <input type="name" name="address" class="form-control" id="inputEmail3" value="<?php echo set_value('address', $uc->address)?>">
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
            </form>

        </div>

        <div class="card-body">
            <button type="submit" class="btn btn-danger btn-lg btn-block">SIMPAN</button>
        </div>

    </div>

</form>

<?php endforeach; ?>

</div>