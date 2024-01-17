<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->load->view('_templates/_header', '', true); ?>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>

<body class="sb-nav-fixed">
    <?= $this->load->view('_templates/_navbar', '', true); ?>
    <div id="layoutSidenav">
        <?= $this->load->view('_templates/_sidebar', '', true); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4"><?= $title; ?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i>
                            Data Kriteria
                        </div>
                        <div class="card-body">
                            <h5>Matrik Perbandingan Berpasangan Kriteria</h5>
                            <hr>
                            <table class="table table-striped text-center">
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
                                            $matKritA[$yk][$xk] = number_format($Hkrit[$xk][$yk], 4);
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
                        <div class="card-body">
                            <h5>Hasil Matrik Normalisasi Kriteria</h5>
                            <hr>
                            <table class="table table-striped text-center">
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
                                        echo ' <td>' . $kriteria[$xxk]['nama'] . '</td>';
                                        for ($yyk = 1; $yyk <= count($kriteria); $yyk++) {

                                            echo '<td>' . $matKritA[$yyk][$xxk] . '/' . $HMatKritA[$yyk] . '</td>';
                                        }
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-body">
                            <h5>Nilai Perbandingan Kriteria</h5>
                            <hr>
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <?php
                                        echo ' <th></th>';
                                        foreach ($kriteria as $dataKrtiteria) {
                                            echo ' <th>' . $dataKrtiteria['nama'] . '</th>';
                                        }
                                        echo ' <th style="background-color: grey;color: white;">JUMLAH (V)</th>';
                                        echo ' <th style="background-color: grey;color: white;">PRIORITAS/BOBOT</th>';
                                        // echo ' <th style="background-color: grey;color: white;">EIGEN VALUE</th>';
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $TVektorKrit = 0;
                                    $TBobotKrit = 0;
                                    // $TEigenKrit = 0;
                                    for ($xk1 = 1; $xk1 <= count($kriteria); $xk1++) {
                                        echo '<tr>';
                                        echo ' <td>' . @$kriteria[$xk1]['nama'] . '</td>';
                                        for ($yk1 = 1; $yk1 <= count($kriteria); $yk1++) {

                                            echo '<td>' . number_format($matKritA[$yk1][$xk1] / $HMatKritA[$yk1], 4) . '</td>';
                                            $HMatKritB[$xk1][$yk1] = number_format(@$matKritA[@$yk1][$xk1] / @$HMatKritA[$yk1], 4);
                                            $matKritBHasil[$yk1][$xk1] = number_format(@$matKritA[@$yk1][$xk1], 4) / number_format(@$HMatKritA[$yk1], 4);
                                        }
                                        $TVektorKrit += array_sum($HMatKritB[$xk1]);
                                        $TBobotKrit += number_format(array_sum($HMatKritB[$xk1]) / count($kriteria), 4);
                                        // $TEigenKrit += (number_format(array_sum($HMatKritB[$xk1]) / count($kriteria), 4) * $HMatKritA[$xk1]);
                                        echo '<td style="background-color: grey;color: white;">' . array_sum($HMatKritB[$xk1]) . '</td>';
                                        echo '<td style="background-color: grey;color: white;">' . number_format(array_sum($HMatKritB[$xk1]) / count($kriteria), 4) . '</td>';
                                        // echo '<td style="background-color: grey;color: white;">' . number_format(number_format(array_sum($HMatKritB[$xk1]), 4) / count($kriteria) * number_format($HMatKritA[$xk1], 4), 4) . '</td>';

                                        $NilaiBobotKrit[$kriteria[$xk1]['id']] = number_format(array_sum($HMatKritB[$xk1]) / count($kriteria), 4);
                                        $NBKrit[$xk1] = number_format(array_sum($HMatKritB[$xk1]) / count($kriteria), 4);

                                        echo '</tr>';
                                    }

                                    ?>
                                </tbody>
                                <tfoot style="background-color: grey;color: white;">
                                    <td><b>Total</b></td>
                                    <?php
                                    foreach ($matKritBHasil as $nyk1 => $nxk1) {
                                        echo '<td>' . number_format(array_sum($nxk1)) . '</td>';
                                    }
                                    echo '<td>' . number_format($TVektorKrit) . '</td>';
                                    echo '<td>' . number_format($TBobotKrit) . '</td>';
                                    // echo '<td>' . number_format($TEigenKrit, 4) . '</td>';
                                    ?>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body">
                            <h5>Nilai Bobot Kriteria</h5>
                            <hr>
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Presentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $this->db->empty_table('nilai_kriteria');
                                    $i = 0;
                                    $nilai_persen = 0;
                                    foreach ($kriteria as  $dataKrtiteria) {

                                        $insertBobot[] = [
                                            'kriteriaid' => $dataKrtiteria['id'],
                                            'bobot' => $NilaiBobotKrit[$dataKrtiteria['id']],
                                        ];

                                        $nilai_persen += $NilaiBobotKrit[$dataKrtiteria['id']] * 100;
                                        echo '<tr>';
                                        echo ' <td>' . $dataKrtiteria['nama'] . '</td>';
                                        echo ' <td>' . @$NilaiBobotKrit[$dataKrtiteria['id']] . '</td>';
                                        echo ' <td>' . @$NilaiBobotKrit[$dataKrtiteria['id']] * 100 . ' %</td>';
                                        echo '</tr>';
                                        $i++;
                                    }

                                    $this->db->insert_batch('nilai_kriteria', $insertBobot);
                                    ?>
                                </tbody>
                                <tfoot style="background-color: grey;color: white;">
                                    <td></td>
                                    <td><b>Hasil</b></td>
                                    <td><?= $nilai_persen; ?></td>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-body">
                            <h5>Penentuan Consistency Metric</h5>
                            <hr>
                            <table class="table text-center">
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
                        <div class="card-body">
                            <table class="table ">
                                <thead>
                                    <?php
                                    echo '<tr>';
                                    echo ' <th>CI</th>';
                                    echo ' <th>' .  number_format($nilai_ci, 4) . '</th>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo ' <th>RI</th>';
                                    echo ' <th>' . $nilai_ri . '</th>';
                                    echo '</tr>';
                                    echo '<tr>';
                                    echo ' <th>CR</th>';
                                    echo ' <th>' . number_format($nilai_cr, 4) . ' (' . $hasil_cr . ')</th>';
                                    echo '</tr>';
                                    ?>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i>
                            Data Alternatif
                        </div>
                        <?php
                        $noAlter = 1;
                        foreach ($kriteria as $dKr) {
                        ?>
                        <div class="card-body">
                            <h5><?= $noAlter++; ?>.) Perhitungan Alternatif <b><?= $dKr['nama']; ?></b></h5>
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <?php
                                            echo ' <th>' . $dKr['nama'] . '</th>';
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
                                                $matrikA[$dKr['id']][$y][$x] = number_format($HAlter[$dKr['id']][$x][$y], 4);
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

                        <div class="card-body">
                            <!-- <h5>Hasil Normalisasi Kriteria <b><?= $dKr['nama']; ?></b></h5> -->
                            <table class="table table-striped text-center">
                                <thead>
                                    <tr>
                                        <?php
                                            echo ' <th style="background-color: grey;color: white;">' . $dKr['nama'] . '</th>';
                                            foreach ($alternatif as $dtAlter) {
                                                echo ' <th>' . $dtAlter['nama'] . '</th>';
                                            }
                                            // echo ' <th>P.Vektor</th>';
                                            echo ' <th>Bobot Prioritas</th>';
                                            ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                        for ($x1 = 1; $x1 <= count($HAlter[$dKr['id']]); $x1++) {
                                            echo '<tr>';
                                            echo ' <td>' . $alternatif[$x1]['nama'] . '</td>';
                                            for ($y1 = 1; $y1 <= count($HAlter[$dKr['id']]); $y1++) {
                                                echo '<td>' . number_format(@$matrikA[$dKr['id']][@$y1][$x1] / @$HMatrikA[$dKr['id']][($y1 - 1)], 4) . '</td>';
                                                $HMatrikB[$dKr['id']][$x1][$y1] = number_format(@$matrikA[$dKr['id']][@$y1][$x1] / @$HMatrikA[$dKr['id']][($y1 - 1)], 4);
                                            }

                                            // $TVektor[$dKr['id']][] = array_sum($HMatrikB[$dKr['id']][$x1]);
                                            $TBobot[$dKr['id']][$x1] = number_format(array_sum($HMatrikB[$dKr['id']][$x1]) / count($HAlter[$dKr['id']]), 4);

                                            // echo '<td style="background-color: grey;color: white;">' . number_format(array_sum($HMatrikB[$dKr['id']][$x1]), 4) . '</td>';
                                            echo '<td style="background-color: grey;color: white;">' . number_format(array_sum($HMatrikB[$dKr['id']][$x1]) / count($HAlter[$dKr['id']]), 4) . '</td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                </tbody>

                            </table>

                        </div>
                        <?php
                        }

                        ?>
                        <hr>
                        <div class="card-body">
                            <h5>Hasil Perhitungan Matrik Alternatif</h5>
                            <table class="table text-center">
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

                                        foreach ($HAlter as $id_krit => $va_krit) {
                                            echo '<td>' . $TBobot[$id_krit][$hx] . '</td>';
                                            $HMalternatif[$id_krit][$hx] = $TBobot[$id_krit][$hx];
                                        }

                                        echo '</tr>';
                                    }

                                    ?>
                                </tbody>

                            </table>

                        </div>


                    </div>
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <i class="fas fa-table me-1"></i>
                            Nilai Akhir Perhitungan AHP
                        </div>
                        <div class="card-body">
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
                                        $sqlKrBt =  $this->builder->select_('', 'nilai_kriteria', '', 'id');

                                        foreach ($sqlKrBt->result_array() as $KrBt) {
                                            echo ' <th style="background-color: grey;color: white;">' . $KrBt['bobot'] . '</th>';
                                            $HBKreteria[$KrBt['kriteriaid']] =  $KrBt['bobot'];
                                        }
                                        ?>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                        <div class="card-body">
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
                                        foreach ($HAlter as $hmyr => $va_krit) {
                                            $Score[$hmxr][$hmyr] = number_format(number_format($HMalternatif[$hmyr][$hmxr], 4) * number_format($HBKreteria[$hmyr], 4), 4);
                                        }
                                        $rangking[$hmxr] = number_format(array_sum($Score[$hmxr]), 4);
                                    }

                                    $rank = calculate_rank($rangking);

                                    foreach ($alternatif as $hmx => $value) {
                                        echo '<tr>';
                                        echo ' <td>' . $value['nama'] . '</td>';
                                        foreach ($HAlter as $hmy => $va_krit) {
                                            echo '<td>' . number_format(number_format($HMalternatif[$hmy][$hmx], 4) * number_format($HBKreteria[$hmy], 4), 4) . '</td>';
                                        }
                                        echo '<td style="background-color: grey;color: white;">' . number_format(array_sum($Score[$hmx]), 4) . '</td>';

                                        echo '<td style="background-color: grey;color: white;">' . $rank[$hmx] . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </main>
            <?= $this->load->view('_templates/_footer', '', true); ?>
        </div>
    </div>
    <?= $this->load->view('_templates/_js', '', true); ?>

</body>

</html>