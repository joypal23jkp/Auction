<?php $__env->startSection('content'); ?>
<div class="container w-100 d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card w-auto">
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="position-fixed w-50" style="top: 30rem; right: 20px;">
                    <div class="alert alert-danger"> <?php echo e($message); ?> </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <div class="card-body">
                    <h4 class="card-title text-center" style="font-weight: bold;"><?php echo e(__('Register')); ?></h4>
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="confirm_password">
                        </div>

                        <div class=" mb-0">
                                <button type="submit" class="btn btn-primary w-100">
                                    <?php echo e(__('Register')); ?>

                                </button>
                        </div>
                    </form>
                </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/auth/register.blade.php ENDPATH**/ ?>