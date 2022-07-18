<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary1 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-fw fa-database"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Webdata barang</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php
    $role_id = $this->session->userdata('role_id');
    ?>
    <?php if ($role_id == 1) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/kategoribarang') ?>">
                <i class="fas fa-fw fa-sitemap"></i>
                <span>Tambah kategori</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admin/aturuser') ?>">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Atur pengguna</span></a>
        </li>
    <?php else : ?>
    <?php endif; ?>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Akun</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/barangkeluar') ?>">
            <i class="fas fa-fw fa-book-open"></i>
            <span>barang keluar</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/inputbarangkeluar') ?>">
            <i class="fas fa-fw fa-pen-square"></i>
            <span>Input barang keluar</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/databarang') ?>">
            <i class="fas fa-fw fa-box"></i>
            <span>Data barang</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/tambahbarang') ?>">
            <i class="fas fa-fw fa-plus-square"></i>
            <span>Tambah barang</span></a>
    </li>











    <!-- Query menu -->
    <!-- ?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`,`menu`
                    FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id`=`user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id`= $role_id
                    ORDER BY `user_access_menu`.`menu_id`ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    ?> -->
    <!-- LOOPING MENU -->
    <!-- ?php
    foreach ($menu as $m) :
    ?>
        <div class="sidebar-heading">
             ?= $m['menu']; ?> 
        </div>
        
        ?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT * FROM `user_sub_menu` 
            WHERE `menu_id`=$menuId
            AND `is_active`=1";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>
        ?php foreach ($subMenu as $sm) : ?>
            ?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                ?php else : ?>
                <li class="nav-item">
                ?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            ?php endforeach; ?>
        ?php endforeach; ?> -->
    <hr class="sidebar-divider mt-3">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->