<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon">
            <img src="img/logo2.png" style="max-width: 40px; border-radius: 6px;" />
        </div>
        <div class="sidebar-brand-text mx-3 display-8 text-black font-weight-bold">
            <img src="img/logo-b.png" style="width: 150px; border-radius: 5px;" />
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block mb-0">

    <li class="nav-item">
        <a class="nav-link" href="order.php">
            <i class="fas fa-fw fa-truck"></i>
            <span>Manage Order</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block mb-0">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-tshirt"></i>
            <span>Manage Product</span>
        </a>
        <div id="collapseMenu" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item" href="new-product.php">New Product</a>
                <a class="collapse-item" href="product.php">Product List</a>
            </div>
        </div>
    </li>

   
    <hr class="sidebar-divider d-none d-md-block mb-0">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenuA"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-users"></i>
            <span>Manage Account</span>
        </a>
        <div id="collapseMenuA" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <!-- <a class="collapse-item" href="new-user.php">New User Account</a> -->
                <a class="collapse-item" href="user.php">User List</a>
            </div>
        </div>
    </li>
    

    <hr class="sidebar-divider d-none d-md-block mb-0">
    <li class="nav-item">
        <a class="nav-link" href="contact.php">
            <i class="fas fa-fw fa-comment"></i>
            <span>View Messages</span>
        </a>
    </li>


   
    <hr class="sidebar-divider d-none d-md-block mb-0">
    <li class="nav-item">
        <a class="nav-link" href="profile.php">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Profile</span>
        </a>
    </li>

    

   
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>