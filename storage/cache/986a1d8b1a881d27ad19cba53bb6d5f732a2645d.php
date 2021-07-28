<?php echo $__env->make('layouts.admin.auth.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="login-box">
    <div class="login-logo">
        <a href="<?php echo e(asset('/')); ?>">Short links</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<?php echo $__env->make('layouts.admin.auth.partials.foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /var/www/short-links/views/layouts/admin/auth/layout.blade.php ENDPATH**/ ?>