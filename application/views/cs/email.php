<div class="container-fluid" style="height:250px; background-color: rgba(255,74,59,1);">

	<!-- Page Heading -->
	<div>
        <br>
        <h2 class="m-0 font-weight text-light"><b>Data Order</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Kirim Hasil Uji via email</h6>
        </div>
        <?php foreach($viewOrder as $vo){} ?>
        <form method="post" action="<?php echo base_url('cs/order/sendMail/'.$vo->orderId) ?>">
            <div class="card-body">
                <div class="form-group row">
                    <input type="hidden" name="custId" value="<?php echo $vo->custId ?>">
				    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
						<div class="col-sm-4 mb-3 mb-sm-0">
							<span class="input-group-text" id="basic-addon1"><?php echo $vo->custName ?></span>
						</div>
				</div>
				<div class="form-group row">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-4 mb-3 mb-sm-0">
							<input type="text" name="email" class="form-control" value="<?php echo set_value('email', $vo->email); ?>">
                            <?php echo form_error('email', '<div class="text-danger small">','</div>') ?>
                        </div>
				</div>
                <div>
					<button class="btn btn-danger" type="submit">Simpan</button>
				</div>
            </div>
        </form>
    </div>