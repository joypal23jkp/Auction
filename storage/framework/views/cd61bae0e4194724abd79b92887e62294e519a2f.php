<?php $__env->startSection('content'); ?>
    <div class="hero_area">
        <div class="hero_social">
            <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
            </a>
            <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        </div>
        <div class="">
            <div id="carouselExampleIndicators" class="carousel slide hero_section_slider" data-bs-ride="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner h-100">
                    <div class="carousel-item active h-100">
                        <?php if (isset($component)) { $__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Banner::class, ['title' => 'Banner Title','details' => 'Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit amet, lobortis semper quam.','image' => 'url']); ?>
<?php $component->withName('banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7)): ?>
<?php $component = $__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7; ?>
<?php unset($__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7); ?>
<?php endif; ?>
                    </div>
                    <div class="carousel-item h-100">
                        <?php if (isset($component)) { $__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Banner::class, ['title' => 'Banner Title','details' => 'Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit amet, lobortis semper quam.','image' => 'url']); ?>
<?php $component->withName('banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7)): ?>
<?php $component = $__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7; ?>
<?php unset($__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7); ?>
<?php endif; ?>
                    </div>
                    <div class="carousel-item h-100">
                        <?php if (isset($component)) { $__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Banner::class, ['title' => 'Banner Title','details' => ' Banner Details','image' => 'url']); ?>
<?php $component->withName('banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7)): ?>
<?php $component = $__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7; ?>
<?php unset($__componentOriginal81d14a56237d5dab72162be620d59a2471e042a7); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- shop section -->

    <section class="shop_section layout_padding">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h1 class="bold">
                    Latest Products Auction
                </h1>
                <a href="<?php echo e(asset('products')); ?>" class="d-flex justify-content-center align-items-center text-decoration-underline text-bold">See All Products</a>
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
            </div>
        </div>
    </section>



    <!-- contact section -->

    <section class="contact_section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="form_container">
                        <div class="heading_container">
                            <h2>
                                Contact Us
                            </h2>
                        </div>
                        <form action="">
                            <div>
                                <input type="text" placeholder="Full Name " />
                            </div>
                            <div>
                                <input type="email" placeholder="Email" />
                            </div>
                            <div>
                                <input type="text" placeholder="Phone number" />
                            </div>
                            <div>
                                <input type="text" class="message-box" placeholder="Message" />
                            </div>
                            <div class="d-flex ">
                                <button>
                                    SEND
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="images/contact-img.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end contact section -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/home.blade.php ENDPATH**/ ?>