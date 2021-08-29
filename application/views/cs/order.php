<div class="container-fluid">

 	<!-- flash data for successfully insert data -->
 	<?php echo $this->session->flashdata('message') ?>

 	<?php echo anchor('cs/order/input', '<button class="btn btn-sm btn-danger mb-3"><i class="fas fa-plus fa-sm"></i> Tambah Order</button>') ?>

	<div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">DATA ORDER</h6>
        </div>

            <div class="card-body">
              	<div class="table-responsive">
                	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  	<thead>
 						<tr>
 							<th style="text-align: center; vertical-align: middle;">No.</th>
 							<th style="text-align: center; vertical-align: middle;">Tanggal Order</th>
							<th style="text-align: center; vertical-align: middle;">Jam Order</th>
 							<th style="text-align: center; vertical-align: middle;">Nama</th>
							<th style="text-align: center; vertical-align: middle;">Usia</th>
            				<th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
							<th style="text-align: center; vertical-align: middle;">Kontak</th>
							<th style="text-align: center; vertical-align: middle;">Alamat</th>
							<th style="text-align: center; vertical-align: middle;">Kiriman</th>
 							<th colspan="3" style="text-align: center; vertical-align: middle;">Aksi</th>
 						</tr>

						 <?php 
						 	$no=1;
							foreach ($viewOrder as $vo): ?>

							<tr>
								<td width="20px"><?php echo $no++ ?></td>
								<td><?php 
										$date = new DateTime($vo->orderTime);
										$date = $date->format('d F Y');
										echo $date;
									?>
									</td>
									<td><?php 
										$time = new DateTime($vo->orderTime);
										$time = $time->format('H:i:s A');
										echo $time;
									?>
									</td>
								<td><?php echo $vo->custName ?></td>
								<td><?php 
										$birth = new DateTime($vo->birthDate);
										$now = new DateTime();
										$age = $now->diff($birth);
										echo $age->y;
									?>
									</td>
								<td><?php echo $vo->gender ?></td>
								<td><?php echo $vo->contact ?></td>
								<td><?php echo $vo->address ?></td>
								<td><?php echo $vo->sender ?></td>
								<td width="20px"><?php echo anchor('cs/order/print/'.$vo->orderId,'<div class="btn btn-sm btn-success"><i class="fa fa-print"></i></div>') ?></td>
								<td width="20px"><?php echo anchor('cs/order/update/'.$vo->orderId,'<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
 								<td width="20px"><?php echo anchor('cs/order/delete/'.$vo->orderId,'<div class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
						 	</tr>
						 <?php endforeach; ?>

					</thead>
					</table>
				</div>
			</div>
		
		</div>

</div>