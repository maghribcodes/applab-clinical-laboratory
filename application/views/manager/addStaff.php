                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Data Staff</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <?php echo $this->session->flashdata('message') ?>
                    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">Tambah Data Staff</h6>
                        </div>
                        <form method="post" action="<?php echo base_url('manager/staff/addStaff') ?>">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="empName" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="username" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <input type="text" name="password" class="form-control" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <select id="role" name="role" class="form-control" onchange="populate(this.id,'lab')" required>
                                                <option value="">Pilih role...</option>
                                                <?php foreach($viewRoles as $vr) : ?>
                                                    <option value="<?php echo $vr->roleId ?>"><?php echo $vr->roleName ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Laboratorium</label>
                                        <div class="col-sm-4 mb-3 mb-sm-0">
                                            <select id="lab" name="lab" class="form-control">
                                            </select>
                                        </div>
                                </div>
                                <div>
                                    <button class="btn btn-dark" type="submit">Simpan</button>
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

		if(role.value == 1)
        {
			var optionArray = ["1|Tidak Ada"];
		}
        else if(role.value == 2)
        {
			var optionArray = ["1|Tidak Ada"];
		}
        else if(role.value == 3)
        {
			var optionArray = ["1|Tidak Ada"];
        }
        else if(role.value == 4)
        {
			var optionArray = ["1|Tidak Ada"];
		}
        else if(role.value == 5)
        {
			var optionArray = ["2|Hematologi","3|Kimia Klinik","4|Serologi","5|Mikrobiologi"];
		}
        else if(role.value == 6)
        {
			var optionArray = ["1|Tidak Ada"];
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