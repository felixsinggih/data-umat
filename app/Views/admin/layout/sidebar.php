<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-header">MENU</li>
    <li class="nav-item">
        <a href="/admin/dashboard" class="nav-link<?= ($act[0] == 'dashboard') ? ' active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item has-treeview<?= ($act[0] == 'master') ? ' menu-open' : ''; ?>">
        <a href="#" class="nav-link<?= ($act[0] == 'master') ? ' active' : ''; ?>">
            <i class="nav-icon fas fa-digital-tachograph"></i>
            <p>Data Master</p>
            <i class="right fas fa-angle-left"></i>
        </a>
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
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/admin/lingkungan" class="nav-link<?= ($act[1] == 'lingkungan') ? ' active' : ''; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Lingkungan</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="/admin/keluarga" class="nav-link<?= ($act[0] == 'keluarga') ? ' active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Keluarga Katolik
            </p>
        </a>
    </li>

    <li class="nav-item has-treeview">
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
    </li>

</ul>