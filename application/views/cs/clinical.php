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
				<div class="row">
					<div class="col-sm-12 col-md-9">
						<?php echo anchor('cs/clinical/input', '<button class="btn btn-outline-danger m-0"><i class="fas fa-plus fa-sm"></i> Tambah Klinisi</button>') ?>
					</div>

					<div class="col-sm-12 col-md-3">
						<form>
							<div class="input-group">
								<input type="text" name="custName" class="form-control bg-light small" placeholder="Cari pasien..."
									aria-label="Search" aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-danger" type="button">
										<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
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