                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Parameter</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <?php echo $this->session->flashdata('message') ?>
                    
                    <?php 
                        $idAs = array();
                        $idBs = array();
                        $idCs = array();
                        $idDs = array();

                        foreach($idA as $a)
                        {
                            $substr = $a->parameterId;
                            $idAs[] = substr($substr, 1);
                        }
                        $lastIdA = (max($idAs));
                        ++$lastIdA;

                        foreach($idB as $b)
                        {
                            $substr = $b->parameterId;
                            $idBs[] = substr($substr, 1);
                        }
                        $lastIdB = (max($idBs));
                        ++$lastIdB;

                        foreach($idC as $c)
                        {
                            $substr = $c->parameterId;
                            $idCs[] = substr($substr, 1);
                        }
                        $lastIdC = (max($idCs));
                        ++$lastIdC;

                        foreach($idD as $d)
                        {
                            $substr = $a->parameterId;
                            $idDs[] = substr($substr, 1);
                        }
                        $lastIdD = (max($idDs));
                        ++$lastIdD;
                    ?>

                    <?php foreach($viewParam as $vpa){} ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Tambah Data Parameter</h6>
                        </div>
                        
                        <form method="post" action="<?php echo base_url('manager/parameter/editParameter/'.$vpa->parameterId) ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <input type="hidden" name="parameterId" value="<?php echo $vpa->parameterId ?>">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Paket</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <select id="role" name="role" class="form-control" onchange="populate(this.id,'lab')" required>
                                                <option value="">Pilih paket...</option>
                                                <?php foreach($viewPackages as $vp) : ?>
                                                    <option value="<?php echo $vp->packageId ?>"
                                                        <?php if($vp->packageId == $vpa->packageId): ?> selected <?php endif; ?>>
                                                        <?php echo $vp->packageName ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kode Parameter</label>
                                    <input type="hidden" name="idA" value="<?php echo "A$lastIdA" ?>">
                                    <input type="hidden" name="idB" value="<?php echo "B$lastIdB" ?>">
                                    <input type="hidden" name="idC" value="<?php echo "C$lastIdC" ?>">
                                    <input type="hidden" name="idD" value="<?php echo "D$lastIdD" ?>">
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <select id="lab" name="lab" class="form-control">
                                                <option value="<?php echo $vpa->parameterId ?>">
                                                    <?php echo $vpa->parameterId ?>
                                                </option>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Parameter</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="parameterName" value="<?php echo $vpa->parameterName ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Satuan</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="unit" value="<?php echo $vpa->unit ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nilai Rujukan</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="reference" value="<?php echo $vpa->reference ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Metode</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="method" value="<?php echo $vpa->method ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Biaya</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="parameterCost" value="<?php echo $vpa->parameterCost ?>" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div>
                                    <button class="btn btn-dark" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>

<script>

    function populate(role,lab)
    {
		var role = document.getElementById(role);
		var lab = document.getElementById(lab);
		lab.innerHTML = "";

		if(role.value == "A")
        {
			var optionArray = ["|<?php echo "A$lastIdA" ?>"];
		}
        else if(role.value == "B")
        {
			var optionArray = ["|<?php echo "B$lastIdB" ?>"];
		}
        else if(role.value == "C")
        {
			var optionArray = ["|<?php echo "C$lastIdC" ?>"];
        }
        else if(role.value == "D")
        {
			var optionArray = ["|<?php echo "D$lastIdD" ?>"];
		}
			
        for (var option in optionArray)
        {
			var pair = optionArray[option].split("|");
			var newOption = document.createElement("option");
			newOption.value = pair[0];
			newOption.innerHTML = pair[1];
			lab.options.add(newOption);
		}
	}

</script>