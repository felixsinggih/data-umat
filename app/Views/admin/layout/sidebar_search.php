<form action="/admin/keluarga" method="post">
    <?= csrf_field(); ?>
    <div class="input-group mb-3">
        <input type="search" class="form-control form-control-sidebar" placeholder="Pencarian" name="keyword" autocomplete="off">
        <div class="input-group-append">
            <button class="btn btn-sidebar" type="submit" name="submit">
                <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
    </div>
</form>