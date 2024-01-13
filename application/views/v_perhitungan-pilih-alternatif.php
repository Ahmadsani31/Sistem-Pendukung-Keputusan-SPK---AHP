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
                    <?php echo form_open('perhitungan/simpan_hitung_alternatif', 'class="form-horizontal"', ['uuid' => $uuid]); ?>

                    <div class="card mb-4">
                        <?php
                        $no = 1;
                        foreach ($totalKriteria as $dataKrite) {
                            # code...
                        ?>
                        <div class="card-body">
                            <h3><?= $dataKrite['nama']; ?></h3>
                            <table class="table text-center ">
                                <thead>
                                    <tr>
                                        <th scope="col">Alternatif</th>
                                        <th scope="col">Perbandingan</th>
                                        <th scope="col">Alternatif</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                        for ($x = 1; $x <= count($alternatif); $x++) {
                                            for ($y = 1; $y <= count($alternatif); $y++) {
                                                if ($x == $y) {
                                                    echo '<input type="text" name="xy' . $no . '[]" value="' . $x . '_' . $y . '" hidden>';
                                                } elseif ($x < $y) {
                                                    $matrik[$x][$y] = $alternatif[$x]['id'];
                                                    echo '<tr>';
                                                    echo '<td>' . $alternatif[$x]['nama'] . '</td>';
                                                    echo '<td>';
                                                    echo '<select name="nilai' . $no . '_' . $x . '_' . $y . '" class="form-control" required>';
                                                    echo '<option value="">Pilih Perbandingan</option>';
                                                    echo $this->builder->option('nilai_perbandingan2', 'nilai', '', 'nama');
                                                    echo '</select>';
                                                    echo '</td>';
                                                    echo '<input type="text" name="xy' . $no . '[]" value="' .   $x . '_' . $y . '" hidden>';
                                                    echo '<td>' .  $alternatif[$y]['nama'] . '</td>';
                                                    echo '</tr>';
                                                } elseif ($x > $y) {
                                                    echo '<input type="text" name="xy' . $no . '[]" value="' .  $x . '_' . $y . '" hidden>';
                                                }
                                            }
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                            $no++;
                        }
                        ?>

                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Hitung</button>

                    <?php echo form_close() ?>

                </div>
            </main>
            <?= $this->load->view('_templates/_footer', '', true); ?>
        </div>
    </div>
    <?= $this->load->view('_templates/_js', '', true); ?>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>

</body>

</html>