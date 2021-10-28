<div class="container-fluid" style="height:245px; background-color: rgba(255,74,59,1);">
    <!-- Page Heading -->
	<div>
        <br>
        <h2 class="m-0 font-weight text-light"><b>Nota Order</b></h2>
        <h6 class="m-0 font-weight text-light">Pelayanan Pemeriksaan Laboratorium Klinik</h6>
    </div>

    <br>

    <?php 
        $samples=array();
        $parameters=array();
    
        foreach($viewNota as $vn)
        {
            $samples[] = $vn->noSample;
            $parameters[] = $vn->parameterId;
            $samp = array_unique($samples);
            $param = array_unique($parameters);
        }
    ?>

    <div class="row">

        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">PEMERINTAH PROVINSI<br>SUMATERA BARAT<br>UPTD LAB. KES PADANG</th>
                                <th style="text-align: center; vertical-align: middle;">SURAT KETETAPAN RETRIBUSI DAERAH (SKRD)<br>PELAYANAN KESEHATAN (YANKES)</th>
                                <th style="text-align: center; vertical-align: middle;">NT<?php echo $vn->orderId ?></th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: left; vertical-align: middle;">A. IDENTITAS WAJIB RETRIBUSI / PASIEN</th>
                                <th style="text-align: left; vertical-align: middle;">PENGIRIM: <?php echo $vn->sender ?></th>
                            </tr>
                        </thead>
                    </table>
                    <table class="ml-4">
                        <thead>
                            <tr>
                                <td width="200px">
                                    <div> - Nama</div>
                                    <div> - Jenis Kelamin</div>
                                    <div> - Umur / Tgl. Lahir</div>
                                    <div> - Alamat</div>
                                    <div> - No. Sampel</div>
                                </td>
                                <td>
                                    <div>: <?php echo $vn->custName ?></div>
                                    <div>: <?php echo $vn->gender ?></div>
                                    <div>: <?php 
                                                $birth = new DateTime($vn->birthDate);
                                                $now = new DateTime();
                                                $age = $now->diff($birth);
                                                echo $age->y;
                                            ?>
                                            th / 
                                            <?php 
                                                $date = new DateTime($vn->birthDate);
                                                $date = $date->format('d F Y');
                                                echo $date;
                                            ?>
                                    </div>
                                    <div>: <?php echo $vn->address ?></div>
                                    <div>: <?php echo implode(', ', $samp); ?></div>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <br>
                    <div style="text-align: left;"><b>B. NOTA PERHITUNGAN</b></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">No.</th>
                                <th style="text-align: center; vertical-align: middle;">Jenis Pemeriksaan</th>
                                <th style="text-align: center; vertical-align: middle;">Tarif (Rp.)</th>
                            </tr>
                            <?php $no=1;
                                foreach($viewCost as $vc) : 
                                    if(in_array($vc->parameterId, $param))
                                    { $cost[]=$vc->parameterCost; $total=array_sum($cost);?>
                                        <tr>
                                            <td width="20px" style="text-align: center; vertical-align: middle;"><?php echo $no++; ?></td>
                                            <td><?php echo $vc->parameterName ?></td>
                                            <td style="text-align: center; vertical-align: middle;"><?php echo number_format($vc->parameterCost, 2, ',', '.'); ?></td>
                                        </tr>
                                    <?php }
                                endforeach; 
                            ?>
                            <tr>
                                <th colspan="2" style="text-align: center; vertical-align: middle;">JUMLAH YANG DIBAYAR</th>
                                <td style="text-align: center; vertical-align: middle;">
                                    <?php
                                        echo number_format($total, 2,',', '.');
                                    ?>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <div style="text-align: right;">PADANG, 
                        <?php 
                            $date = new DateTime($vn->orderTime);
                            $date = $date->format('d F Y');
                            echo $date;
                        ?>
                    </div>
                    <div style="text-align: left;"><b>C. LEGALISASI PEMBAYARAN</b></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">Yang menerima<br>BENDAHARA KHUSUS PENERIMA<br><br><br><b><?php echo $vn->empName ?></td>
                                <td style="text-align: center; vertical-align: middle;">Yang membayar<br>WAJIB RETRIBUSI / KUASA<br><br><br><b><?php echo $vn->custName ?></td>
                            </tr>
                        </thead>
                    </table>
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
</div>