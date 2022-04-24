<div class="container-fluid" style="height:245px; background-color: rgba(255,74,59,1);">

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
							<input type="text" name="keyword" class="form-control" placeholder="Nomor sampel/pasien/kiriman" autocomplete="off">
							<div class="input-group-append">
								<input class="btn btn-danger" type="submit" name="submit" value="Cari">
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
							<th style="text-align: center; vertical-align: middle;">Kiriman</th>
							<th colspan="4" style="text-align: center; vertical-align: middle;">Aksi</th>
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
									<td style="text-align: center; vertical-align: middle;"><?php echo $vo->sender ?></td>
									<td width="20px"><?php echo anchor('cs/order/printNota/'.$vo->orderId, '<div class="btn btn-sm btn-success"><i class="fa fa-print"></i></div>') ?></td>
									<td width="20px"><?php echo anchor('cs/order/update/'.$vo->orderId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
									<td width="20px"><?php echo anchor('cs/order/mail/'.$vo->orderId, '<div class="btn btn-sm btn-warning"><i class="fas fa-envelope-open-text"></i></div>') ?></td>
									<?php 
										if($vo->statusId == 1 || $vo->statusId == 2)
										{
											?><td width="20px"><div class="btn btn-sm btn-danger" data-toggle="modal" onclick="confirm_modal('<?php echo site_url("cs/order/delete/".$vo->orderId.'/'.$vo->custId.'/'.$vo->Samples);?>','Title');" data-target="#myModal"><i class="fa fa-trash"></i></div></td><?php
										}
										else
										{
											?><td width="20px"><div class="btn btn-sm btn-secondary" disabled><i class="fa fa-trash"></i></div></td><?php
										}
									?>
								</tr>
								<?php endforeach; ?>
						</thead>
					</table>

					<?php echo $this->pagination->create_links(); ?>

			</div>
		
	</div>

</div>

		<!-- Delete Modal -->
		<div class="modal fade" id="modal_delete_m_n" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content" style="margin-top:100px;">
                    <div class="modal-body">Apa anda yakin untuk menghapus data ini?</div>
                    <div class="modal-footer">
    					<span id="preloader-delete"></span>
                        </br>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" id="delete_cancel_link">Batal</button>
                    	  <a class="btn btn-danger" id="delete_link_m_n" href="">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

    	<script>
    	function confirm_modal(delete_url,title)
    	{
    		jQuery('#modal_delete_m_n').modal('show', {backdrop: 'static',keyboard :false});
    		jQuery("#modal_delete_m_n .grt").text(title);
    		document.getElementById('delete_link_m_n').setAttribute("href" , delete_url );
    		document.getElementById('delete_link_m_n').focus();
    	}
    	</script>