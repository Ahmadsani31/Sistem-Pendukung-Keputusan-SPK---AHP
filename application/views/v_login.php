<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description"
        content="Halaman Login Sistem Pendukung Keputusan dengan menggunakan Analytical Hierarchy Process (AHP)" />
    <meta name="author" content="adsa" />
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/'); ?>favicon.png">
    <title>Login - SPK metode AHP</title>
    <link href="<?= base_url('assets'); ?>/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-login">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="card shadow-lg border-0 rounded-lg" style="margin-top: 200px;">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Aplikasi SPK-AHP</h3>
                                </div>
                                <div class="card-body">
                                    <?php echo validation_errors(); ?>
                                    <?php echo $this->session->flashdata('notif') ?>
                                    <?php echo form_open('auth/login'); ?>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="username" type="text" placeholder="username"
                                            value="<?php echo set_value('username'); ?>" />
                                        <label>Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control" name="password" type="password"
                                            placeholder="Password" value="<?php echo set_value('password'); ?>" />
                                        <label>Password</label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                    <p class="mb-0 mt-4">Sampel Akun</p>
                                    <ul>
					<li>username : pimpinan | password : pimpinan</li>
                                        <li>username : adminspk | password : adminspk</li>
                                    </ul>
                                    <?php echo form_close() ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-2 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; My first program</div>
                        <div>
                            <p class="mb-0">Website Aplikasi Sistem Pendukung Keputusan (SPK) dengan menggunakan
                                Analytical
                                Hierarchy Process (AHP)</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="<?= base_url('assets'); ?>/js/scripts.js"></script>
</body>

</html>
