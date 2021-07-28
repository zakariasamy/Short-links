<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(url('admin/dashboard')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Short links</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- Notifications: style can be found in dropdown.less -->
                <!-- Tasks: style can be found in dropdown.less -->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo e(asset('admin/dist/img/user2-160x160.jpg')); ?>" class="user-image" alt="<?php echo e(auth('admins')->user_name); ?>">
                        <span class="hidden-xs"><?php echo e(auth('admins')->first_name); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(asset('admin/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="<?php echo e(auth('admins')->user_name); ?>">

                            <p>
                                <?php echo e(auth('admins')->first_name . ' ' . auth('admins')->last_name); ?>

                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="">
                                <form action="<?php echo e(url('/admin/logout')); ?>" method="post" id="logout">
                                    <a href="javascript:void(0);" class="btn btn-default btn-block btn-flat" onclick="document.getElementById('logout').submit();">Sign out</a>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<?php /**PATH /var/www/short-links/views/layouts/admin/dashboard/partials/header.blade.php ENDPATH**/ ?>