<?php $__env->startSection('content'); ?>
    <!-- shop section -->

    <section class="shop_section">

        <div class="container">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="<?php echo e(route('admin.products')); ?>">
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
                </div>
            </nav>
            <div class="heading_container heading_center mb-4 mt-5">
                <strong style="font-size: 16px" class="text-decoration-underline"> Products History </strong>
            </div>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product Profile</th>
                    <th scope="col">Product Details</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Winner</th>
                    <th scope="col">Top Bid</th>
                    <th scope="col">Valid Till</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th>
                            <?php echo e($key+1); ?>

                        </th>
                        <th scope="row">
                            <img width="50" src="<?php echo e(asset('storage/'.$product->images[0]["image_url"])); ?>" alt="">
                        </th>
                        <td>
                            <span class="badge rounded-pill bg-primary"><?php echo e($product->product_status); ?></span><br>
                            <strong class="font-weight-bold d-inline-block"><?php echo e($product->product_title); ?></strong><br>
                            <small class="block">Sold Price: ৳<?php echo e($product->product_sold_price); ?></small><br>
                            <small>Base Price: ৳ <s><?php echo e($product->product_base_price); ?></s></small><br>
                            <small>

                                <?php echo e(isProductValidForBid($product->created_at, $product->product_valid_till)); ?>


                            </small> Remaining for Bidding
                        </td>
                        <td>
                            <?php echo e($product->product_description); ?>

                        </td>
                        <td>
                            <strong><?php echo e($product->seller->name); ?></strong><br>
                            <small><?php echo e($product->seller->email); ?></small>
                        </td>
                        <td>
                            <?php if($product->buyer): ?>
                                <strong><?php echo e($product->buyer->name); ?></strong><br>
                                <small><?php echo e($product->buyer->email); ?></small>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td>
                           <strong>  ৳ <?php echo e($product->bits[0]->bid_price ?? 0); ?></strong>
                        </td>
                        <td>
                            <strong><?php echo e(\Illuminate\Support\Carbon::parseFromLocale($product->product_valid_till)); ?></strong>
                        </td>
                        <td>
                            <?php if($product->product_status != 'Sold'): ?>
                                <?php if($product->product_status == 'Available'): ?>
                                    <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                        <a href="<?php echo e(route('admin.product.update', ['id' => $product->id, 'status' => 'Deactivated'])); ?>">Inactive Product</a>
                                    </button>
                                    <br>
                                    <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                        <a href="<?php echo e(route('admin.product.update', ['id' => $product->id, 'status' => 'Sold'])); ?>">Accept Auction</a>
                                    </button>
                                <?php elseif($product->product_status == 'Deactivated'): ?>
                                <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                    <a href="<?php echo e(route('admin.product.update', ['id' => $product->id, 'status' => 'Available'])); ?>">Active Product</a>
                                </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <div style="height: 50px">
                <?php echo e($products->links()); ?>

            </div>
            <div class="row">
                <?php if(count($products) < 1): ?>
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/admin/products.blade.php ENDPATH**/ ?>