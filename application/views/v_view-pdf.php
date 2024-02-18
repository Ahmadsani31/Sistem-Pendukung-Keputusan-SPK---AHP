<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/'); ?>favicon.png">
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
    .page_break {
        page-break-before: always;
    }
    </style>
</head>

<body>
    <h2 class="text-center">Laporan Perangkingan SPK Metode AHP</h2>
    <p class="text-center">PENENTUAN KACANG KEDELAI UNTUK PEMBUATAN TAHU PABRIK TAHU PANJANG KAMPUNG KOTO KOTA
        PADANG</p>
    <br>
    <?php
    if ($tampil == true) {
    ?>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-table me-1"></i>
            Data Kriteria
        </div>
        <div class="card-body">
            <h5>Matrik Perbandingan Berpasangan Kriteria</h5>
            <hr>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <?php

                            echo ' <th>Kriteria</th>';
                            foreach ($kriteria as $dataKrtiteria) {

                                echo ' <td>' . $dataKrtiteria['nama'] . '</td>';
                            }
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($xk = 1; $xk <= count($kriteria); $xk++) {
                            echo '<tr>';
                            echo ' <td>' . $kriteria[$xk]['nama'] . '</td>';
                            for ($yk = 1; $yk <= count($kriteria); $yk++) {
                                echo '<td>' . $Hkrit[$xk][$yk] . '</td>';
                                $matKritA[$yk][$xk] = round($Hkrit[$xk][$yk], 4);
                            }
                            echo '</tr>';
                        }
                        ?>
                </tbody>
                <tfoot style="background-color: grey;color: white;">
                    <td><b>Hasil</b></td>
                    <?php
                        foreach ($matKritA as $nyk => $nxk) {
                            $HMatKritA[$nyk] = array_sum($nxk);
                            echo '<td>' . array_sum($nxk) . '</td>';
                        }

                        ?>
                </tfoot>
            </table>

        </div>
        <div class="page_break"></div>
        <div class="m-2">
            <h5>Hasil Matrik Normalisasi Kriteria</h5>
            <br>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <?php
                            echo ' <th></th>';
                            foreach ($kriteria as $dataKrtiteria) {
                                echo ' <th>' . $dataKrtiteria['nama'] . '</th>';
                            }
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        for ($xxk = 1; $xxk <= count($kriteria); $xxk++) {
                            echo '<tr>';
                            echo ' <td>' . @$kriteria[$xxk]['nama'] . '</td>';
                            for ($yyk = 1; $yyk <= count($kriteria); $yyk++) {

                                echo '<td>' . @$matKritA[@$yyk][$xxk] . '/' . @$HMatKritA[$yyk] . '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                </tbody>
            </table>
        </div>
        <div class="page_break"></div>
        <div class="m-2">
            <h5>Nilai Perbandingan Kriteria</h5>
            <br>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <?php
                            echo ' <th></th>';
                            foreach ($kriteria as $dataKrtiteria) {
                                echo ' <th>' . $dataKrtiteria['nama'] . '</th>';
                            }
                            echo ' <th style="background-color: grey;color: white;">JUMLAH (V)</th>';
                            echo ' <th style="background-color: grey;color: white;">PRIORITAS</th>';
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $TVektorKrit = 0;
                        $TBobotKrit = 0;
                        for ($xk1 = 1; $xk1 <= count($kriteria); $xk1++) {
                            echo '<tr>';
                            echo ' <td>' . @$kriteria[$xk1]['nama'] . '</td>';
                            for ($yk1 = 1; $yk1 <= count($kriteria); $yk1++) {

                                echo '<td>' . round($matKritA[$yk1][$xk1] / $HMatKritA[$yk1], 4) . '</td>';
                                $HMatKritB[$xk1][$yk1] = round(@$matKritA[@$yk1][$xk1] / @$HMatKritA[$yk1], 4);
                                $matKritBHasil[$yk1][$xk1] = round(@$matKritA[@$yk1][$xk1], 4) / round(@$HMatKritA[$yk1], 4);
                            }
                            $TVektorKrit += array_sum($HMatKritB[$xk1]);
                            $TBobotKrit += round(array_sum($HMatKritB[$xk1]) / count($kriteria), 4);
                            echo '<td style="background-color: grey;color: white;">' . array_sum($HMatKritB[$xk1]) . '</td>';
                            echo '<td style="background-color: grey;color: white;">' . round(array_sum($HMatKritB[$xk1]) / count($kriteria), 4) . '</td>';

                            $NilaiBobotKrit[$kriteria[$xk1]['id']] = round(array_sum($HMatKritB[$xk1]) / count($kriteria), 4);
                            $NBKrit[$xk1] = number_format(array_sum($HMatKritB[$xk1]) / count($kriteria), 4);

                            echo '</tr>';
                        }

                        ?>
                </tbody>
                <tfoot style="background-color: grey;color: white;">
                    <td><b>Total</b></td>
                    <?php
                        foreach ($matKritBHasil as $nyk1 => $nxk1) {
                            echo '<td>' . round(array_sum($nxk1)) . '</td>';
                        }
                        echo '<td>' . round($TVektorKrit) . '</td>';
                        echo '<td>' . round($TBobotKrit) . '</td>';
                        ?>
                </tfoot>
            </table>
        </div>
        <div class="page_break"></div>
        <div class="m-2">
            <h5>Nilai Bobot Kriteria</h5>
            <br>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th>Presentase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 0;
                        $nilai_persen = 0;
                        foreach ($kriteria as  $dataKrtiteria) {

                            // $insertBobot[] = [
                            //     'kriteriaid' => $dataKrtiteria['id'],
                            //     'bobot' => $NilaiBobotKrit[$dataKrtiteria['id']],
                            // ];

                            $nilai_persen += $NilaiBobotKrit[$dataKrtiteria['id']] * 100;
                            echo '<tr>';
                            echo ' <td>' . $dataKrtiteria['nama'] . '</td>';
                            echo ' <td>' . @$NilaiBobotKrit[$dataKrtiteria['id']] . '</td>';
                            echo ' <td>' . @$NilaiBobotKrit[$i] * 100 . ' %</td>';
                            echo '</tr>';
                            $i++;
                        }

                        ?>
                </tbody>
                <tfoot style="background-color: grey;color: white;">
                    <td></td>
                    <td><b>Hasil</b></td>
                    <td><?= $nilai_persen; ?></td>
                </tfoot>
            </table>
        </div>
        <div class="page_break"></div>
        <div class="m-2">
            <h5>Penentuan Consistency Metric</h5>
            <br>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <?php
                            foreach ($kriteria as $dataKrtiteria) {
                                echo ' <th>' . $dataKrtiteria['nama'] . '</th>';
                            }
                            echo ' <th>Rata-Rata</th>';
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        for ($xk2 = 1; $xk2 <= count($kriteria); $xk2++) {
                            echo '<tr>';
                            echo ' <td>' . @$kriteria[$xk2]['nama'] . '</td>';
                            for ($yk2 = 1; $yk2 <= count($kriteria); $yk2++) {
                                echo '<td>' . number_format($matKritA[$yk2][$xk2] * $NBKrit[$yk2], 4) . '</td>';
                                $HBKrit[$xk2][$yk2] = number_format($matKritA[$yk2][$xk2] * $NBKrit[$yk2], 4);
                            }
                            echo '<td style="background-color: grey;color: white;">' . number_format(array_sum($HBKrit[$xk2]) / $NBKrit[$xk2], 4) . '</td>';
                            $TEigenKrit[$xk2] = (array_sum($HBKrit[$xk2]) / $NBKrit[$xk2]);
                        }
                        ?>
                </tbody>
                <tfoot style="background-color: grey;color: white;">
                    <td></td>
                    <td colspan="4"><b>LambdaMax</b></td>
                    <td><?= number_format(array_sum($TEigenKrit) / count($TEigenKrit), 4); ?></td>
                </tfoot>
            </table>
        </div>
        <?php

            $ci1 = number_format(array_sum($TEigenKrit) / count($TEigenKrit), 4) - count($kriteria);
            $ci2 = count($kriteria) - 1;

            $nilai_ci = $ci1 /   $ci2;

            $nilai_cr = $nilai_ci / $nilai_ri;

            $hasil_cr =  $nilai_cr <= 0.1 ? "KONSISTEN" : "TIDAK KONSISTEN";
            ?>
        <div class="m-2">
            <table class="table">
                <thead>
                    <?php
                        echo '<tr>';
                        echo ' <th>CI</th>';
                        echo ' <th>' .  round($nilai_ci, 4) . '</th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo ' <th>RI</th>';
                        echo ' <th>' . $nilai_ri . '</th>';
                        echo '</tr>';
                        echo '<tr>';
                        echo ' <th>CR</th>';
                        echo ' <th>' . round($nilai_cr, 4) . ' (' . $hasil_cr . ')</th>';
                        echo '</tr>';
                        ?>
                </thead>
            </table>
        </div>
    </div>

    <br>

    <div class="m-2">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-table me-1"></i>
            Data Alternatif
        </div>
        <?php
            $noAlter = 1;
            foreach ($kriteria as $dKr) {
            ?>

        <div class="m-2">
            <h5><?= $noAlter++; ?>.) Perhitungan Alternatif <b><?= $dKr['nama']; ?></b></h5>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <?php
                                echo '<th>' . $dKr['nama'] . '</th>';
                                foreach ($alternatif as $dtAlter) {
                                    echo ' <th>' . $dtAlter['nama'] . '</th>';
                                }
                                // echo ' <th>P.Vektor</th>';
                                // echo ' <th>Bobot</th>';
                                ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            for ($x = 1; $x <= count($HAlter[$dKr['id']]); $x++) {
                                echo '<tr>';
                                echo ' <td>' . $alternatif[$x]['nama'] . '</td>';
                                for ($y = 1; $y <= count($HAlter[$dKr['id']]); $y++) {
                                    echo '<td>' . $HAlter[$dKr['id']][$x][$y] . '</td>';
                                    $matrikA[$dKr['id']][$y][$x] = round($HAlter[$dKr['id']][$x][$y], 4);
                                }
                                // echo '<td>' . round(array_sum($matrikA[$dKr['id']][$x]), 4) . '</td>';
                                // echo '<td>' . round(array_sum($matrikA[$dKr['id']][$x]) / count($HAlter[$dKr['id']]), 4) . '</td>';
                                // $nBobobt[$dKr['id']][] = round(array_sum($matrikA[$dKr['id']][$x]) / count($HAlter[$dKr['id']]), 4);
                                echo '</tr>';
                            }
                            ?>
                </tbody>
                <tfoot style="background-color: grey;color: white;">
                    <td><b>Total</b></td>
                    <?php
                            foreach ($matrikA[$dKr['id']] as $ny => $nx) {
                                $HMatrikA[$dKr['id']][] = array_sum($nx);
                                echo '<td>' . array_sum($nx) . '</td>';
                            }

                            ?>
                </tfoot>
            </table>

        </div>

        <div class="m-2">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <?php
                                echo '<th>' . $dKr['nama'] . '</th>';
                                foreach ($alternatif as $dtAlter) {
                                    echo ' <th>' . $dtAlter['nama'] . '</th>';
                                }
                                echo ' <th>P.Vektor</th>';
                                echo ' <th>Bobot</th>';
                                ?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                            for ($x1 = 1; $x1 <= count($HAlter[$dKr['id']]); $x1++) {
                                echo '<tr>';
                                echo ' <td>' . $alternatif[$x1]['nama'] . '</td>';
                                for ($y1 = 1; $y1 <= count($HAlter[$dKr['id']]); $y1++) {
                                    echo '<td>' . round(@$matrikA[$dKr['id']][@$y1][$x1] / @$HMatrikA[$dKr['id']][($y1 - 1)], 4) . '</td>';
                                    $HMatrikB[$dKr['id']][$x1][$y1] = round(@$matrikA[$dKr['id']][@$y1][$x1] / @$HMatrikA[$dKr['id']][($y1 - 1)], 4);
                                }

                                $TVektor[$dKr['id']][] = array_sum($HMatrikB[$dKr['id']][$x1]);
                                $TBobot[$dKr['id']][$x1] = round(array_sum($HMatrikB[$dKr['id']][$x1]) / count($HAlter[$dKr['id']]), 4);

                                echo '<td style="background-color: grey;color: white;">' . round(array_sum($HMatrikB[$dKr['id']][$x1]), 4) . '</td>';
                                echo '<td style="background-color: grey;color: white;">' . round(array_sum($HMatrikB[$dKr['id']][$x1]) / count($HAlter[$dKr['id']]), 4) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                </tbody>

            </table>

        </div>
        <div class="page_break"></div>
        <?php
            }
            ?>
        <div class="m-2">
            <h5>Hasil Perhitungan Matrik Alternatif</h5>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <?php
                            echo ' <th></th>';
                            foreach ($kriteria as $dKr) {
                                echo ' <th>' . $dKr['nama'] . '</th>';
                            }
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        foreach ($alternatif as $hx => $value) {
                            echo '<tr>';
                            echo ' <td>' . $value['nama'] . '</td>';
                            foreach ($HAlter as $hy => $vaHy) {
                                echo '<td>' . $TBobot[$hy][$hx] . '</td>';
                                $HMalternatif[$hy][$hx] = $TBobot[$hy][$hx];
                            }
                            echo '</tr>';
                        }

                        ?>
                </tbody>

            </table>

        </div>
    </div>
    <div class="page_break"></div>
    <div class="m-2">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-table me-1"></i>
            Nilai Akhir Perhitungan AHP
        </div>
        <div class="m-2">
            <h3>Bobot Kriteria</h3>
            <table class="table text-center">
                <thead>
                    <tr>
                        <?php
                            foreach ($kriteria as $dKr) {
                                echo ' <th style="background-color: grey;color: white;">' . $dKr['nama'] . '</th>';
                            }
                            ?>
                    </tr>
                    <tr>
                        <?php
                            foreach ($NilaiBobotKrit as $id_ket => $KrBt) {
                                echo ' <th style="background-color: grey;color: white;">' . $KrBt . '</th>';
                                $HBKreteria[$id_ket] =  $KrBt;
                            }

                            ?>
                    </tr>
                </thead>
            </table>

        </div>
        <div class="m-2">
            <table class="table">
                <thead>
                    <tr>
                        <?php

                            echo ' <th></th>';
                            foreach ($kriteria as $dKr) {
                                echo ' <th>' . $dKr['nama'] . '</th>';
                            }
                            echo ' <th>SCORE</th>';
                            echo ' <th>RANGKING</th>';
                            ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($alternatif as $hmxr => $value) {
                            foreach ($HAlter as $hmyr => $vaHmyr) {
                                $Score[$hmxr][$hmyr] = number_format(round($HMalternatif[$hmyr][$hmxr], 4) * round($HBKreteria[$hmyr], 4), 4);
                            }
                            $rangking[$hmxr] = round(array_sum($Score[$hmxr]), 4);
                        }

                        $rank = calculate_rank($rangking);

                        foreach ($alternatif as $hmx => $value) {
                            echo '<tr>';
                            echo ' <td>' . $value['nama'] . '</td>';
                            foreach ($HAlter as $hmy => $vaHmy) {
                                echo '<td>' . number_format(round($HMalternatif[$hmy][$hmx], 4) * round($HBKreteria[$hmy], 4), 4) . '</td>';
                            }
                            echo '<td style="background-color: grey;color: white;">' . round(array_sum($Score[$hmx]), 4) . '</td>';

                            echo '<td style="background-color: grey;color: white;">' . $rank[$hmx] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                </tbody>
            </table>

        </div>
    </div>
    <br>
    <br>
    <table class="table-sm text-center mt-5" style="width: 100%;">
        <thead>
            <tr>
                <th width="33%"></th>
                <th width="33%"></th>
                <th width="33%" class="text-left">Padang ___ <?= date_create(date('Y-m-d'))->format('F Y'); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <th class="text-left">Pimpinan</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td class="text-left" style="padding-top: 50px;"><?= ucwords($pimpinan); ?></td>
            </tr>
        </tbody>
    </table>
    <?php
    } else {
    ?>
    <div class="alert alert-warning text-center mt-5" role="alert">
        Tidak ada laporan, Silahkan lakukan perhitungan ulang SPK metode AHP
    </div>
    <?php
    }
    ?>
</body>

</html>