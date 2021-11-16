<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>
<?= $this->include('admin/layout/fungsi') ?>

<row>
    <div class="card">
        <div class="card-body pb-0">
            <div class="form-group">
                <a href="/user/profile/edit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit Profile</a>
                <a href="/user/password" class="btn btn-success"><i class="fas fa-lock"></i> Edit Password</a>
            </div>
            <div class="form-group">

                <dl>
                    <dt>Username</dt>
                    <dd><?= $user['username'] ?></dd>
                    <dt>Nama Lengkap</dt>
                    <dd><?= $user['name'] ?></dd>
                    <dt>Email</dt>
                    <dd><?= ($user['email']) ? $user['email'] : '-' ?></dd>
                    <dt>Level</dt>
                    <dd><?= $user['role'] ?></dd>
                    <dt>Status</dt>
                    <dd><?= $user['status'] ?></dd>
                    <?php if ($user['role'] == 'Lingkungan') : ?>
                        <dt>Lingkungan / Stasi</dt>
                        <dd><?= $user['nama'] ?></dd>
                    <?php endif; ?>
                    <dt>Last Update</dt>
                    <dd><?= datetime($user['updated_at']) ?></dd>
                </dl>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
</row>

<?= $this->endSection() ?>