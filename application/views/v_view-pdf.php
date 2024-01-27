<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/'); ?>favicon.png">
    <title><?= $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>
    <h2 class="text-center">Laporan Perangkingan SPK Metode AHP</h2>
    <p class="text-center">PENENTUAN KACANG KEDELAI UNTUK PEMBUATAN TAHU PABRIK TAHU PANJANG KAMPUNG KOTO KOTA
        PADANG</p>
    <?php
    if ($tampil == true) {
    ?>
    <table class="table table-bordered text-center mt-5">
        <thead>
            <tr>
                <?php
                    echo ' <th></th>';
                    foreach ($kriteria as $idKat => $nmKat) {
                        echo '<th>' . $nmKat . '</th>';
                    }
                    echo ' <th>SCORE</th>';
                    echo ' <th>RANGKING</th>';
                    ?>

            </tr>
        </thead>
        <tbody>

            <?php

                $no = 1;
                foreach ($alternatif as $idRnk => $dRnk) {
                    echo $idRnk;
                    echo '<tr>';
                    echo ' <td>' . $dRnk . '</td>';
                    foreach ($rangking->$idRnk as $nmRnk) {

                        echo '<td>' . $nmRnk . '</td>';
                    }
                    echo '<td>' . $score->$no . '</td>';
                    echo '<td>' . $nilai->$no . '</td>';
                    $no++;
                }
                ?>

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