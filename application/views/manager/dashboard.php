                <!-- Begin Page Content -->
                <div class="container-fluid" style="height:245px; background-color: rgba(90, 92, 105, 1);">

                    <!-- Page Heading -->
                    <div>
                        <br>
                        <h2 class="m-0 font-weight text-light"><b>Dashboard</b></h2>
                        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
                    </div>

                    <br>

                    <div class="card mb-3 px-2">

                        <div class="card-body">

                            <div class="row no-gutters align-items-right">
                                <div class="col">
                                    <div class="text-xs font-weight-bold mb-1 text-dark"><h4><b>Selamat Datang!</b><h4></div>
                                    <div class="text-xs font-weight text-gray-800"><h6>Hello, 
                                        <span class="badge badge-dark"><?php echo $empName; ?>.</span>
                                         Anda login sebagai <span class="badge badge-dark"><?php echo $roleName; ?>.</span><h6></div>
                                </div>
                                <div class="col-auto">
                                    <div class="card border-left-dark h-100">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-dark mb-1">
                                                        Jumlah Staff</div>
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><?php echo $countEmp ?></div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>