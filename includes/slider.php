<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="assets/img/logo.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Computer Store</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/img/userimage/<?php echo $image; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $fname; ?></a>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo $title == 'Dashboard' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="products.php" class="nav-link <?php echo $title == 'Products' ? 'active' : ''; ?>">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users.php" class="nav-link <?php echo $title == 'Users' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="roles.php" class="nav-link <?php echo $title == 'Role' ? 'active' : ''; ?>">
                        <i class="nav-icon 	fas fa-user-cog"></i>
                        <p>Roles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="category.php" class="nav-link <?php echo $title == 'Category' ? 'active' : ''; ?>">
                        <i class="nav-icon fa fa-list-alt"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="feedback.php" class="nav-link <?php echo $title == 'Feedback' ? 'active' : ''; ?>">
                        <i class="nav-icon fab fa-facebook-messenger"></i>
                        <p>Feedbacks</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="policy.php" class="nav-link <?php echo $title == 'Policy' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-file-contract"></i>
                        <p>Policy</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>