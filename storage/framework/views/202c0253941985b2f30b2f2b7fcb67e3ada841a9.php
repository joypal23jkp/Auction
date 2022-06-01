<?php $__env->startSection('content'); ?>
    <!-- shop section -->

    <section class="shop_section">

        <div class="container">
            <div class="heading_container heading_center mb-4 mt-5">
                <h1> Notifications </h1>
            </div>
            <div>
                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!$notification->checked): ?>
                        <div class="card w-50 mx-auto my-2">
                            <div class="card-header">
                                <?php echo e($notification->notify_for); ?>

                            </div>
                            <div class="card-body d-flex">
                                <div>
                                    <h5 class="card-title"><?php echo e($notification->details); ?></h5>
                                    <p><?php echo e($notification->created_at); ?></p>
                                    <p><?php echo e($notification->p_name ?? ''); ?></p>
                                    <a href="<?php echo e(route('notification-check', ['id' => $notification->id])); ?>" class="btn btn-primary">Check</a>
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($notifications) < 1): ?>
                        <div class="card w-25 mx-auto">
                            <div class="card-body" style="font-size: 24px">
                                <i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>
                                <span class="font-weight-bold opacity-75">No items found.....</span>
                            </div>
                        </div>
                    <?php endif; ?>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/notifications.blade.php ENDPATH**/ ?>