@extends('layouts.admin.app')

@section('content')
    <!-- shop section -->

    <section class="shop_section">

        <div class="container">
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="{{ route('admin.bits') }}">
                        <input name="user_search" class="form-control me-2" type="search" placeholder="Search by user name" aria-label="Search" value="{{ request()->input('user_search') }}">
                        <input name="product_search" class="form-control me-2" type="search" placeholder="Search by product_name" aria-label="Search" value="{{ request()->input('product_search') }}">
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
                    <th scope="col">Product Profile</th>
                    <th scope="col">Bidder Profile</th>
                    <th scope="col">Bid Price</th>
                    <th scope="col">Bidding Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bits as $key => $bit)
                    <tr>
                        <th>
                            {{ $key+1 }}
                        </th>
                        <td>
                            <strong class="font-weight-bold d-inline-block">{{ $bit->product_title }}</strong><br>
                            <small>Base Price: ৳ <s>{{ $bit->product_base_price }}</s></small><br>
                        </td>
                        <td>
                            <strong>{{ $bit->user_name }}</strong><br>
                            <small>{{ $bit->user_type }}</small>
                        </td>
                        <td>
                            <span> ৳ {{ $bit->bid_price }}</span>
                        </td>
                        <td>
                            <span>
                                {{ $bit->created_at }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="height: 50px">
                {{ $bits->links() }}
            </div>
            <div class="row">
                @if(count($bits) < 1)
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
