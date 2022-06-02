<?php $__env->startSection('content'); ?>
    <!-- shop section -->

    <section class="shop_section">

        <div class="container">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="<?php echo e(route('admin.bits')); ?>">
                        <input name="user_search" class="form-control me-2" type="search" placeholder="Search by user name" aria-label="Search" value="<?php echo e(request()->input('user_search')); ?>">
                        <input name="product_search" class="form-control me-2" type="search" placeholder="Search by product_name" aria-label="Search" value="<?php echo e(request()->input('product_search')); ?>">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            <div class="heading_container heading_center mb-4 mt-5">
                <strong style="font-size: 16px" class="text-decoration-underline"> Products History </strong>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Profile</th>
                    <th scope="col">Bidder Profile</th>
                    <th scope="col">Bid Price</th>
                    <th scope="col">Bidding Time</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $bits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $bit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th>
                            <?php echo e($key+1); ?>

                        </th>
                        <td>
                            <strong class="font-weight-bold d-inline-block"><?php echo e($bit->product_title); ?></strong><br>
                            <small>Base Price: ৳ <s><?php echo e($bit->product_base_price); ?></s></small><br>
                        </td>
                        <td>
                            <strong><?php echo e($bit->user_name); ?></strong><br>
                            <small><?php echo e($bit->user_type); ?></small>
                        </td>
                        <td>
                            <span> ৳ <?php echo e($bit->bid_price); ?></span>
                        </td>
                        <td>
                            <span>
                                <?php echo e($bit->created_at); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div style="height: 50px">
                <?php echo e($bits->links()); ?>

            </div>
            <div class="row">
                <?php if(count($bits) < 1): ?>
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/admin/bits.blade.php ENDPATH**/ ?>