<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Auction')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <!-- bootstrap core css -->

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- font awesome style -->
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet" />
    <!-- responsive style -->
    <link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />

</head>
<body>
    <div id="app">
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand"  href="<?php echo e(url('/')); ?>">
                        <span>
                          <?php echo e(config('app.name', 'Laravel')); ?>

                        </span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo e(asset('/')); ?>">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('products')); ?>"> Products </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(asset('about')); ?>"> About </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(asset('contact')); ?>">Contact Us</a>
                            </li>
                        </ul>
                        <div class="user_option-box">

                            <?php if(auth()->guard()->guest()): ?>
                                <?php if(Route::has('login')): ?>
                                    <a
                                        href="<?php echo e(route('login')); ?>"
                                        style="font-size: 14px;"
                                    >
                                        <i class="fa fa-sign-in"></i>
                                        <?php echo e(__('Login')); ?>

                                    </a>
                                <?php endif; ?>
                                <?php if(Route::has('register')): ?>
                                        <a href="<?php echo e(route('register')); ?>" style="font-size: 14px">
                                            <i class="fa fa-user-plus"></i>
                                            <?php echo e(__('Register')); ?>

                                        </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" style="font-size: 14px; font-weight: bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?>

                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown" style="font-size: 14px">
                                    <li>
                                        <a class="dropdown-item" style="font-size: 12px;" href="<?php echo e(route('user-product')); ?>">
                                            <i class="fa fa-product-hunt"></i>
                                            Products
                                        </a>
                                    </li>
                                    <li>
                                        <?php
                                            $user_notification = DB::table('notifications')->where('user_id', \Illuminate\Support\Facades\Auth::id())->where('checked', false)->orderByDesc('id')->count();
                                        ?>
                                        <a class="dropdown-item" style="font-size: 12px;" href="<?php echo e(route('notification')); ?>">
                                            <i class="fa fa-bell" aria-hidden="true"></i>
                                            Notifications <span class="badge text-bg-secondary bg-primary"><?php echo e($user_notification); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-link" style="font-size: 12px;" href="<?php echo e(route('logout')); ?>"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>
                                            <?php echo e(__('Logout')); ?>

                                        </a>
                                    </li>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('success')); ?>

                </div>
            <?php endif; ?>

        </div>
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <!-- footer section -->
        <footer class="footer_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="footer_detail">
                            <h4>
                                About
                            </h4>
                            <p>
                                Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
                            </p>
                            <div class="footer_social">
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
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="footer_contact">
                            <h4>
                                Reach at..
                            </h4>
                            <div class="contact_link_box">
                                <a href="">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>
                  Location
                </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>
                  Call +01 1234567890
                </span>
                                </a>
                                <a href="">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>
                  demo@gmail.com
                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="footer_contact">
                            <h4>
                                Subscribe
                            </h4>
                            <form action="#">
                                <input type="text" placeholder="Enter email" />
                                <button type="submit">
                                    Subscribe
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 footer-col">
                        <div class="map_container">
                            <div class="map">
                                <div id="googleMap"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-info">
                    <p>
                        &copy; <span id="displayYear"></span> All Rights Reserved By
                        <a href="https://html.design/">Me</a>
                    </p>
                </div>
            </div>
        </footer>
        <!-- footer section -->

    </div>
</body>
</html>
<?php /**PATH D:\PlayGround\Laravel\Auction Application\auction_me\resources\views/layouts/app.blade.php ENDPATH**/ ?>