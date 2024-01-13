<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link" href="<?= base_url('/home'); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Data AHP</div>
                <a class="nav-link" href="<?= base_url('kriteria'); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Kriteria
                </a>
                <a class="nav-link" href="<?= base_url('alternatif'); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Alternatif
                </a>
                <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Kriteria
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('kriteria'); ?>">Kelola Kriteria</a>
                        <a class="nav-link" href="<?= base_url('kriteria/hitung'); ?>">Hitung Kriteria</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Alternatif
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('alternatif'); ?>">Kelola Alternatif</a>
                        <a class="nav-link" href="<?= base_url('alternatif/hitung'); ?>">Hitung Kriteria</a>
                    </nav>
                </div> -->
                <div class="sb-sidenav-menu-heading">Perhitungan</div>
                <a class="nav-link" href="<?= base_url('perhitungan/kriteria'); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Perhitungan
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $_SESSION['nama']; ?>
        </div>
    </nav>
</div>