<div class="container-fluid" style="height:250px; background-color: rgba(255,74,59,1);">

	<!-- Page Heading -->
	<div>
        <br>
        <h2 class="m-0 font-weight text-light"><b>Data Order</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>
	
 	<!-- flash data for successfully insert data -->
 	<?php echo $this->session->flashdata('message') ?>

	<div class="card shadow mb-4">
        <div class="card-header py-3">
			<div class="row">
				<div class="col-sm-12 col-md-8">
					<?php echo anchor('cs/order/input', '<button class="btn btn-outline-danger m-0"><i class="fas fa-plus fa-sm"></i> Tambah Order</button>') ?>
				</div>

				<div class="col-sm-12 col-md-4">
					<form method="post" action="<?php echo base_url('cs/order') ?>">
						<div class="input-group">
							<input type="text" name="keyword" class="form-control" placeholder="Cari nomor sampel..." autocomplete="off">
							<div class="input-group-append">
								<input class="btn btn-danger" type="submit" name="submit" value="Submit">
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>

            <div class="card-body">
				<table class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th style="text-align: center; vertical-align: middle;">No.</th>
							<th style="text-align: center; vertical-align: middle;">No. Sampel</th>
							<th style="text-align: center; vertical-align: middle;">Tanggal Order</th>
							<th style="text-align: center; vertical-align: middle;">Jam Order</th>
							<th style="text-align: center; vertical-align: middle;">Nama</th>
							<th style="text-align: center; vertical-align: middle;">Usia</th>
							<th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
							<th style="text-align: center; vertical-align: middle;">Kiriman</th>
							<th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
						</tr>

							<?php 
								if(empty($viewOrder)): ?>
								<tr>
									<td colspan=9>
										<div class="alert alert-danger" role="alert">
											Data tidak ditemukan.
										</div>
									</td>
								</tr>
								<?php endif;
								
								foreach ($viewOrder as $vo): ?>
								<tr>
									<td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
									<td style="vertical-align: middle;"><?php
										echo $vo->Samples;
									?></td>
									<td style="vertical-align: middle;"><?php 
											$date = new DateTime($vo->orderTime);
											$date = $date->format('d F Y');
											echo $date;
										?>
										</td>
									<td style="vertical-align: middle;"><?php 
											$time = new DateTime($vo->orderTime);
											$time = $time->format('H:i:s A');
											echo $time;
										?>
										</td>
									<td style="vertical-align: middle;"><?php echo $vo->custName ?></td>
									<td style="text-align: center; vertical-align: middle;"><?php 
											$birth = new DateTime($vo->birthDate);
											$now = new DateTime();
											$age = $now->diff($birth);
											echo $age->y;
										?>
										</td>
									<td style="text-align: center; vertical-align: middle;"><?php echo $vo->gender ?></td>
									<td style="text-align: center; vertical-align: middle;"><?php echo $vo->sender ?></td>
									<td width="20px"><?php echo anchor('cs/order/nota/'.$vo->orderId, '<div class="btn btn-sm btn-success"><i class="far fa-eye"></i></div>') ?></td>
									<td width="20px"><?php echo anchor('cs/order/update/'.$vo->orderId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
									<td width="20px"><div class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i></div></td>

										<!-- Delete Modal-->
										<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
											aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-body">Apa anda yakin untuk menghapus data ini?</div>
													<div class="modal-footer">
														<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
														<?php echo anchor('cs/order/delete/'.$vo->orderId.'/'.$vo->custId.'/'.$vo->Samples,'<div class="btn btn-danger">Hapus</div>') ?>
													</div>
												</div>
											</div>
										</div>
										
								</tr>
								<?php endforeach; ?>
						</thead>
					</table>

					<?php echo $this->pagination->create_links(); ?>

			</div>
		
	</div>

</div>