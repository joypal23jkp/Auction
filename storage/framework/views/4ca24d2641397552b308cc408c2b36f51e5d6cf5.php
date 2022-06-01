<div class="box">
    <a href="<?php echo e(route('show-product', $product->id)); ?>">
        <div class="img-box">
            <?php if(count($product->images) < 1): ?>
                <img src="<?php echo e(asset('images/alt-product.png')); ?>" alt="">
            <?php else: ?>
                <img src="<?php echo e(asset('storage/'.$product->images[0]["image_url"])); ?>" alt="">
            <?php endif; ?>
        </div>
        <div class="detail-box">
            <h6>
                <?php echo e($product->product_title); ?>

            </h6>
            <h6>
                Base Price:
                <span>৳<?php echo e($product->product_base_price); ?></span>
            </h6>
        </div>
        <div>
            <?php if($product->product_category): ?>
                <span>
                    Category: <?php echo e(\Illuminate\Support\Facades\DB::table('categories')->where('id', $product->product_category)->first()->title); ?>

                </span>
            <?php else: ?>
                <span>
                    Category: N/A
                </span>
            <?php endif; ?>

        </div>
        <?php if($product->product_status === \App\Enums\ProductStatusEnum::Available()->value): ?>
            <div class="new">
                <span><?php echo e($product->product_status); ?></span>
            </div>
        <?php elseif($product->product_status === \App\Enums\ProductStatusEnum::Deactivated()->value ): ?>
            <div class="new bg-danger">
                <span><?php echo e($product->product_status); ?></span>
            </div>
        <?php else: ?>
            <div class="new bg-success">
                <span><?php echo e($product->product_status); ?></span>
            </div>
            <?php if($product->buyer): ?>
                <div class="w-100 p-2 my-2" style="border-radius: 10px; background: #dbd2db">
                    <p class="mb-0">Winner: <?php echo e($product->buyer->name); ?></p>
                    <span>Email : <?php echo e($product->buyer->email ?? 'N/A'); ?></span>
                    <p>Price : <?php echo e($product->product_sold_price ?? 'N/A'); ?></p>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </a>
</div>

<?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/components/common-product.blade.php ENDPATH**/ ?>