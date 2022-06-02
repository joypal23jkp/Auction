@extends('layouts.admin.app')

@section('content')
    <!-- shop section -->

    <section class="shop_section">

        <div class="container">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.products') }}">
                        <select name="category" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>All Categories</option>
                            @foreach(
                                \Illuminate\Support\Facades\DB::table('categories')->get()
                                as $category
                            )

                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <select name="types" class="form-select mx-2" aria-label="Default select example">
                            <option value="" selected>All Types</option>
                            <option value="available">Available</option>
                            <option value="sold">Sold</option>
                            <option value="deactivated">Deactivated</option>
                        </select>
                        <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{ request()->input('search') }}">
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
                @foreach($products as $key => $product)
                    <tr>
                        <th>
                            {{ $key+1 }}
                        </th>
                        <th scope="row">
                            <img width="50" src="{{ asset('storage/'.$product->images[0]["image_url"]) }}" alt="">
                        </th>
                        <td>
                            <span class="badge rounded-pill bg-primary">{{ $product->product_status }}</span><br>
                            <strong class="font-weight-bold d-inline-block">{{ $product->product_title }}</strong><br>
                            <small class="block">Sold Price: ৳{{ $product->product_sold_price }}</small><br>
                            <small>Base Price: ৳ <s>{{ $product->product_base_price }}</s></small><br>
                            <small>

                                {{ isProductValidForBid(now(), $product->product_valid_till) }}

                            </small> Remaining for Bidding
                        </td>
                        <td>
                            {{ $product->product_description }}
                        </td>
                        <td>
                            <strong>{{ $product->seller->name }}</strong><br>
                            <small>{{ $product->seller->email }}</small>
                        </td>
                        <td>
                            @if($product->buyer)
                                <strong>{{ $product->buyer->name }}</strong><br>
                                <small>{{ $product->buyer->email }}</small>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                           <strong>  ৳ {{ $product->bits[0]->bid_price ?? 0 }}</strong>
                        </td>
                        <td>
                            <strong>{{ \Illuminate\Support\Carbon::parseFromLocale($product->product_valid_till) }}</strong>
                        </td>
                        <td>
                            @if($product->product_status != 'Sold')
                                @if($product->product_status == 'Available')
                                    <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                        <a href="{{ route('admin.product.update', ['id' => $product->id, 'status' => 'Deactivated']) }}">Inactive Product</a>
                                    </button>
                                    <br>
                                    <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                        <a href="{{ route('admin.product.update', ['id' => $product->id, 'status' => 'Sold']) }}">Accept Auction</a>
                                    </button>
                                @elseif($product->product_status == 'Deactivated')
                                <button type="button" class="btn btn-sm my-1 btn-outline-primary">
                                    <a href="{{ route('admin.product.update', ['id' => $product->id, 'status' => 'Available']) }}">Active Product</a>
                                </button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="height: 50px">
                {{ $products->links() }}
            </div>
            <div class="row">
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
