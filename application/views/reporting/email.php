<div class="container-fluid" style="height:245px; background-color: rgba(28, 200, 138, 1);">
    <!-- Page Heading -->
	<div>
        <br>
        <h2 class="m-0 font-weight text-light"><b>Data Hasil Uji</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>

    <?php foreach($viewResult as $vr){} ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-2">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-success">Kirim Hasil Uji via email</h6>
                        </div>

                        <?php 
                            if($vr->statusId == 6)
                            {
                            ?>  <div class="card-body">
                                    <div class="alert alert-success" role="alert">
                                        Anda harus mendapatkan persetujuan dari Manager Teknik Lab. Klinik terlebih dahulu.
                                    </div>
                                </div>
                            <?php
                            }
                            else
                            {?>
                            <form method="post" action="<?php echo base_url('reporting/dashboard/sendMail') ?>" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <input type="hidden" name="custId" value="<?php echo $vr->custId ?>">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Pasien</label>
                                            <div class="col-sm-9 mb-3 mb-sm-0">
                                                <span class="input-group-text" id="basic-addon1"><?php echo $vr->custName ?></span>
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <input type="hidden" name="email" value="<?php echo $vr->email ?>">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email Pasien</label>
                                            <div class="col-sm-9 mb-3 mb-sm-0">
                                                <span class="input-group-text" id="basic-addon1"><?php echo $vr->email ?></span>
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Subjek</label>
                                            <div class="col-sm-9 mb-3 mb-sm-0">
                                            <input type="text" name="subject" value="<?php echo $subject ?>" class="form-control" id="inputEmail3">
                                            </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-3 col-form-label">Pesan</label>
                                            <div class="col-sm-9">
                                                <textarea name="message" class="form-control"></textarea>
                                            </div>  
                                        </div>
                                    </fieldset>
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">File</label>
                                        <div class="input-group col-sm-9 mb-3 mb-sm-0">
                                            <div class="custom-file">
                                                <input type="file" name="file" accept=".doc,.docx, .pdf" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-success" type="submit">Kirim</button>
                                    </div>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>