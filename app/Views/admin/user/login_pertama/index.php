<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paroki St. Stephanus Cilacap</title>
    <link href="/upload/img/<?= session()->get('logoParoki') ?>" rel="shortcut icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg text-bold">
                    Selamat datang, <?= $nama = session()->get('name') ?>
                </p>

                <p class="login-box-msg">Untuk menjaga keamanan, jika anda baru pertama kali login. Anda harus mengubah password anda.</p>

                <?php if (session()->getflashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getflashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <form action="/user/security/password" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="uid" name="uid" value="<?= $user['uid'] ?>">
                    <input type="hidden" id="username" name="username" value="<?= $user['username'] ?>">
                    <div class="form-group row">
                        <label for="newPassword" class="col-form-label">Password Baru</label>
                        <input type="password" class="form-control <?= ($validation->hasError('newPassword')) ? 'is-invalid' : ''; ?>" id="newPassword" name="newPassword">
                        <div class="invalid-feedback">
                            <?= $validation->getError('newPassword'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirmPassword" class="col-form-label">Ketik Ulang Password Baru</label>
                        <input type="password" class="form-control <?= ($validation->hasError('confirmPassword')) ? 'is-invalid' : ''; ?>" id="confirmPassword" name="confirmPassword">
                        <div class="invalid-feedback">
                            <?= $validation->getError('confirmPassword'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>

                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>