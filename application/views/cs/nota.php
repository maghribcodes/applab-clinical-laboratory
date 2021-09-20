<?php //echo json_encode($viewNota); ?>
<div class="container-fluid">
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
                                <th style="text-align: center; vertical-align: middle;">NT<?php echo $vn->notaId ?></th>
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
                                    <div> - No. Sample</div>
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
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Split Buttons with Icon</h6>
                </div>
             <div class="card-body">
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-success btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Split Button Success</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-info btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Split Button Info</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-warning btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <span class="text">Split Button Warning</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-danger btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Split Button Danger</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-secondary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="text">Split Button Secondary</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-light btn-icon-split">
                                        <span class="icon text-gray-600">
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="text">Split Button Light</span>
                                    </a>
                                    <div class="mb-4"></div>
                                    <p>Also works with small and large button classes!</p>
                                    <a href="#" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Split Button Small</span>
                                    </a>
                                    <div class="my-2"></div>
                                    <a href="#" class="btn btn-primary btn-icon-split btn-lg">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-flag"></i>
                                        </span>
                                        <span class="text">Split Button Large</span>
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>
    </div>
</div>