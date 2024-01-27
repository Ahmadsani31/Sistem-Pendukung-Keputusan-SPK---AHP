<!DOCTYPE html>
<html lang="en">

<head>
    <?= $this->load->view('_templates/_header', '', true); ?>
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
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>

                    <div class="card  mb-4">
                        <div
                            class="card-header bg-success text-white d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                Laporan Pencarian SPK Metode AHP
                            </div>

                        </div>
                        <div class="card-body">
                            <table class="table" id="DTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card  mb-4">
                        <div class="card-body">
                            <h4>Sistem Pendukung Keputusan (SPK)</h4>
                            <p>Pada awal tahun 1960-an Michael S.Scot Morton dan
                                G.Antony Gorry mengemukakan sebuah sistem yang diberi
                                nama Management Decision System. Kemudian pada tahun
                                1971 mulai dikenal dengan istilah Decision Support System
                                (DSS) atau Sistem Pendukung Keputusan (SPK). Sistem
                                Pendukung Keputusan merupakan sebuah sistem berbasis
                                komputer yang memanfaatkan data maupun model tertentu
                                dengan tujuan membantu pengambil keputusan untuk
                                memecahkan permasalahan dalam menentukan dan mengambil
                                keputusan yang sesuai</p>
                        </div>
                        <div class="card-body">
                            <h4>Analytical Hierarchy Process (AHP)</h4>
                            <p>Analytical Hierarchy Process (AHP) adalah salah satu
                                metode sistem pendukung keputusan yang dikembangkan oleh
                                Thomas L.Saaty pada tahun 1993. Metode AHP memecahkan
                                permasalahan tidak terstruktur atau semi terstruktur menjadi
                                lebih sederhana kedalam bentuk hirarki[9]. Metode ini menggunakan matrik perbandingan
                                berpasangan dengan nilai
                                berdasarkan penilaian seorang pakar yang mengacu pada tabel
                                intensitas kepentingan dari AHP</p>
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
        Dtabel = $("#DTable").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [
                [2, 'desc'],
                [3, 'desc']
            ],
            ajax: {
                url: "<?= base_url() . 'datatable'; ?>",
                type: "POST",
                data: function(d) {
                    d.tabel = 'laporan';
                },
            },
            columnDefs: [{
                className: "text-center",
                targets: ['_all'],
            }, {
                searchable: false,
                orderable: false,
                targets: [0, 4],
            }, ],
            columns: [{
                data: null,
            }, {
                data: "uuid",
            }, {
                data: "nama",
            }, {
                data: "tgl_buat",
            }, {
                data: "Action",
            }, ],
        });
        Dtabel.on('draw.dt', function() {
            var info = Dtabel.page.info();
            Dtabel.column(0, {
                search: 'applied',
                order: 'applied',
                page: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        });
    });
    </script>
</body>

</html>