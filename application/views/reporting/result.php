<div class="container-fluid" style="height:250px; background-color: rgba(28, 200, 138, 1);">
    <!-- Page Heading -->
	<div>
        <br>
        <h2 class="m-0 font-weight text-light"><b>Data Hasil Uji</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>

    <div class="row">

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php echo anchor('cs/order/printNota/'.$vn->orderId, 
                        '<div class="btn btn-danger col-lg-12">
                            <i class="fa fa-print"></i> Cetak Nota</div>')
                    ?>
                </div>
            </div>
        </div>
    </div>