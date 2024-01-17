<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->load->view('_templates/_header', '', true); ?>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
    select.form-control {
        text-align: center;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <?= $this->load->view('_templates/_navbar', '', true); ?>
    <div id="layoutSidenav">
        <?= $this->load->view('_templates/_sidebar', '', true); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Hitung <?= $title; ?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Tatacara pengisian nilai Matrik Perbandingan Berpasangan Kriteria / Alternatif</h5>
                        </div>
                        <div class="card-body">
                            <table class="table text-center table-bordered">
                                <thead>
                                    <tr>
                                        <?php
                                        echo ' <th>A/B</th>';
                                        foreach ($kriteria as $dkr) {
                                            echo ' <th>' . $dkr['nama'] . ' (B)</th>';
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    for ($a = 1; $a <= count($kriteria); $a++) {
                                        echo '<tr>';

                                        echo ' <th>' . $kriteria[($a - 1)]['nama'] . ' (A)</th>';
                                        for ($b = 1; $b <= count($kriteria); $b++) {
                                            if ($a == $b) {
                                                echo '<td style="background-color: grey;color:#fff;">A<sub>' . $a . '</sub> | B<sub>' . $b . '</sub></td>';
                                            } elseif ($a < $b) {
                                                echo '<td style="background-color: #33ccff;">A<sub>' . $a . '</sub> | B<sub>' . $b . '</sub></td>';
                                            } elseif ($a > $b) {
                                                echo '<td style="background-color: #00cc00;">A<sub>' . $a . '</sub> | B<sub>' . $b . '</sub></td>';
                                            }
                                        }
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>

                            </table>
                            <ul>
                                <li>Diketahui <b>A</b> ialah baris dan <b>B</b> ialah Kolom</li>
                                <li>Diketahui tabel dengan <b>Row Berwarna Abu-Abu</b> atau A.B bernilai sama, nilainya
                                    1
                                    (mutlak).</li>
                                <li>jika di tabel matrik pencarian manual pada <b>Row Tabel Berwarna Biru</b>, atau
                                    baris A dan Kolom B bernilai
                                    desimal atau tidak
                                    pecahan, Wajib hukumnya nilai perbandingan yang dipilih berlambang plus (+)</li>
                                <li>Begitu sebaliknya jika tabel matrik pencarian manual pada <b>Row Tabel Berwarna
                                        Hijau</b> atau baris A dan Kolom B bernilai desimal atau tidak
                                    pecahan , Wajib hukumnya nilai perbandingan yang dipilih berlambang minus (-)</li>
                            </ul>
                            <i style="font-weight: 600;">Ketentuan ini juga berlaku untuk pencarian pada matrik
                                perbandingan alternatif</i>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>Perhitungan Matrik Perbandingan Berpasangan</h5>
                        </div>
                        <div class="card-body">
                            <?php echo form_open('perhitungan/simpan_hitung_kriteria', 'class="form-horizontal"', ['uuid' => $uuid]); ?>
                            <table class="table text-center ">
                                <thead>
                                    <tr>
                                        <th scope="col">Kriteria</th>
                                        <th scope="col">Perbandingan</th>
                                        <th scope="col">Kriteria</th>
                                    </tr>
                                </thead>
                                <option value=""></option>
                                <tbody>
                                    <?php

                                    for ($x = 0; $x < count($kriteria); $x++) {
                                        for ($y = 0; $y < count($kriteria); $y++) {
                                            if ($x == $y) {
                                                echo '<input type="text" name="xy[]" value="' . $kriteria[$x]['id'] . '_' . $kriteria[$y]['id'] . '" hidden>';
                                            } elseif ($x < $y) {
                                                $matrik[$x][$y] = $kriteria[$x]['id'];
                                                echo '<tr>';
                                                echo '<td>' . $kriteria[$x]['nama'] . '</td>';
                                                echo '<td>';
                                                echo '<select name="' . $kriteria[$x]['id'] . '_' . $kriteria[$y]['id'] . '" class="form-control" required>';
                                                echo '<option value="">Pilih Perbandingan</option>';
                                                echo $this->builder->option('nilai_perbandingan', 'nilai', '', 'nama');
                                                echo '</select>';
                                                echo '</td>';
                                                echo '<input type="text" name="xy[]" value="' . $kriteria[$x]['id'] . '_' . $kriteria[$y]['id'] . '" hidden>';
                                                echo '<td>' .  $kriteria[$y]['nama'] . '</td>';
                                                echo '</tr>';
                                            } elseif ($x > $y) {
                                                echo '<input type="text" name="xy[]" value="' . $kriteria[$x]['id'] . '_' . $kriteria[$y]['id'] . '" hidden>';
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-block btn-primary mt-2">Proses Perhitungan
                                Kriteria</button>
                            <?php echo form_close() ?>
                        </div>
                    </div>
                </div>
            </main>
            <?= $this->load->view('_templates/_footer', '', true); ?>
        </div>
    </div>

    <div class="modal fade" id="myModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Tatacara pengisian nilai perbandingan hitung matrik kriteria dan alternatif</h4>
                    <?php
                    $dexKrit = [
                        'Kriteria A',
                        'Kriteria B',
                        'Kriteria C',
                    ];
                    ?>

                    <ul>
                        <li>Diketahui tabel dengan <b>Row Berwarna Abu-Abu</b> bernilai 1 (mutlak).</li>
                        <li>jika di tabel matrik pencarian manual pada <b>Row Tabel Berwarna Biru</b>, bernilai
                            desimal atau tidak
                            pecahan, Wajib hukumnya nilai perbandingan yang dipilih berlambang plus (+)</li>
                        <li>Begitu sebaliknya jika tabel matrik pencarian manual pada <b>Row Tabel Berwarna
                                Hijau</b> bernilai desimal atau tidak
                            pecahan , Wajib hukumnya nilai perbandingan yang dipilih berlambang minus (-)</li>
                    </ul>
                    <i style="font-weight: 600;">Ketentuan ini berlaku untuk pencarian pada matrik kriteria dan matrik
                        alternatif</i>
                    <?php
                    // for ($a = 0; $a < 3; $a++) {
                    //     for ($b = 0; $b < 3; $b++) {
                    //         # code...
                    //     }
                    // }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?= $this->load->view('_templates/_js', '', true); ?>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script>
    // $('#myModals').modal('show')
    </script>
</body>

</html>