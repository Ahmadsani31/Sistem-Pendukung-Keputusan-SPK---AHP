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
                    <h1 class="mt-4">Kelola <?= $title; ?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-body">
                            <?php echo form_open('alternatif/simpan', 'class="form-horizontal"', ['id' => $id]); ?>
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" name="code" class="form-control" value="<?= $code; ?>" placeholder="Tulis Kode">
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="<?= $nama; ?>" placeholder="Tulis Alternatif">
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Simpan</button>
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