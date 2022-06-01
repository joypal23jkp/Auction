@extends('layouts.app')

@section('content')
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
                        <x-banner
                            title="Banner Title"
                            details="Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit amet, lobortis semper quam."
                            image="url"
                        > </x-banner>
                    </div>
                    <div class="carousel-item h-100">
                        <x-banner
                            title="Banner Title"
                            details="Aenean scelerisque felis ut orci condimentum laoreet. Integer nisi nisl, convallis et augue sit amet, lobortis semper quam."
                            image="url"
                        > </x-banner>
                    </div>
                    <div class="carousel-item h-100">
                        <x-banner title="Banner Title" details=" Banner Details" image="url"> </x-banner>
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
                <a href="{{ asset('products') }}" class="d-flex justify-content-center align-items-center text-decoration-underline text-bold">See All Products</a>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 col-xl-3">
                        <x-common-product  :product="$product" />
                    </div>
                @endforeach
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

@endsection
