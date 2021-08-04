<?php $__env->startSection('css'); ?>
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <style>
        div#datatable_wrapper .pagination, .dataTables_info {
            display: none;
        }

        .links {
        display: flex;
        justify-content: center;
        }
    </style>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- DataTables -->
    <script src="<?php echo e(asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')); ?>"></script>
    <script>
        $('#datatable').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        })
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>All Users</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo e(url('admin/dashboard')); ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active">All Users</li>
        </ol>
    </section>

    <section class="content">
        <?php if(session('message')): ?>
            <div class="alert alert-info"><?php echo e(flash('message')); ?></div>
        <?php endif; ?>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    <a href="<?php echo e(url('admin/users/create')); ?>" class="btn btn-primary">Add new user</a>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>User name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $users['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->id); ?></td>
                            <td><?php echo e($user->first_name); ?></td>
                            <td><?php echo e($user->last_name); ?></td>
                            <td><?php echo e($user->user_name); ?></td>
                            <td>
                                <a href="<?php echo e(url('admin/users/'. $user->id . '/edit')); ?>" class="btn btn-success">Edit</a>
                                <a href="#" data-action="<?php echo e(url('admin/users/'. $user->id . '/delete')); ?>" class="btn btn-danger delete_confirmation" data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="links">
                <?php echo links($users['current_page'], $users['pages']); ?>

            </div>
            <!-- /.box-body -->
        </div>
    </section>

    <?php echo $__env->make('layouts.admin.dashboard.partials.delete_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.dashboard.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/short-links/views/admin/users/index.blade.php ENDPATH**/ ?>