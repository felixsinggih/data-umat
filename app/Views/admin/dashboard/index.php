<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body">
            <?= session()->get('name') ?>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
</row>

<?= $this->endSection() ?>