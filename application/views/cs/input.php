<div class="container-fluid">

<form method="post" action="<?php echo base_url('cs/order/inputOrder') ?>">

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">DATA PASIEN</h6>
        </div>

        <div class="card-body">

            <!--<form>-->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Sampel</label>
                        <div class="col-sm-10">
                            <input type="text" name="noSample" class="form-control" value="<?php echo set_value('noSample'); ?>">
                            <?php echo form_error('noSample', '<div class="text-danger small">','</div>') ?>
                        </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pasien</label>
                        <div class="col-sm-10">
                            <input type="text" name="custName" class="form-control" value="<?php echo set_value('custName'); ?>">
                            <?php echo form_error('custName', '<div class="text-danger small">','</div>') ?>
                        </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" name="birthDate" class="form-control" id="inputEmail3" value="<?php echo set_value('birthDate'); ?>">
                            <?php echo form_error('birthDate', '<div class="text-danger small">','</div>') ?>
                        </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-10">
                            <input type="name" name="contact" class="form-control" id="inputEmail3" value="<?php echo set_value('contact'); ?>">
                            <?php echo form_error('contact', '<div class="text-danger small">','</div>') ?>
                        </div>
                </div>

                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="Laki-laki" <?php echo set_radio('gender','Laki-laki'); ?>>
                                        <label class="form-check-label" for="gridRadios1">
                                            Laki-laki
                                        </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="Perempuan" <?php echo set_radio('gender','Perempuan'); ?>>
                                        <label class="form-check-label" for="gridRadios2">
                                            Perempuan
                                        </label>
                                </div>
                                <?php echo form_error('gender', '<div class="text-danger small">','</div>') ?>
                            </div>
                    </div>
                </fieldset>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="name" name="address" class="form-control" id="inputEmail3" value="<?php echo set_value('address'); ?>">
                            <?php echo form_error('address', '<div class="text-danger small">','</div>') ?>
                        </div>
                </div>

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pengirim</label>
                        <div class="col-sm-10">
                            <input type="name" name="sender" class="form-control" id="inputEmail3">
                        </div>
                </div>

            <!--</form>-->

        </div>

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">LAB UJI TERKAIT</h6>
        </div>

        <div class="card-body">

            <div class="container-fluid">
            <!-- Content Row -->
                <div class="row">

                    <!-- First Column -->
                    <div class="col-lg-4">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Hematologi</h6>
                            </div>
                            
                            <div class="card-body">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A1" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            1. Darah Rutin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A2" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            2. Darah Lengkap
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A3" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            3. Haemoglobin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A4" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            4. Leukosit
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A5" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            5. Laju Endap Darah
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A6" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            6. Hitung Jenis Leukosit
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A7" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            7. Eritrosit
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A8" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            8. Trombosit
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A9" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            9. Hematrokit
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A10" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            10. Retikulosit
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A11" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            11. MCV
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A12" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            12. MCH
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A13" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            13. MCHC
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A14" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            14. Waktu Pembekuan
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A15" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            15. Waktu Perdarahan
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A16" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            16. Rumpel Leed
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A17" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            17. Retraksi Bekuan
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A18" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            18. PTT
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A19" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            19. APTT
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A20" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            20. Sel LE
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A21" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            21. Golongan Darah
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A22" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            22. Rhesus
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A23" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            23. Gambaran Darah Tepi
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="A24" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            24. Analisa Sperma
                                        </label>
                                </div>

                            </div>

                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Mikrobiologi</h6>
                            </div>
                            
                            <div class="card-body">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D1" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            1. Kultur dan Sensitivity
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D2" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            2. Pewarnaan Gram
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D3" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            3. Pewarnaan Difteri
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D4" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            4. Pewarna BTA / MH
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D5" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            5. Kultur Jamur
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D6" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            6. Kultur BTA
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D7" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            7. MPN Coli form
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D8" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            8. MPN Coli tinja
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D9" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            9. Pemeriksaan Makanan / Minuman
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D10" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            10. Pemeriksaan Usap Alat
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D11" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            11. Trichomonas
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D12" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            12. Candida
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D13" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            13. Filaria
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D14" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            14. Malaria
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D15" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            15. Telur Cacing
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D16" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            16. Amuba
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D17" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            17. Faeces Rutin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D18" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            18. Darah Samar
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="D19" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            19. Swab Vagina
                                        </label>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Second Column -->
                    <div class="col-lg-4">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Kimia Klinik</h6>
                            </div>
                            
                            <div class="card-body">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B1" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            1. Gula Darah
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B2" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                             2. Reduksi
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B3" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            3. Cholesterol Lengkap
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B4" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            4. Total Cholesterol
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B5" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            5. Trigliserida
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B6" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            6. HDL
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B7" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            7. LDL
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B8" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            8. SGOT
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B9" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            9. SGPT
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B10" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            10. Billirubin I & II
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B11" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            11. Ureum
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B12" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            12. Kreatinin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B13" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            13. Asam Urat
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B14" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            14. Total Prot / Alb / Globulin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B15" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            15. Alkali Phosphatase
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B16" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            16. Kalsium
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B17" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            17. Natrium
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B18" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            18. Kalium
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B19" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            19. Klorida
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B20" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            20. Gamma GT
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B21" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            21. LDH
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B22" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            22. CK-Nac
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B23" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            23. CK-MB
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B24" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            24. Analisa Batu Ginjal
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B25" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            25. pH
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B26" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            26. Protein
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B27" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            27. Billirubin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B28" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            28. Urobilin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B29" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            29. Benzidin
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B30" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            30. Keton
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B31" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            31. Nitrit
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B32" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            32. Berat Jenis
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="B33" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            33. Sediment
                                        </label>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- Third Column -->
                    <div class="col-lg-4">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-danger">Serologi</h6>
                            </div>
                            
                            <div class="card-body">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C1" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            1. Rf
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C2" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            2. ASTO
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C3" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            3. CRP
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C4" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            4. VDRL
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C5" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            5. TPHA
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C6" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            6. Widal (T.O & T.H)
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C7" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            7. HBsAg
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C8" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            8. Anti HBs
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C9" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            9. Anti HBc
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C10" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            10. HbeAg
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C11" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            11. Anti Hbe
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C12" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            12. IgM HAV
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C13" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            13. IgM Anti HAV
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C14" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            14. Anti HCV
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C15" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            15. Dengue IgG & IgM
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C16" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            16. Ca 125
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C17" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            17. Ca 15-3
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C18" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            18. Ca 19-9
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C19" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            19. CEA
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C20" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            20. AFP
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C21" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            21. PSA
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C22" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            22. T3
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C23" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            23. T4
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C24" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            24. TSH
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C25" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            25. FT3
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C26" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            26. FT4
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C27" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            27. Toxoplasma IgM
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C28" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            28. Toxoplasma IgG
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C29" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            29. Rubella IgM
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C30" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            30. Rubella IgG
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C31" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            31. CMV IgM
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C32" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            32. CMV IgG
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C33" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            33. Anti HSV IgM
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C34" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            34. Anti HSV IgG
                                        </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="parameter[]" value="C35" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            35. Anti HIV
                                        </label>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="card-body">
            <button type="submit" class="btn btn-danger btn-lg btn-block">SIMPAN</button>
            <!--<button type="submit" class="btn btn-secondary btn-lg btn-block">BATAL</button>-->
        </div>

    </div>

</form>

</div>