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
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                DataTable <?= $title; ?>
                            </div>

                            <a href="<?= base_url('kriteria/kelola/0'); ?>" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i> Tambah</a>
                        </div>
                        <div class="card-body">
                            <table id="DTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

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
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.js"></script>
    <script>
    var Dtabel;
    $(document).ready(function() {
        $(document).ready(function() {
            Dtabel = $("#DTable").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                order: [],
                ajax: {
                    url: "<?= base_url() . 'datatable'; ?>",
                    type: "POST",
                    data: function(d) {
                        d.tabel = 'kriteria';
                    },
                },
                columnDefs: [{
                    className: "text-center",
                    targets: ['_all'],
                }, {
                    searchable: false,
                    orderable: false,
                    targets: 0,
                }, ],
                columns: [{
                    data: 'nomor',
                }, {
                    data: "code",
                }, {
                    data: "nama",
                }, {
                    data: "Action",
                }, ],
            });

        });
    });
    </script>
</body>

</html>