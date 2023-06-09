<div class="container-fluid" style="height:245px; background-color: rgba(255,74,59,1);">

	<!-- Page Heading -->
	<div>
        <br>
        <h2 class="m-0 font-weight text-light"><b>Data Pasien</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>
	
 	<!-- flash data for successfully insert data -->
 	<?php echo $this->session->flashdata('message') ?>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-sm-12 col-md-8">
					<?php echo anchor('cs/clinical/input', '<button class="btn btn-outline-danger m-0"><i class="fas fa-plus fa-sm"></i> Tambah Data</button>') ?>
				</div>

				<div class="col-sm-12 col-md-4">
					<form method="post" action="<?php echo base_url('cs/clinical') ?>">
						<div class="input-group">
							<input type="text" name="keyword" class="form-control" placeholder="Cari pasien..." autocomplete="off">
							<div class="input-group-append">
								<input class="btn btn-danger" type="submit" name="submit" value="Submit">
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
						if(empty($viewClinical)): ?>
						<tr>
							<td colspan=8>
								<div class="alert alert-danger" role="alert">
									Data tidak ditemukan.
								</div>
							</td>
						</tr>
						<?php endif;

						foreach ($viewClinical as $vc): ?>
						<tr>
							<td width="20px" style="text-align: center; vertical-align: middle;"><?php echo ++$start ?></td>
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
                                        ?><span class="badge badge-pill badge-success">Lengkap</span><?php
                                    }
                                    else
                                    {
                                        ?><span class="badge badge-pill badge-danger">Menunggu</span><?php
                                    }
                                ?>
                            </td>
							<td width="20px"><?php echo anchor('cs/clinical/update/'.$vc->custId, '<div class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
							<?php 
								if($vc->statusId == 1)
								{
									?><td width="20px"><div class="btn btn-sm btn-danger" data-toggle="modal" onclick="confirm_modal('<?php echo site_url("cs/clinical/delete/".$vc->orderId.'/'.$vc->custId);?>','Title');" data-target="#myModal"><i class="fa fa-trash"></i></div></td><?php
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