<?php $__env->startSection('content'); ?>
 <section class="about_section layout_padding">
     <div class="container">
         <div class="row">
             <div class="col-md-6 col-lg-5 ">
                 <div class="img-box">
                     <img src="<?php echo e(asset('storage/'.$product->images[0]["image_url"])); ?>" alt="">
                 </div>
             </div>
             <div class="col-md-6 col-lg-7 position-relative">
                 <?php if(\Illuminate\Support\Facades\Auth::id() === $product->product_author): ?>
                     <div class="position-absolute top-0" style="right: 0;">
                         <a type="button" class="btn btn-outline-primary" href="<?php echo e(route('show-product-update', ["id" => $product->id])); ?>"> <i class="fa fa-pencil-square"></i> Update Product</a>
                     </div>
                 <?php endif; ?>
                 <div class="detail-box">
                     <?php if(
                        !isProductValidForBid($product->created_at, $product->product_valid_till) ||
                        $product->product_status == 'Sold'
                     ): ?>
                        <p class="text-bold bg-success opacity-75 w-25 text-center p-3 radius">
                            Biting Time is Up
                        </p>
                     <?php else: ?>
                         <p class="text-bold bg-success opacity-75 w-25 text-center p-3 radius">
                             <?php echo e(isProductValidForBid($product->created_at, $product->product_valid_till)); ?> <br>
                             Remaining To Bit
                         </p>
                     <?php endif; ?>

                         <div class="heading_container">
                         <h2>
                             <?php echo e($product->product_title); ?>

                         </h2>
                     </div>
                         <p> <?php echo e($product->product_description); ?> </p>
                        <div class="d-flex">
                            <p> Seller Name: <?php echo e($product->seller->name); ?> </p>
                            <p class="mx-4"> Seller Email: <?php echo e($product->seller->email); ?> </p>
                        </div>
                         <hr>
                         <p>Base Price  ৳<?php echo e($product->product_base_price); ?></p>
                    <?php if(
                         $product->product_status == \App\Enums\ProductStatusEnum::Available()->value
                    ): ?>
                        <form  method="POST" action="<?php echo e(route('bit-product')); ?>">
                         <?php echo csrf_field(); ?>
                         <input type="number" name="bit_price" hidden value="<?php echo e(($biting_price  ?? $product->product_base_price) + 100); ?>" >
                         <input type="number" name="id" hidden value="<?php echo e($product->id); ?>" >
                         <button type="submit" class="bg-transparent border-0 p-0">
                             <?php if(
                                !isProductValidForBid($product->created_at, $product->product_valid_till)
                            ): ?>
                             <?php else: ?>
                                 <a class="text-black product_bit_button">
                                     Bit for  ৳<?php echo e(($biting_price  ?? $product->product_base_price) + 100); ?>

                                 </a>
                             <?php endif; ?>

                         </button>
                        </form>
                         <?php elseif($product->product_status == \App\Enums\ProductStatusEnum::Sold()->value): ?>
                             <a type="" class="text-black">
                                 Sold for  ৳<?php echo e($product->product_sold_price); ?>

                             </a>
                            <h3 class="my-2">Auction Winner: <?php echo e($product->buyer->name); ?></h3>
                         <?php else: ?>
                             <span class="py-2 px-4" style="border-radius: 45px; background: rgba(138,23,23,0.42);"><?php echo e($product->product_status); ?></span>
                         <?php endif; ?>
                 </div>
             </div>
         </div>
     </div>
 </section>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/product.blade.php ENDPATH**/ ?>