<?= $this->extend('admin/layout/template') ?>
<?= $this->section('content') ?>

<row>
    <div class="card">
        <div class="card-body">

            <form action="/admin/keluarga/export" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="excel_file" class="col-sm-2 col-form-label">Dokumen</label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('excel_file')) ? 'is-invalid' : ''; ?>" id="excel_file" name="excel_file" onchange="previewFileName()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('excel_file'); ?>
                            </div>
                            <label class="custom-file-label" for="excel_file">Pilih file</label>
                        </div>
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
</row>

<?= $this->endSection() ?>