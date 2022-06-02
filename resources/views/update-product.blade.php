@extends('layouts.app')

@section('content')
    <!-- shop section -->
    <section class="shop_section layout_padding">
        <div style="width: 30%;" class="mx-auto">
            <div class="card text-end">
                <h4 class="card-header font-weight-bold text-center bg-transparent"> <i class="fa fa-pencil-square"></i> Update Product</h4>
                <div class="card-body">


                    <form class="row g-3" method="POST" action="{{ route('update-product', ['id' => $product->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="product_title" class="form-label">Product Title</label>
                            <input type="text" name="product_title" class="form-control" id="product_title" value="{{ $product->product_title }}">
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="form-label">Description</label>
                            <textarea class="form-control" name="product_description" id="product_description" rows="3">
                                {{ $product->product_description  }}
                            </textarea>
                        </div>
                        <label for="floatingSelect">Categories</label>
                        <div class="form-floating">
                            <select class="form-select" name="product_category" id="floatingSelect" aria-label="Floating label select example">
                                @foreach($categories as $category)
                                    @if($category->id == $product->product_category)
                                        <option selected value="{{ $category->id }}" >{{ $category->title }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_base_price" class="form-label">Product Base Price</label>
                            <input type="number" min="1" name="product_base_price" class="form-control" id="product_base_price" value="{{ $product->product_base_price }}">
                        </div>
                        <div class="mb-3">
                            <label for="product_base_price" class="form-label">Product Image</label>
                            <div class="text-center">
                                <img width="50" class="rounded float-end my-2" src="{{ asset('storage/'.$product->images[0]["image_url"]) }}" alt="">
                            </div>
                            <input type="file" name="product_image" class="form-control" id="product_image">
                        </div>

                        <div class="mb-3">
                            <label for="product_finished" class="form-label">Bedding Finish Time</label>
                            <input type="datetime-local" name="product_valid_till" class="form-control" value="{{\Illuminate\Support\Carbon::parseFromLocale($product->product_valid_till)->format('Y-m-d'). "T". \Illuminate\Support\Carbon::parseFromLocale($product->product_valid_till)->format('H:i') }}" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update</button>

                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
