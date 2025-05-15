

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
         <div class="text-center">
                <img src="<?= base_url('assets/img/logo.jpg'); ?>" alt="Logo" style="width: 140px; height: auto;">
            </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- QUERY MENU -->
    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT user_menu.id, menu
                    FROM user_menu JOIN user_access_menu
                      ON user_menu.id = user_access_menu.menu_id
                   WHERE user_access_menu.role_id = $role_id
                ORDER BY user_access_menu.menu_id ASC
                ";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    

</ul>
<!-- End of Sidebar -->