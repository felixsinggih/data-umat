<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="/upload/img/profile.png" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="/user/profile" class="d-block">
            <?php $nama = explode(' ', session()->get('name'));
            echo $nama[0] ?>
        </a>
    </div>
</div>