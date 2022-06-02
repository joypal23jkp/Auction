<?php $__env->startSection('content'); ?>
    <!-- shop section -->

    <section class="shop_section layout_padding">

        <div class="container">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="<?php echo e(route('products')); ?>">
                        <select name="category" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>All Categories</option>
                            <?php $__currentLoopData = \Illuminate\Support\Facades\DB::table('categories')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <select name="types" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>All Types</option>
                            <option value="available">Available</option>
                            <option value="sold">Sold</option>
                            <option value="deactivated">Deactivated</option>
                        </select>
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="<?php echo e(request()->input('search')); ?>">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <a type="button" class="btn btn-outline-primary" href="<?php echo e(route('show-product-create')); ?>"> <i class="fa fa-plus-circle"></i> Add Product</a>
                </div>
            </nav>
            <div class="heading_container heading_center mb-4 mt-5">
                <h1> All Products </h1>
            </div>
            <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 col-xl-3">
                        <?php if (isset($component)) { $__componentOriginal478f6e349ea16eb9fb81c5e0c850a1c7e1c90d63 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\CommonProduct::class, ['product' => $product]); ?>
<?php $component->withName('common-product'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal478f6e349ea16eb9fb81c5e0c850a1c7e1c90d63)): ?>
<?php $component = $__componentOriginal478f6e349ea16eb9fb81c5e0c850a1c7e1c90d63; ?>
<?php unset($__componentOriginal478f6e349ea16eb9fb81c5e0c850a1c7e1c90d63); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($products) < 1): ?>
                        <div class="card w-25 mx-auto">
                            <div class="card-body" style="font-size: 24px">
                                <i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>
                                <span class="font-weight-bold opacity-75">No items found.....</span>
                            </div>
                        </div>
                    <?php endif; ?>
            </div>
            <div style="height: 50px" class="mt-5 d-flex justify-content-center">
                <?php echo e($products->links()); ?>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/products.blade.php ENDPATH**/ ?>