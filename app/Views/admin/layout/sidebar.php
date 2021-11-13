<ul class="nav nav-legacy nav-child-indent nav-collapse-hide-child nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">MENU</li>
    <?php if (session()->get('role') == 'Paroki') : ?>
        <li class="nav-item">
            <a href="/admin" class="nav-link<?= ($act[0] == 'dashboard') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview<?= ($act[0] == 'settings') ? ' menu-open' : ''; ?>">
            <a href="#" class="nav-link<?= ($act[0] == 'settings') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-cogs"></i>
                <p>Settings</p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/setting" class="nav-link<?= ($act[1] == 'paroki') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Paroki</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/paroki" class="nav-link<?= ($act[1] == 'admin') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Admin</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview<?= ($act[0] == 'master') ? ' menu-open' : ''; ?>">
            <a href="#" class="nav-link<?= ($act[0] == 'master') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-book"></i>
                <p>Data Master</p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/lingkungan" class="nav-link<?= ($act[1] == 'lingkungan') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lingkungan</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/aktivitas" class="nav-link<?= ($act[1] == 'aktivitas') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aktivitas Masyarakat</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/kategorial" class="nav-link<?= ($act[1] == 'kategorial') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kel Kategorial Gereja</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/pekerjaan" class="nav-link<?= ($act[1] == 'pekerjaan') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pekerjaan</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/pendidikan" class="nav-link<?= ($act[1] == 'pendidikan') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pendidikan</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview<?= ($act[0] == 'keluarga') ? ' menu-open' : ''; ?>">
            <a href="#" class="nav-link<?= ($act[0] == 'keluarga') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>Keluarga Katolik</p>
                <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/keluarga/add" class="nav-link<?= ($act[1] == 'tambah') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Tambah Data</p>
                    </a>
                </li>
            </ul>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/keluarga" class="nav-link<?= ($act[1] == 'lihat') ? ' active' : ''; ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Keluarga</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/admin/demografi" class="nav-link<?= ($act[0] == 'demografi') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>
                    Demografi Umat
                </p>
            </a>
        </li>
    <?php elseif (session()->get('role') == 'Lingkungan') : ?>
        <li class="nav-item">
            <a href="/adling" class="nav-link<?= ($act[0] == 'dashboard') ? ' active' : ''; ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a href="/signout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>
                Log Out
            </p>
        </a>
    </li>

    <!-- <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Pengaturan</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/koperasi/profile" class="nav-link">
                    <i class="fas fa-home nav-icon"></i>
                    <p>Profil Koperasi</p>
                </a>
            </li>
        </ul>
    </li> -->

</ul>