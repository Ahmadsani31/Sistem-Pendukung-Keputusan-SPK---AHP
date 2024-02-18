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
                    <h1 class="mt-4">Nama Laporan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Nama laporan</li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-body">
                            <?php echo form_open('perhitungan/laporan_print_pdf', 'class="form-horizontal"', ['uuid' => $uuid]); ?>
                            <div class="form-group">
                                <label>Nama Pimpinan</label>
                                <input type="text" name="pimpinan" class="form-control" placeholder="Tulis Nama">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Print PDF</button>
                            <?php echo form_close() ?>
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