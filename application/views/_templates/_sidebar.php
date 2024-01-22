<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"></div>

                <?php
                if ($_SESSION['level'] == 1) { ?>
                <a class="nav-link" href="<?= base_url('/home'); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Laporan
                </a>
                <?php  } else { ?>
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
                <div class="sb-sidenav-menu-heading">Perhitungan</div>
                <a class="nav-link" href="<?= base_url('perhitungan/kriteria'); ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Perhitungan
                </a>

                <?php  }
                ?>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= $_SESSION['nama']; ?>
        </div>
    </nav>
</div>