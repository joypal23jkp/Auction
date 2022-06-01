@extends('layouts.app')

@section('content')
    <!-- shop section -->

    <section class="shop_section layout_padding">

        <div class="container">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="{{ route('user-product') }}">
                        <select name="user_product_status" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>All Users' products</option>
                            <option value="self">Your Products</option>
                            <option value="purchased">Purchased Products</option>
                        </select>
                        <select name="types" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>Products Types</option>
                            <option value="available">Available</option>
                            <option value="sold">Sold</option>
                            <option value="deactivated">Deactivated</option>
                        </select>

                        <select name="category" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>All Categories</option>
                            @foreach(
                                \Illuminate\Support\Facades\DB::table('categories')->get()
                                as $category
                            )

                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>

                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{ request()->input('search') }}">
                        <button class="btn btn-outline-success" type="submit"> <i class="fa fa-search"></i></button>
                    </form>
                    <div>
                        <a type="button" class="btn btn-outline-primary" href="{{ route('show-product-create') }}"> <i class="fa fa-plus-circle"></i> Add Product</a>
                    </div>
                </div>
            </nav>
            <div class="heading_container heading_center mb-4 mt-5">
                <h1>
                    All Products
                    <span style="font-size: 16px; font-weight: bold;">[ {{ \Illuminate\Support\Facades\Auth::user()->name }} ]</span>
                </h1>
            </div>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-6 col-xl-3">
                        <x-common-product  :product="$product" />
                    </div>
                @endforeach
                @if(count($products) < 1)
                    <div class="card w-25 mx-auto">
                        <div class="card-body" style="font-size: 24px">
                            <i class="fa fa-exclamation-circle text-danger" aria-hidden="true"></i>
                            <span class="font-weight-bold opacity-75">No items found.....</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
