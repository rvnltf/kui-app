<ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>" style="font-size: 12px;">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url() ?>/img/logo.png" alt="" width="60">
        </div>
        <div class="sidebar-brand-text pt-3">
            <p class="text-left">Office of International Affairs</p>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profile') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Profil</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url() ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <?php if (in_groups('admin')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('exchange') ?>">
                <i class="fas fa-fw fa-exchange-alt"></i>
                <span>Student Exchange</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('appliedPrograms') ?>">
                <i class="fas fa-fw fas fas fa-clipboard-list"></i>
                <span>Applied Progress</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('verificationUser') ?>">
                <i class="fas fa-fw fa-clipboard-check"></i>
                <span>Verification User</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('departement') ?>">
                <i class="fas fa-fw fas fa-archive"></i>
                <span>Master Departement</span></a>
        </li>

    <?php else : ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('studentExchanges') ?>">
                <i class="fas fa-fw fa-home"></i>
                <span>Student Exchange</span></a>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-clipboard-check"></i>
                <span>Your Applied</span></a>
        </li> -->
    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>