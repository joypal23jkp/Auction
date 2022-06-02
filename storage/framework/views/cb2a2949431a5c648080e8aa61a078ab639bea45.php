<?php $__env->startSection('content'); ?>
    <!-- shop section -->
    <section class="shop_section layout_padding">
        <div style="width: 30%;" class="mx-auto">
            <div class="card text-end">
                <h4 class="card-header font-weight-bold text-center bg-transparent"> <i class="fa fa-plus-circle"></i> Add Product</h4>
                <div class="card-body">


                    <form class="row g-3" method="POST" action="<?php echo e(route('create-product')); ?>" enctype="multipart/form-data">

                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="product_title" class="form-label">Product Title</label>
                            <input type="text" name="product_title" class="form-control" id="product_title">
                        </div>
                        <label for="floatingSelect">Categories</label>
                        <div class="form-floating">
                            <select class="form-select" name="product_category" id="floatingSelect" aria-label="Floating label select example">
                                <option selected value="">Select Categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_description" class="form-label">Description</label>
                            <textarea class="form-control" name="product_description" id="product_description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="product_base_price" class="form-label">Product Base Price</label>
                            <input type="number" min="1" name="product_base_price" class="form-control" id="product_base_price">
                        </div>
                        <div class="mb-3">
                            <label for="product_base_price" class="form-label">Product Image</label>
                            <input type="file" name="product_image" class="form-control" id="product_image">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/create-product.blade.php ENDPATH**/ ?>