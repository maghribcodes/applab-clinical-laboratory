<div class="container-fluid" style="height:250px; background-color: rgba(255,74,59,1);">

	<!-- Page Heading -->
	<div>
        <br></br>
        <h2 class="m-0 font-weight text-light"><b>Data Klinisi</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>
	
 	<!-- flash data for successfully insert data -->
 	<?php echo $this->session->flashdata('message') ?>

	<div class="card shadow mb-4">

        <div class="card-header py-3">
			<button class="btn btn-outline-danger m-0" data-toggle="modal" data-target="#clinicalModal"><i class="fas fa-plus fa-sm"></i> New Clinical</button>
		</div>

		<!-- Clinical Modal-->
		<div class="modal fade" id="clinicalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Data Klinisi</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form method="post" action="<?php echo base_url('cs/clinical/inputClinical') ?>">
							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
									<div class="col-sm-4">
										<input type="text" name="custName" class="form-control" value="<?php echo set_value('custName'); ?>">
										<?php echo form_error('custName', '<div class="text-danger small">','</div>') ?>
									</div>
								<label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
									<div class="col-sm-4">
										<input type="date" name="birthDate" class="form-control" id="inputEmail3" value="<?php echo set_value('birthDate'); ?>">
										<?php echo form_error('birthDate', '<div class="text-danger small">','</div>') ?>
									</div>
							</div>

							<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Kontak</label>
									<div class="col-sm-4">
										<input type="name" name="contact" class="form-control" id="inputEmail3" value="<?php echo set_value('contact'); ?>">
										<?php echo form_error('contact', '<div class="text-danger small">','</div>') ?>
									</div>
									<label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
									<div class="col-sm-4">
										<input type="name" name="address" class="form-control" id="inputEmail3" value="<?php echo set_value('address'); ?>">
										<?php echo form_error('address', '<div class="text-danger small">','</div>') ?>
									</div>
							</div>

							<fieldset class="form-group">
								<div class="row">
									<legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
										<div class="col-sm-10">
											<div class="form-check">
												<input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="Laki-laki" <?php echo set_radio('gender','Laki-laki'); ?>>
													<label class="form-check-label" for="gridRadios1">
														Laki-laki
													</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="Perempuan" <?php echo set_radio('gender','Perempuan'); ?>>
													<label class="form-check-label" for="gridRadios2">
														Perempuan
													</label>
											</div>
											<?php echo form_error('gender', '<div class="text-danger small">','</div>') ?>
										</div>
								</div>
							</fieldset>
						
					</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-danger">Simpan</button>
				</div>
				
				</form>
				
				</div>
			</div>
		</div>

            <div class="card-body">
              	<div class="table-responsive">

					<table class="table table-bordered" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th style="text-align: center; vertical-align: middle;">No.</th>
								<th style="text-align: center; vertical-align: middle;">Nama Pasien</th>
								<th style="text-align: center; vertical-align: middle;">Usia</th>
								<th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                                <th style="text-align: center; vertical-align: middle;">Kontak</th>
								<th style="text-align: center; vertical-align: middle;">Alamat</th>
								<th style="text-align: center; vertical-align: middle;">Status Klinisi</th>
								<th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
							</tr>

							<?php 
								$no=1;
								foreach ($viewClinical as $vc): ?>
								<tr>
									<td width="20px" style="text-align: center; vertical-align: middle;"><?php echo $no++ ?></td>
									<td style="vertical-align: middle;"><?php echo $vc->custName ?></td>
									<td style="text-align: center; vertical-align: middle;"><?php 
											$birth = new DateTime($vc->birthDate);
											$now = new DateTime();
											$age = $now->diff($birth);
											echo $age->y;
										?>
										</td>
									<td style="text-align: center; vertical-align: middle;"><?php echo $vc->gender ?></td>
									<td style="text-align: center; vertical-align: middle;"><?php echo $vc->contact ?></td>
                                    <td style="text-align: center; vertical-align: middle;"><?php echo $vc->address ?></td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <?php 
                                            if($vc->sender != NULL)
                                            {
                                                ?><span class="badge badge-pill badge-success">Complete</span><?php
                                            }
                                            else
                                            {
                                                ?><span class="badge badge-pill badge-danger">Waiting</span><?php
                                            }
                                        ?>
                                    </td>
									<td width="20px"><?php echo anchor('cs/clinical/update/'.$vc->orderId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
									<td width="20px"><?php echo anchor('cs/clinical/delete/'.$vc->orderId, '<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
								</tr>
								<?php endforeach; ?>
						</thead>
					</table>

				</div>
			</div>
		
		</div>

</div>