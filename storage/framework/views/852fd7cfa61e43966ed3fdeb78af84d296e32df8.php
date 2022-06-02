<?php $__env->startSection('content'); ?>
    <div class="container w-100 d-flex justify-content-center align-items-center" style="height: 80vh">
        <img width="300" height="300" src="<?php echo e(asset('images/welcome.png')); ?>" alt="welcome">
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/admin/home.blade.php ENDPATH**/ ?>